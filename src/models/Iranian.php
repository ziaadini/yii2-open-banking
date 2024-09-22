<?php

namespace sadi01\openbanking\models;

use Yii;
use yii\base\Model;

class Iranian extends Model
{
    public $code;
    public $api_key;


    const SCENARIO_REQUEST = 'request';
    const SCENARIO_RENEW_TOKEN = 'renew-token';
    const SCENARIO_VALIDATE = 'validate';
    const SCENARIO_STATUS = 'status';
    const SCENARIO_REGENERATE_REPORT = 're-generate-report';
    const SCENARIO_REPORT_XML = 'xml-report';
    const SCENARIO_REPORT_PDF = 'pdf-report';


    public function rules()
    {
        return [
            [['code','api_key'], 'required', 'on' => [
                self::SCENARIO_VALIDATE,
                self::SCENARIO_STATUS,
                self::SCENARIO_REGENERATE_REPORT,
                self::SCENARIO_REPORT_XML,
                self::SCENARIO_REPORT_PDF,
                self::SCENARIO_RENEW_TOKEN
            ]],
            [['code'], 'integer'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'code' => Yii::t('openBanking', 'Code'),
        ];
    }


    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_REQUEST] = ['code'];
        $scenarios[self::SCENARIO_VALIDATE] = ['code'];
        $scenarios[self::SCENARIO_STATUS] = ['code'];
        $scenarios[self::SCENARIO_REGENERATE_REPORT] = ['code'];
        $scenarios[self::SCENARIO_REPORT_XML] = ['code'];
        $scenarios[self::SCENARIO_REPORT_PDF] = ['code'];
        $scenarios[self::SCENARIO_RENEW_TOKEN] = ['code'];

        return $scenarios;
    }
}
