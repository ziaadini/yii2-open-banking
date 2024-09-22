<?php
namespace sadi01\openbanking\models;

class BasePlatform extends \yii\db\ActiveRecord
{

    const PLATFORM_FINNOTECH = 1;
    const PLATFORM_FARABOOM = 2;
    const PLATFORM_SHAHIN = 3;
    const PLATFORM_SHAHKAR = 4;

    public $id;
    public $name;
    public $base_url;
    public $api_key;
    public $file;



    public function rules()
    {
        return [
            [['name', 'base_url','api_key','provider'], 'required'],
            [['name', 'base_url','api_key'], 'string'],
            [['provider'],'in', 'range' => array_keys(self::itemAlias('Provider'))],
            [['file'],'file'],

        ];


    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('openBanking', 'ID'),
            'name' => Yii::t('openBanking', 'Name'),
            'base_url' => Yii::t('openBanking', 'Base Url'),
            'api_key' => Yii::t('openBanking', 'Api Key'),
            'file' => Yii::t('openBanking', 'File'),
            'provider' => Yii::t('openBanking', 'Provider'),
        ];


    }


    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Provider' => [
                self::PLATFORM_FINNOTECH => Yii::t('openBanking', 'Finnotech'),
                self::PLATFORM_FARABOOM=> Yii::t('openBanking', 'Faraboom'),
                self::PLATFORM_SHAHIN=> Yii::t('openBanking', 'Shahin'),
                self::PLATFORM_SHAHKAR=> Yii::t('openBanking', 'Shahkar')
            ],
        ];

        if (isset($code))
            return $_items[$type][$code] ?? false;
        else
            return $_items[$type] ?? false;
    }

}
