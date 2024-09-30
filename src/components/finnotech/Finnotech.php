<?php

namespace sadi01\openbanking\components\finnotech;

use sadi01\openbanking\components\OpenBanking;
use sadi01\openbanking\models\BaseOpenBanking;
use sadi01\openbanking\models\ObOauthAccessTokens;
use sadi01\openbanking\models\ObOauthClients;
use sadi01\openbanking\models\ObOauthRefreshTokens;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use sadi01\openbanking\models\Finnotech as FinnotechBaseModel;
use Yii;

class Finnotech extends OpenBanking implements FinnotechInterface
{

    public $baseUrl = 'https://apibeta.finnotech.ir/';
    private $model;
    private $client;

    public function init()
    {
        parent::init();
        $this->model = new FinnotechBaseModel();

        $this->client = ObOauthClients::find()
            ->byClient(ObOauthClients::PLATFORM_FINNOTECH)
            ->one();

        if (!($this->client instanceof ObOauthClients)) {
            throw new InvalidConfigException(Yii::t('openBanking', 'The Service Provider is not set'));
        }
    }

    public function goToAuthorize($data)
    {
        $scopes = is_array($data['scopes']) ? implode(',', $data['scopes']) : $data['scopes'];
        $params = [
            'client_id' => $this->client->app_key,
            'response_type' => 'code',
            'redirect_uri' => $data['redirect_uri'],
            'scope' => $scopes,
            'bank' => $data['bank'] ?? '019',
            'state' => $data['state'] ?? null,
        ];

        if (preg_match('/\b' . FinnotechBaseModel::SCOPE_TRANSFER_TO . '\b/', $scopes)) {
            $params['limit'] = (int)$this->client->finno_limit;
            $params['count'] = (int)$this->client->finno_count;
        }

        return BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_GO_TO_AUTHORIZE, $params);
    }

    public function verifyAcToken($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_VERIFY_AC_TOKEN)) {
            Authentication::getAcToken($this->client, $data['scope'], $data['code'], $data['redirect_uri'], $data['bank']);
        } else return $this->setErrors($this->model->errors);
    }

    public function sendOtpAuthorizeCode($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_SEND_OTP)) {

            $scopes = is_array($data['scopes']) ? implode(',', $data['scopes']) : $data['scopes'];
            $params = [
                'client_id' => $this->client->app_key,
                'redirect_uri' => $data['redirect_uri'],
                'response_type' => 'code',
                'scope' => $scopes,
                // 'bank' => $data['bank'] ?? '062',
                'mobile' => $data['mobile'],
                'state' => $data['state'] ?? null,
                'auth_type' => 'SMS',
            ];

            $headers['Content-Type'] = Client::FORMAT_JSON;
            $headers['Authorization'] = 'Basic ' . base64_encode($this->client->app_key . ':' . $this->client->app_password);
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_SEND_OTP, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_SEND_OTP, $params), $params, $headers);

        } else return $this->setErrors($this->model->errors);
    }

    public function verifyOtpCode($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_VERIFY_OTP_CODE)) {
            $body = [
                'otp' => $data['otp'],
                'mobile' => $data['mobile'],
                'nid' => $data['national_code'],
                'trackId' => $data['track_id'],
            ];

            $headers['Content-Type'] = Client::FORMAT_JSON;
            $headers['Authorization'] = 'Basic ' . base64_encode($this->client->app_key . ':' . $this->client->app_password);

            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_VERIFY_OTP, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_VERIFY_OTP), $body, $headers);

        } else return $this->setErrors($this->model->errors);
    }

    public function getAuthorizeToken($data)
    {
        $accessToken = ObOauthAccessTokens::find()->notExpire()->byClientId($this->client->client_id)->one();
        $refreshToken = ObOauthRefreshTokens::find()->notExpire()->byClientId($this->client->client_id)->one();

        if (!$accessToken instanceof ObOauthAccessTokens && !$refreshToken instanceof ObOauthRefreshTokens) {

            $body = [
                'grant_type' => 'authorization_code',
                'code' => $data['code'],
                'bank' => $data['bank'],
                'redirect_uri' => $data['redirect_uri'],
            ];

            $headers['Content-Type'] = Client::FORMAT_JSON;
            $headers['Authorization'] = 'Basic ' . base64_encode($this->client->app_key . ':' . $this->client->app_password);
            $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_GET_TOKEN, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_GET_AUTHORIZE_TOKEN), $body, $headers);
            if ($response['status'] == 200) {
                $result = $response['data']->result;
                $scopes = null;
                foreach ($result->scopes as $scope) {
                    $scopes .= $scope . ' ';
                }
                $accessToken = new ObOauthAccessTokens([
                    'access_token' => $result->value,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'user_id' => Yii::$app->user->id,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'scope' => $scopes,
                ]);
                if (!$accessToken->save()) {
                    print_r($accessToken->errors);
                    die;
                }
                $refreshToken = new ObOauthRefreshTokens([
                    'refresh_token' => $result->refreshToken,
                    'user_id' => Yii::$app->user->id,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'scope' => $scopes,
                ]);
                /* $refreshToken->save();*/
                if (!$refreshToken->save()) {
                    print_r($refreshToken->errors);
                    die;
                }
                return $accessToken->access_token;
            }
        } else if ($accessToken instanceof ObOauthAccessTokens) {
            return $accessToken->access_token;
        } else if ($refreshToken instanceof ObOauthRefreshTokens) {
            return Authentication::refreshToken($refreshToken, $this->client);
        }
        return null;
    }

    /**
     * @param array $data The data array containing:
     *     - string 'amount' => مبلغ انتقال وجه
     *     - string 'description' => شرح انتقال وجه
     *     - string 'destinationFirstname' => نام صاحب حساب مقصد
     *     - string 'destinationLastname' => نام خانوادگی صاحب حساب مقصد
     *     - string 'destinationNumber' => شماره حساب مقصد
     *     - string 'paymentNumber' => شناسه پرداخت
     *     - string 'reasonDescription' => بابت
     *     - string 'deposit' => شماره حساب مبدا
     *     - string 'sourceFirstName' => نام صاحب حساب مبدا
     *     - string 'sourceLastName' => نام خانوادگی صاحب حساب مبدا
     *     - string 'secondPassword' => رمز انتقال وجه
     *     - ?string 'merchantName' => نام پذیرنده
     *     - ?string 'merchantIban' => شماره شبا پذیرنده
     * @return mixed The result of the processing.
     * */
    public function transfer($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_TRANSFER, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'destinationNumber' => شماره شبای بانک مقصد
     *     - string 'amount' =>  مبلغ انتقال وجه
     *     - string 'description' => شرح انتقال وجه
     *     - string 'reasonDescription' => اطلاعات بیشتر
     *     - integer 'paymentNumber' => شناسه پرداخت
     *     - string 'destinationFirstname' =>  نام صاحب حساب مقصد
     *     - string 'destinationLastname' => نام خانوادگی صاحب حساب مقصد
     *     - integer 'customerRef' => شناسه ارجاع
     * @return mixed The result of the processing.
     * */
    public function payaTransfer($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_PAYA_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_PAYA_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_PAYA_TRANSFER, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'amount' => مبلغ تراکنش
     *     - string 'description' =>   شرح تراکنش
     *     - string 'destinationNumber' =>شماره شبا مقصد
     *     - integer 'paymentNumber' =>  شناسه پرداخت
     *     - string 'customerRef' => شماره مرجع تراکنش که توسط کاربر وارد می شود
     *     - string 'sourceFirstName' => نام صاحب حساب مبدا
     *     - string 'sourceLastName' => نام خانوادگی صاحب حساب مبدا
     *     - string 'reasonDescription' => دلیل تراکنش
     *     - integer 'note' =>  شناسه پرداخت
     *     - ?string 'destinationFirstname' => نام صاحب حساب مقصد
     *     - ?string 'destinationLastname' => نام خانوادگی صاحب حساب مقصد
     *     - ?string 'deposit' => شماره حساب مبدا
     * @return mixed The result of the processing.
     * */
    public function internalTransfer($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_INTERNAL_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'card' => شماره کارت
     * @return mixed The result of the processing.
     * */

    public function cardToDeposit($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_CARD_TO_DEPOSIT)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_CARD_TO_DEPOSIT, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_CARD_TO_DEPOSIT, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'card' => $data['card']]), $data, $this->getHeaders(FinnotechBaseModel::SCOPE_CARD_TO_DEPOSIT));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'card' => شماره کارت
     *     - string 'version' => که باید برابر عدد دو باشد API ورژن
     * @return mixed The result of the processing.
     * */

    public function cardToShaba($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_CARD_TO_SHABA)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_CARD_TO_SHABA, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_CARD_TO_SHABA, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'card' => $data['card'], 'version' => $data['version']]), $data, $this->getHeaders(FinnotechBaseModel::SCOPE_CARD_TO_SHABA));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'clientId' => شناسه کلاینت
     *     - string 'users' =>  کدملی
     *     - string 'trackId' =>  رشته ای اختیاری با طول حداکثر ۴۰ کاراکتر شامل حرف و عدد
     *     - string 'birthDate' =>  تاریخ تولد صاحب این کد ملی
     *     - string 'fullName' =>   نام و نام خانوادگی که میخواهید صحت آن را بررسی کنید
     *     - string 'firstName' =>  نام کوچک صاحب کد ملی
     *     - string 'lastName' =>   نام خانوادگی صاحب کد ملی
     *     - ?string 'fatherName' =>  نام پدر صاحب کد ملی
     *     - ?string 'gender' =>  جنسیت صاحب کد ملی که یکی از دو مقدار زن یا مرد است
     * @return mixed The result of the processing.
     * */

    public function nidVerification($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_NID_VERIFICATION)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_NID_VERIFICATION, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_NID_VERIFICATION, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'users' => $data['users'], 'birthDate' => $data['birth_date'], 'fullName' => $data['full_name'], 'firstName' => $data['first_name'], 'lastName' => $data['last_name'], 'fatherName' => $data['father_name'], 'gender' => $data['gender'] ?? '']), $data, $this->getHeaders(FinnotechBaseModel::SCOPE_NID_VERIFICATION));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'mobile' => شماره موبایل
     *     - string 'nationalCode' =>  کدملی
     * @return mixed The result of the processing.
     * */

    public function matchMobileNid($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_MATCH_MOBILE_NID)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_MATCH_MOBILE_NID, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_MATCH_MOBILE_NID, ['clientId' => $this->client->app_key, 'mobile' => $data['mobile'], 'nationalCode' => $data['national_code'], 'trackId' => $data['track_id']]), $data, $this->getHeaders(FinnotechBaseModel::SCOPE_FACILITY_SHAHKAR));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'clientId' => شناسه کلاینت
     *     - string 'trackId' =>  کد پیگیری
     *     - string 'birthDate' =>  تاریخ تولد شمسی صاحب حساب
     *     - string 'nationalCode' =>  کد ملی صاحب حساب
     *     - string 'iban' =>  شماره شب
     * @return mixed The result of the processing.
     * */

    public function ibanOwnerVerification($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_IBAN_OWNER_VERIFICATION)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_IBAN_OWNER_VERIFICATION, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_MATCH_MOBILE_NID, ['clientId' => $this->client->app_key, 'birthDate' => $data['birth_date'], 'nid' => $data['national_code'], 'trackId' => $data['track_id'], 'iban' => $data['iban']]), $data, $this->getHeaders(FinnotechBaseModel::SCOPE_IBAN_OWNER_VERIFICATION));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'card' => شماره کارت ۱۶ رقمی
     * @return mixed The result of the processing.
     * */

    public function cardInfo($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_CARD_INFO)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_CARD_INFO, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_CARD_INFO, ['clientId' => $this->client->app_key, 'card' => $data['card'], 'trackId' => $data['track_id']]), $data, $this->getHeaders(FinnotechBaseModel::SCOPE_CARD_INFO));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'users' => کد ملی ۱۰ رقمی
     * @return mixed The result of the processing.
     * */

    public function deposits($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_DEPOSITS)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_DEPOSITS, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_DEPOSITS, ['clientId' => $this->client->app_key, 'users' => $data['users'], 'trackId' => $data['track_id']]), $data, $this->getHeaders(FinnotechBaseModel::SCOPE_DEPOSITS));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'iban' => شماره شبا
     * @return mixed The result of the processing.
     * */
    public function shabaInquiry($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_SHABA_INQUIRY)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_SHABA_INQUIRY, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_SHABA_INQUIRY, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'iban' => $data['iban']]), $data, $this->getHeaders(FinnotechBaseModel::SCOPE_IBAN_INQUIRY));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'deposit' => شماره حسابی که قصد دریافت شماره شبا آن را دارید
     *     - string 'bankCode' => کد بانک صاحب حساب
     * @return mixed The result of the processing.
     * */
    public function depositToShaba($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_DEPOSIT_TO_SHABA)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'deposit' => $data['deposit'], 'bank_code' => $data['bank_code']]), $data, $this->getHeaders(FinnotechBaseModel::SCOPE_FACILITY_DEPOSIT_TO_SHABA));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'sayadId' => شناسه صیاد چک
     * @return mixed The result of the processing.
     * */
    public function checkInquiry($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_CHECK_INQUIRY)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_CHECK_INQUIRY, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_CHECK_INQUIRY, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'sayadId' => $data['sayad_id']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_CHEQUE_INQUIRY_BY_RECEIVER));
        } else return $this->setErrors($this->model->errors);
    }


    public function banksInfo($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_BANKS_INFO)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_BANKS_INFO, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_BANKS_INFO, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_FACILITY_BANK_INFO));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'user' => کد ملی کاربر صاحب توکن
     * @return mixed The result of the processing.
     * */
    public function backCheques($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_BACK_CHEQUES)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_BACK_CHEQUES, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_BACK_CHEQUES, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'user' => $data['user']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_BACK_CHEQUES, true, $data['user'], $data['code'], $data['redirect_uri']));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'user' => کد ملی
     *     - string 'code' => ''
     *     - string 'redirect_uri' => ''
     * @return mixed The result of the processing.
     * */
    public function sayadAcceptCheque($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_SAYAD_ACCEPT_CHEQUE)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_SAYAD_ACCEPT_CHEQUE, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_SAYAD_ACCEPT_CHEQUE, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'user' => $data['user']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_ACCEPT_CHEQUES, true, $data['user'], $data['code'], $data['redirect_uri']));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'user' => کد ملی
     *     - string 'code' => ''
     *     - string 'redirect_uri' => ''
     * @return mixed The result of the processing.
     * */
    public function sayadCancelCheque($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_SAYAD_CANCEL_CHEQUE)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_SAYAD_CANCEL_CHEQUE, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_SAYAD_CANCEL_CHEQUE, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'user' => $data['user']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_CANCEL_CHEQUES,true, $data['user'], $data['code'], $data['redirect_uri']));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'user' => کد ملی کاربر
     *     - string 'code' => ''
     *     - string 'redirect_uri' => ''
     *     - string 'id_type' => نوع کد شناسایی با ملاحظات: مشتری حقیقی ۱,مشتری حقوقی ۲
     *     - string 'sayad_id' => شناسه صیاد چک
     *     - string 'track_id' =>  کد پیگیری
     *     - ?string 'id_code' =>  کد شناسایی
     *     - ?string 'shahab_id' => کد شهاب
     * @return mixed The result of the processing.
     * */
    public function sayadChequeInquiry($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_SAYAD_CHEQUE_INQUIRY)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_SAYAD_CHEQUE_INQUIRY, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_SAYAD_CHEQUE_INQUIRY, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'user' => $data['user'], 'idCode' => $data['id_code'], 'shahabId' => $data['shahab_id'], 'idType' => $data['id_type'], 'sayadId' => $data['sayad_id']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_CHEQUE_INQUIRY_BY_SMS, true, $data['user'], $data['code'], $data['redirect_uri']));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - array 'account_owners' => (اجباری) لیست صاحبان حساب
     *     - array 'receivers' => کد ملی کاربر
     *     - array 'signers' => نوع کد شناسایی با ملاحظات: مشتری حقیقی ۱,مشتری حقوقی ۲
     *     - string 'sayad_id' => شناسه صیاد
     *     - string 'series_no' =>  شماره سری
     *     - string 'serial_no' =>  شماره سریال
     *     - string 'from_iban' => شماره شبا دارنده چک
     *     - string 'amount' => مبلغ
     *     - string 'description' => شرح ثبت چک
     *     - string 'due_date' => تاریخ سررسید چک
     *     - ?string 'to_iban' => شماره شبا مقصد
     *     - string 'bank_code' => کد بانک مبدا
     *     - string 'branch_code' => کد شعبه مبدا
     *     - string 'cheque_type' => نوع چک
     *     - ?string 'cheque_media' => چک کاغذی1 چک دیجیتال2
     *     - string 'reason' => اطلاعات بیشتر
     * @return mixed The result of the processing.
     * */
    public function sayadIssueCheque($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_SAYAD_ISSUE_CHEQUE)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_SAYAD_ISSUE_CHEQUE, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_SAYAD_ISSUE_CHEQUE, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'user' => $data['user'], 'idCode' => $data['id_code'], 'shahabId' => $data['shahab_id'], 'idType' => $data['id_type'], 'sayadId' => $data['sayad_id']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_ISSUE_CHEQUE));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'user' => کد ملی
     *     - string 'code' => ''
     *     - string 'redirect_uri' => ''
     * @return mixed The result of the processing.
     * */
    public function sayadIssuerInquiryCheque($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_SAYAD_ISSUER_INQUIRY_CHEQUE)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'user' => $data['user']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_CHEQUE_INQUIRY_BY_ISSUER,true, $data['user'], $data['code'], $data['redirect_uri']));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'deposit' => '',
     *     - string 'to_date' => '',
     *     - string 'from_date' => '',
     *     - string 'to_time' => '',
     *     - string 'from_time' =>'',
     * @return mixed The result of the processing.
     * */
    public function depositStatement($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_DEPOSIT_STATEMENT)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_DEPOSIT_STATEMENT, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_DEPOSIT_STATEMENT, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'toDate' => $data['to_date'], 'fromDate' => $data['from_date'], 'toTime' => $data['to_time'], 'fromTime' => $data['from_time']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_DEPOSIT_STATEMENT));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'deposit' => 'شماره حساب معتبر',
     *     - string 'track_id' => 'کد پیگیری',
     * @return mixed The result of the processing.
     * */
    public function depositBalance($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_DEPOSIT_BALANCE)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_DEPOSIT_BALANCE, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_DEPOSIT_STATEMENT, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'deposit' => $data['deposit']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_DEPOSIT_BALANCE));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'user' => 'کد ملی کاربر',
     *     - string 'track_id' => 'کد پیگیری',
     * @return mixed The result of the processing.
     * */
    public function facilityInquiry($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_FACILITY_INQUIRY)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_FACILITY_INQUIRY, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_FACILITY_INQUIRY, ['clientId' => $this->client->app_key, 'trackId' => $data['track_id'], 'user' => $data['user']]), null, $this->getHeaders(FinnotechBaseModel::SCOPE_SMS_FACILITY_INQUIRY,true, $data['user'], $data['code'], $data['redirect_uri']));
        } else return $this->setErrors($this->model->errors);
    }


    public function load($data, $scenario)
    {
        $this->model->scenario = $scenario;
        if ($this->model->load($data, '') && $this->model->validate()) {
            return true;
        }
        $this->model->validate();
        return false;
    }

    public function getHeaders($scope = null, $smsToken = false, $national_code = null, $code = null, $redirect_uri = null)
    {
        $token = $smsToken ? Authentication::getSmsToken($this->client, $scope, $code, $redirect_uri, $national_code) : Authentication::getToken($this->client, $scope);

        $headers = [];
        $headers['Accept-Language'] = 'fa';
        $headers['Authorization'] = 'Bearer ' . $token;
        $headers['Content-Type'] = Client::FORMAT_JSON;

        return $headers;
    }

}