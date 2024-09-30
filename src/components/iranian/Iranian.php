<?php

namespace sadi01\openbanking\components\iranian;

use sadi01\openbanking\components\OpenBanking;
use sadi01\openbanking\helpers\ResponseHelper;
use sadi01\openbanking\models\BaseOpenBanking;
use sadi01\openbanking\models\ObOauthClients;
use Yii;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use sadi01\openbanking\models\Iranian as IranianBaseModel;

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
     * @param $data
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
                $this->getHeaders(false)
            );
            return $response;
        } else {
            return $this->setErrors($this->model->errors);
        }
    }

    /**
     * @param $data
     * @return \stdClass
     */
    public function renewToken($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_REQUEST)) {
            $response = Yii::$app->apiClient->post(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_REQUEST,
                BaseOpenBanking::getUrl(BaseOpenBanking::IRANIAN_RE_NEW_TOKEN, $data),
                $data,
                $this->getHeaders()
            );
            return $response;
        } else {
            return $this->setErrors($this->model->errors);
        }
    }


    /**
     * @param $data
     * @return \stdClass
     */
    public function validate($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_VALIDATE)) {
            $response = Yii::$app->apiClient->post(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_VALIDATE,
                BaseOpenBanking::getUrl(BaseOpenBanking::IRANIAN_VALIDATE, $data),
                $data,
                $this->getHeaders()
            );
            return $response;
        } else {
            return $this->setErrors($this->model->errors);
        }
    }


    /**
     * @param $data
     * @return \stdClass
     */
    public function status($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_STATUS)) {
            $response = Yii::$app->apiClient->get(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_STATUS,
                BaseOpenBanking::getUrl(BaseOpenBanking::IRANIAN_STATUS, $data),
                $data,
                $this->getHeaders(true)
            );
            return $response;
        } else {
            return $this->setErrors($this->model->errors);
        }
    }


    /**
     * @param $data
     * @return \stdClass
     */
    public function reGenerateReport($data)
    {
        if ($this->load($data, IranianBaseModel::SCENARIO_REGENERATE_REPORT)) {
            $response = Yii::$app->apiClient->post(
                ObOauthClients::PLATFORM_IRABIAN,
                BaseOpenBanking::IRANIAN_REGENERATE_REPORT,
                BaseOpenBanking::getUrl(BaseOpenBanking::IRANIAN_REGENERATE_REPORT, $data),
                $data,
                $this->getHeaders()
            );
            return $response;
        } else {
            return $this->setErrors($this->model->errors);
        }
    }

    /**
     * @param $data
     * @param $scenario
     * @return bool
     */
    public function load($data, $scenario): bool
    {

        $this->model->scenario = $scenario;
        if ($this->model->load($data, '') && $this->model->validate()) {
            return true;
        }
        $this->model->validate();

        return false;
    }

    /**
     * @return string
     */
    public function token(): string
    {
        return Authentication::getToken($this->client)->access_token;
    }

    /**
     * @param $json_type
     * @return array
     */
    public function getHeaders($json_type = false): array
    {
        $response = Authentication::getToken($this->client);
        $headers = [];
        $headers['x-version'] = '2.0';
        $headers['Authorization'] = 'Bearer ' . $response->access_token;
        $headers['x-apikey'] = $response->api_key;
        $headers['Content-Type'] = $json_type ? Client::FORMAT_JSON : Client::FORMAT_RAW_URLENCODED;

        return $headers;
    }
}
