<?php

namespace sadi01\openbanking\models;

use Yii;
use yii\base\Model;

class Iranian extends Model
{
    public $hash_code;
    public $api_key;
    public $report_code;


    const SCENARIO_REQUEST = 'request';
    const SCENARIO_RENEW_TOKEN = 'renew-token';
    const SCENARIO_VALIDATE = 'validate';
    const SCENARIO_STATUS = 'status';
    const SCENARIO_REGENERATE_REPORT = 're-generate-report';
    const SCENARIO_REPORT_JSON = 'json-report';


    public function rules()
    {
        return [
            [['hash_code','api_key'], 'required', 'on' => [
                self::SCENARIO_VALIDATE,
                self::SCENARIO_STATUS,
                self::SCENARIO_REGENERATE_REPORT,
                self::SCENARIO_RENEW_TOKEN
            ]],
            [['code'], 'required', 'on' => [
                self::SCENARIO_VALIDATE,
            ]],
            [['report_code'], 'required', 'on' => [
                self::SCENARIO_REPORT_JSON,
            ]],
            [['hash_code','report_code'], 'string'],
            [['code'], 'integer'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'hash_code' => Yii::t('openBanking', 'hash_code'),
        ];
    }


    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_REQUEST] = ['hash_code'];
        $scenarios[self::SCENARIO_VALIDATE] = ['hash_code'];
        $scenarios[self::SCENARIO_STATUS] = ['hash_code'];
        $scenarios[self::SCENARIO_REGENERATE_REPORT] = ['hash_code'];
        $scenarios[self::SCENARIO_REPORT_JSON] = ['report_code'];
        $scenarios[self::SCENARIO_RENEW_TOKEN] = ['hash_code'];

        return $scenarios;
    }


}
