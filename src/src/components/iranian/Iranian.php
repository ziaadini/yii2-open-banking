<?php

namespace sadi01\openbanking\components\iranian;

use sadi01\openbanking\components\OpenBanking;
use sadi01\openbanking\helpers\ResponseHelper;
use sadi01\openbanking\models\BaseOpenBanking;
use sadi01\openbanking\models\ObOauthClients;
use Yii;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use sadi01\openbanking\models\iranian as IranianBaseModel;

class Iranian extends OpenBanking implements IranianInterface
{
    public $baseUrl = 'https://app.ics24.ir/';
    private $model;
    private $client;

    public function init()
    {
        parent::init();
        $this->model = new IranianBaseModel();

        $this->client = ObOauthClients::find()
            ->byClient(ObOauthClients::PLATFORM_IRABIAN)
            ->one();

        if (!($this->client instanceof ObOauthClients)) {
            throw new InvalidConfigException(Yii::t('openBanking', 'The Service Provider is not set'));
        }
    }

    /**
     * Send request to Iranian API.
     * @param array $data
     * @return \stdClass
     */
    public function request($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_REQUEST)) {
            $response = Yii::$app->apiClient->post(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_REQUEST,
                BaseOpenBanking::getUrl(BaseOpenBanking::IRANIAN_REQUEST),
                $data,
                $this->getHeaders()
            );
            return ResponseHelper::mapFaraboom($response);
        } else {
            return $this->setErrors($this->model->errors);
        }
    }

    public function renewToken($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_REQUEST)) {
            $response = Yii::$app->apiClient->post(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_REQUEST,
                BaseOpenBanking::getUrl(BaseOpenBanking::IRANIAN_REQUEST),
                $data,
                $this->getHeaders()
            );
            return ResponseHelper::mapFaraboom($response);
        } else {
            return $this->setErrors($this->model->errors);
        }
    }

    /**
     * Validate the data with the Iranian API (implementation).
     * @param array $data
     * @return \stdClass
     */
    public function validate($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_VALIDATE)) {
            $response = Yii::$app->apiClient->post(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_VALIDATE,
                BaseOpenBanking::getUrl(BaseOpenBanking::IRANIAN_VALIDATE),
                $data,
                $this->getHeaders()
            );
            return ResponseHelper::mapFaraboom($response);
        } else {
            return $this->setErrors($this->model->errors);
        }
    }

    /**
     * Check the status of a request.
     * @param array $data
     * @return \stdClass
     */
    public function status($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_STATUS)) {
            $response = Yii::$app->apiClient->get(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_STATUS,
                $data,
                $this->getHeaders()
            );
            return ResponseHelper::mapFaraboom($response);
        } else {
            return $this->setErrors($this->model->errors);
        }
    }

    /**
     * Regenerate the report via the API.
     * @param array $data
     * @return \stdClass
     */
    public function reGenerateReport($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_REGENERATE_REPORT)) {
            $response = Yii::$app->apiClient->post(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_REGENERATE_REPORT,
                BaseOpenBanking::getUrl(BaseOpenBanking::IRANIAN_REGENERATE_REPORT),
                $data,
                $this->getHeaders()
            );
            return ResponseHelper::mapFaraboom($response);
        } else {
            return $this->setErrors($this->model->errors);
        }
    }

    /**
     * Retrieve the report in XML format.
     * @param array $data
     * @return \stdClass
     */
    public function reportXml($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_REPORT_XML)) {
            $response = Yii::$app->apiClient->get(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_REPORT_XML,
                $data,
                $this->getHeaders()
            );
            return ResponseHelper::mapFaraboom($response);
        } else {
            return $this->setErrors($this->model->errors);
        }
    }

    /**
     * Retrieve the report in PDF format.
     * @param array $data
     * @return \stdClass
     */
    public function reportPdf($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_REPORT_PDF)) {
            $response = Yii::$app->apiClient->get(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_REPORT_PDF,
                $data,
                $this->getHeaders()
            );
            return ResponseHelper::mapFaraboom($response);
        } else {
            return $this->setErrors($this->model->errors);
        }
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
        $headers['x-version'] = '2.0';
        $headers['Authorization'] = 'Bearer ' . $token->access_token;
        $headers['x-apikey'] = $token->api_key;
        $headers['Content-Type'] = 'application/x-www-form-' . Client::FORMAT_JSON;

        return $headers;
    }
}
