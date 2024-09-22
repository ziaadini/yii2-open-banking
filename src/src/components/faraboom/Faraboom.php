<?php

namespace sadi01\openbanking\components\faraboom;

use sadi01\openbanking\helpers\ResponseHelper;
use Yii;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use sadi01\openbanking\models\BaseOpenBanking;
use sadi01\openbanking\models\ObOauthClients;
use sadi01\openbanking\components\OpenBanking;
use sadi01\openbanking\models\Faraboom as FaraboomBaseModel;

class Faraboom extends OpenBanking implements FaraboomInterface
{
    public $baseUrl = 'https://api.faraboom.co/v1/';
    private $model;
    private $client;

    public function init()
    {
        parent::init();
        $this->model = new FaraboomBaseModel();

        $this->client = ObOauthClients::find()
            ->byClient(ObOauthClients::PLATFORM_FARABOOM)
            ->one();

        if (!($this->client instanceof ObOauthClients)) {
            throw new InvalidConfigException(Yii::t('openBanking', 'The Service Provider is not set'));
        }
    }

    /**
     * @param array $data The data array containing:
     *     - string 'deposit_number' => The Deposit number value.
     * @return mixed The result of the processing.
     * */
    public function depositToShaba($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_DEPOSIT_TO_SHABA)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_DEPOSIT_TO_SHABA, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_DEPOSIT_TO_SHABA, $data['deposit_number']), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'iban' => شماره شبا.
     * @return mixed The result of the processing.
     * */
    public function shabaToDeposit($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SHABA_TO_DEPOSIT)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_SHABA_TO_DEPOSIT, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_SHABA_TO_DEPOSIT, $data['iban']), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'national_code' => شماره ملی.
     *     - string 'account' => شماره حساب.
     * @return mixed The result of the processing.
     * */

    public function matchNationalCodeAccount($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'deposit_number' => شماره سپرده.
     * @return mixed The result of the processing.
     * */

    public function depositHolder($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_DEPOSIT_HOLDER)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_DEPOSIT_HOLDER, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_DEPOSIT_HOLDER, $data['deposit_number']), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'source_deposit_number' => شماره حساب مبدا.
     *     - string 'iban_number' => شماره شبا مقصد.
     *     - string 'owner_name' => نام صاحب سپرده مقصد.
     *     - Decimal 'amount' => 1.00=حداقل مقدار BigDecimal مبلغ انتقال وجه پایا نوع.
     *     - ?string 'transfer_description' => شرح انتقال
     *     - ?string 'customer_number' => شماره مشتری
     *     - ?string 'description' => توضیحات
     *     - ?string 'factor_number' => شماره فاکتور
     *     - ?string 'additional_document_desc' => توضیحی های اضافه
     *     - ?enum 'transaction_reason' => [POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]
     *     - ?string 'pay_id' => شناسه پرداخت
     * @return mixed The result of the processing.
     * */

    public function paya($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_PAYA)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_PAYA, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_PAYA), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - ?string 'transfer_description' => شرح انتقال
     *     - ?string 'customer_number' => شماره مشتری
     *     - string 'source_deposit_number' => شماره سپرده مبدا
     *     - ?boolean 'ignore_error' => این فیلد مشخص می کند که اگر در انجام یک تراکنس خطایی رخ داد از انجام بقیه تراکنش ها صرف نظر کند یا خیر
     *     - ?array 'transactions' =>
     *     - ?string 'additional_document_desc' =>
     *     - ?enum 'transaction_reason' => [POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]
     *
     * @return mixed The result of the processing.
     * */

    public function batchPaya($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_BATCH_PAYA)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_BATCH_PAYA, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_BATCH_PAYA), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'source_deposit' => سپرده مبدا
     *     - string 'destination_deposit' => شماره سپرده مقصد
     *     - decimal 'amount' => مبلغ انتقال وجه حداقل مقدار =1.00
     *     - ?string 'customer_number' => شماره مشتری
     *     - ?string 'source_comment' => شرحی توسط انتقال دهنده وجه وارد می شود
     *     - ?string 'destination_comment' => شرحی که پس از انتقال وجه ، توسط شخصی که دریافت کننده وجه است قابل رویت است
     *     - ?string 'pay_id' => شناسه پرداخت
     *     - ?string 'reference_number' => شماره پیگیری توسط خود کاربر وارد می شود و مسئولیت یکتا بودن آن به عهده خود اوست.
     * کاربرد آن در زمان جستجوی تراکنش هایی است که دارای آن شماره پیگیری هستند
     *     - ?string 'additional_document_desc' =>
     *     - ?enum 'transaction_reason' => [POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]
     *
     * @return mixed The result of the processing.
     * */

    public function internalTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_INTERNAL_TRANSFER)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_INTERNAL_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_INTERNAL_TRANSFER), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'source_deposit_number' => سپرده مبدا
     *     - array 'destination_batch_transfers' => اطلاعات سپرده های مقصد
     *     - boolean 'ignore_error' =>
     *     - ?string 'customer_number' => شماره مشتری
     *     - ?string 'source_description' => یادداشت مربوط به سپرده مبدا است. این یادداشت در صورتحساب سپرده مبدا ظاهر میشود
     *     - ?string 'additional_document_desc' =>
     *     - ?array 'signers' =>
     *     - ?enum 'transaction_reason' =>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]
     *
     * @return mixed The result of the processing.
     * */

    public function batchInternalTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_BATCH_INTERNAL_TRANSFER)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_BATCH_INTERNAL_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_BATCH_INTERNAL_TRANSFER), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);
    }

    public function deposits($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_DEPOSITS)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_DEPOSITS, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_DEPOSITS), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - decimal 'amount' => حداقل مقدار =150000000.00,BigDecimal مبلغ از نوع
     *     - string 'source_deposit_number' => شماره سپرده مبدا
     *     - string 'receiver_name' => نام دریافت کننده
     *     - string 'receiver_family' => نام خانوداگی دریافت کننده
     *     - string 'destination_iban_number' => شبای مقصد
     *     - ?string 'customer_number' =>شماره مشتری
     *     - ?string 'receiver_phone_number' => شماره تلفن دریافت کننده
     *     - ?string 'factor_number' => شماره فاکتور
     *     - ?string 'description' => توضیحات
     *     - ?enum 'tranaction_reason' => [POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]
     *     - ?string 'pay_id' => شناسه پرداخت
     *
     * @return mixed The result of the processing.
     * */

    public function satna($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SATNA)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_SATNA, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_SATNA), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'sayad_id' => نام شخص
     *     - ?string 'customer_number' => شماره مشتری
     *
     * @return mixed The result of the processing.
     * */

    public function checkinquiryReceiver($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_CHECK_INQUIRY_RECEIVER)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_CHECK_INQUIRY_RECEIVER, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_CHECK_INQUIRY_RECEIVER), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'iban' => شماره شبا
     *
     * @return mixed The result of the processing.
     * */

    public function shabainquiry($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SHABA_INQUIRY)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_SHABA_INQUIRY, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_SHABA_INQUIRY, $data['iban']), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'national_code' => شماره ملی
     *     - string 'mobile' =>
     *
     * @return mixed The result of the processing.
     * */

    public function matchNationalCodeMobile($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_MATCH_NATIONAL_CODE_MOBILE)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_MATCH_NATIONAL_CODE_MOBILE, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_MATCH_NATIONAL_CODE_MOBILE), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'pan' => شماره کارت
     *
     * @return mixed The result of the processing.
     * */

    public function cartToShaba($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_CART_TO_SHABA)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_CART_TO_SHABA, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_CART_TO_SHABA, $data['pan']), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - ?string 'source_deposit_iban' => شماره شبای سپرده مبد
     *     - ?string 'transfer_description' => شرح انتقال
     *     - ?string 'customer_number' => شماره مشتری
     *     - ?int64 'offset' =>  long شماره اولین رکورد بازگشتی از نوع
     *     - ?int64 'length' =>  long تعداد رکورد بازگشتی از نوع
     *     - ?string 'reference_id' =>شماره پیگیری انتقال وجه پایا
     *     - ?string 'traco_no' => کد یکتا برای پیگیری
     *     - ?string 'transaction_id' => شماره پیگیری تراکنش
     *     - ?string 'from_register_date' => از تاریخ ثبت انتقال وجه پایا
     *     - ?string 'to_register_date' => تا تاریخ ثبت انتقال وجه پایا
     *     - ?string 'from_issue_date' => از تاریخ انجام انتقال وجه پایا
     *     - ?string 'To_issue_date' => تا تاریخ انجام انتقال وجه پایا
     *     - ?decimal 'from_transaction_amount' => حداقل مبلغ انتقال وجه پایا
     *     - ?decimal 'to_transaction_amount' => حداکثر مبلغ انتقال وجه پایا
     *     - ?string 'iban_number' => آی بن شماره سپرده مقصد
     *     - ?string 'iban_owner_name' => نام صاحب سپرده مقصد
     *     - ?string 'factor_number' => شماره فاکتور انتقال وجه پایا
     *     - ?string 'description' => شرح انتقال وجه پایا
     *     - ?array 'include_transaction_status' => [READY_FOR_PROCESS, SUSPENDED, CANCELED, PROCESS_FAIL, READY_TO_TRANSFER, TRANSFERRED, SETTLED, NOT_SETTLED, REJECTED, UNKNOWN]
     *
     * @return mixed The result of the processing.
     * */

    public function reportPayaTransactions($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_PAYA_TRANSACTIONS)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_REPORT_PAYA_TRANSACTIONS, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_REPORT_PAYA_TRANSACTIONS), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - ?string 'source_deposit_iban' => شماره شبای سپرده مبدأ
     *     - ?string 'transfer_description' => شرح انتقال
     *     - ?string 'customer_number' => شماره مشتری
     *     - ?int64 'offset' =>  long شماره اولین رکورد بازگشتی از نوع
     *     - ?int64 'length' =>  long تعداد رکورد بازگشتی از نوع
     *     - ?decimal 'from_transaction_amount' => حداقل مبلغ انتقال وجه پایا
     *     - ?decimal 'to_transaction_amount' => حداکثر مبلغ انتقال وجه پایا
     *     - ?string 'reference_id' => شماره پیگیری انتقال وجه پایا
     *     - ?string 'trace_no' => شماره پیگیری تراکنش
     *     - ?string 'destination_iban_number' => شماره آی بن مقصد را برمی گرداند
     *     - ?string 'destination_owner_name' => نام صاحب سپرده مقصد را برمی گرداند
     *     - ?string 'from_register_date' => از تاریخ ثبت انتقال وجه پایا
     *     - ?string 'to_register_date' => تا تاریخ ثبت انتقال وجه پایا
     *     - ?string 'from_issue_date' => از تاریخ انجام انتقال وجه پایا
     *     - ?string 'to_issue_date' => تا تاریخ انجام انتقال وجه پایا
     *     - ?string 'description' => شرح انتقال وجه پایا
     *     - ?string 'factor_number' => شماره فاکتور انتقال وجه پایا
     *     - ?array 'status_set' => لیستی از وضعیت هایی انتقال وجه پایا
     *     - ?array 'transaction_status_set' => لیستی از وضعیت تراکنش های انتقال وجه پایا
     *
     * @return mixed The result of the processing.
     * */

    public function reportPayaTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_PAYA_TRANSFER)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_REPORT_PAYA_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_REPORT_PAYA_TRANSFER), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - ?string 'customer_number' => شماره مشتری
     *     - ?string 'transfer_id' => شماره پیگیری که در پاسخ سرویس انتقال وجه پایا برگردانده شد
     *     - ?string 'comment' => یادداشت
     *
     * @return mixed The result of the processing.
     * */

    public function cancelPaya($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_CANCLE_PAYA)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_CANCLE_PAYA, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_CANCLE_PAYA, $data['transfer_id']), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - ?string 'customer_number' => شماره مشتری
     *     - ?enum 'status' => وضعیت انتقال وجه
     *     - ?int16 'branch_code' => کد شعبه
     *     - ?string 'branch_name' => نام شعبه
     *     - ?string 'from_date' => از تاریخ
     *     - ?int64 'length' =>  long تعداد رکورد بازگشتی از نوع
     *     - ?int64 'offset' =>  long اولین رکورد بازگشتی از نوع
     *     - ?string 'serial' => شماره سریال
     *     - ?string 'trace_no' => شماره پیگیری ارسال شده از برنامه
     *     - ?string 'to_date' => تا تاریخ
     *
     * @return mixed The result of the processing.
     * */

    public function reportSatnaTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_SATNA_TRANSFER)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_REPORT_SATNA_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_REPORT_SATNA_TRANSFER), $data, $this->getHeaders()));
        } else return $this->setErrors($this->model->errors);

    }

    /**
     * @param array $data The data array containing:
     *     - string 'source_deposit_number' => شماره حساب مبدا
     *     - string 'description' => توضیحات
     *     - ?string 'customer_number' =>شماره مشتری
     *     - ?enum 'transaction_reason' =>
     *     - ?array 'signers' =>
     *     - ?array 'transactions' =>
     *
     * @return mixed The result of the processing.
     * */

    //$source_deposit_number, $description, $customer_number,$transaction_reason,$signers, $transactions
    public function batchSatna($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_BATCH_SATNA)) {
            return ResponseHelper::mapFaraboom(Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, BaseOpenBanking::FARABOOM_BATCH_SATNA, BaseOpenBanking::getUrl(BaseOpenBanking::FARABOOM_BATCH_SATNA), $data, $this->getHeaders()));
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

    public function getHeaders()
    {
        $token = Authentication::getToken($this->client);

        $headers = [];
        $headers['Accept-Language'] = 'fa';
        $headers['App-Key'] = $this->client->app_key;
        $headers['Authorization'] = 'Bearer ' . $token;
        $headers['bank-id'] = $this->client->bank_id;
        $headers['CLIENT-DEVICE-ID'] = $this->client->client_device_id;
        $headers['CLIENT-IP-ADDRESS'] = Yii::$app->request->userIP ?? $this->client->client_device_id;
        $headers['CLIENT-PLATFORM-TYPE'] = 'WEB';
        $headers['CLIENT-USER-AGENT'] = Yii::$app->request->userAgent ?? '';
        $headers['CLIENT-USER-ID'] = $this->client->client_user_id;
        $headers['Content-Type'] = Client::FORMAT_JSON;
        $headers['Device-Id'] = $this->client->device_id;
        $headers['Token-Id'] = $this->client->token_id;

        return $headers;
    }


}
