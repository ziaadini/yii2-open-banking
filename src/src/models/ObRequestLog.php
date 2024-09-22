<?php

namespace sadi01\openbanking\models;

use common\behaviors\Jsonable;
use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "{{%ob_request_log}}".
 *
 * @property int $id
 * @property int $client_id
 * @property int $service_type
 * @property int $status
 * @property string|null $message
 * @property string|null $track_id
 * @property string $data
 * @property string $url
 * @property string $response
 * @property string $method
 * @property int $slave_id
 * @property string $headers
 * @property int $created_at
 * @property int $created_by
 *
 * @property User $createdBy
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior;
 */
class ObRequestLog extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    const FARABOOM_GET_TOKEN = 1;
    const FARABOOM_DEPOSIT_TO_SHABA = 2;
    const FARABOOM_SHABA_TO_DEPOSIT = 3;
    const FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT = 4;
    const FARABOOM_DEPOSIT_HOLDER = 5;
    const FARABOOM_PAYA = 6;
    const FARABOOM_SATNA = 7;
    const FARABOOM_CHECK_INQUIRY_RECEIVER = 8;
    const FARABOOM_SHABA_INQUIRY = 9;
    const FARABOOM_MATCH_NATIONAL_CODE_MOBILE = 10;
    const FARABOOM_CART_TO_SHABA = 11;
    const FARABOOM_BATCH_PAYA = 12;
    const FARABOOM_REPORT_PAYA_TRANSACTIONS = 13;
    const FARABOOM_PAYA_TRANSFER = 14;
    const FARABOOM_CANCLE_PAYA = 15;
    const FARABOOM_REPORT_SATNA_TRANSFER = 16;
    const FARABOOM_BATCH_SATNA = 17;
    const FARABOOM_INTERNAL_TRANSFER = 18;
    const FARABOOM_BATCH_INTERNAL_TRANSFER = 19;
    const FARABOOM_DEPOSITS = 20;

    const SCENARIO_DELETE = 'delete';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ob_request_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'service_type', 'status', 'data', 'response', 'url','method','headers','slave_id'], 'required'],
            [['client_id', 'service_type', 'status', 'created_at', 'created_by','slave_id'], 'integer'],
            [['message'], 'string', 'max' => 100],
            //[['data','headers'], 'string', 'max' => 1000],
            [['response','data','headers'], 'safe'],
            [['method'], 'string', 'max' => 5],
            [['url'], 'string', 'max' => 255],
            [['track_id'], 'string', 'max' => 30],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DELETE] = ['!status'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('openBanking', 'ID'),
            'client_id' => Yii::t('openBanking', 'Client ID'),
            'service_type' => Yii::t('openBanking', 'Service Type'),
            'status' => Yii::t('openBanking', 'Status'),
            'message' => Yii::t('openBanking', 'Message'),
            'track_id' => Yii::t('openBanking', 'Track ID'),
            'url' => Yii::t('openBanking', 'Url'),
            'data' => Yii::t('openBanking', 'Data'),
            'method' => Yii::t('openBanking', 'Method'),
            'slave_id' => Yii::t('openBanking', 'Slave ID'),
            'headers' => Yii::t('openBanking', 'Headers'),
            'response' => Yii::t('openBanking', 'Response'),
            'created_at' => Yii::t('openBanking', 'Created At'),
            'created_by' => Yii::t('openBanking', 'Created By'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ObRequestLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new ObRequestLogQuery(get_called_class());
        return $query->active();
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_ACTIVE => Yii::t('openBanking', 'Active'),
                self::STATUS_DELETED => Yii::t('openBanking', 'Deleted')
            ],
            'StatusClass' => [
                self::STATUS_ACTIVE => 'success',
                self::STATUS_DELETED => 'danger'
            ],
            'StatusColor' => [
                self::STATUS_ACTIVE => '#23a665',
                self::STATUS_DELETED => '#ff5050',
            ],
            'ServiceType' => [
                self::FARABOOM_DEPOSIT_TO_SHABA => Yii::t('openBanking', 'Service Deposit To Shaba'),
                self::FARABOOM_SHABA_TO_DEPOSIT => Yii::t('openBanking', 'Service Shaba To Deposit'),
                self::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT => Yii::t('openBanking', 'Service Match National Code Account'),
                self::FARABOOM_DEPOSIT_HOLDER => Yii::t('openBanking', 'Service Deposit Holder'),
                self::FARABOOM_PAYA => Yii::t('openBanking', 'Service Paya'),
                self::FARABOOM_SATNA => Yii::t('openBanking', 'Service Satna'),
                self::FARABOOM_CHECK_INQUIRY_RECEIVER => Yii::t('openBanking', 'Service Check Inquery Receiver'),
                self::FARABOOM_SHABA_INQUIRY => Yii::t('openBanking', 'Service Shaba Inquiry'),
                self::FARABOOM_MATCH_NATIONAL_CODE_MOBILE => Yii::t('openBanking', 'Service Match National Code Mobile'),
                self::FARABOOM_CART_TO_SHABA => Yii::t('openBanking', 'Service Cart To Shaba'),
                self::FARABOOM_BATCH_PAYA => Yii::t('openBanking', 'Service Batch Paya'),
                self::FARABOOM_REPORT_PAYA_TRANSACTIONS => Yii::t('openBanking', 'Service Report Paya Transactions'),
                self::FARABOOM_PAYA_TRANSFER => Yii::t('openBanking', 'Service Paya Transfer'),
                self::FARABOOM_CANCLE_PAYA => Yii::t('openBanking', 'Service Cancel Paya'),
                self::FARABOOM_REPORT_SATNA_TRANSFER => Yii::t('openBanking', 'Service Report Satna Transfer'),
                self::FARABOOM_BATCH_SATNA => Yii::t('openBanking', 'Service Batch Satna'),
                self::FARABOOM_INTERNAL_TRANSFER => Yii::t('openBanking', ' Internal Transfer'),
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => Yii::t('openBanking', 'Batch Internal Transfer'),
                self::FARABOOM_DEPOSITS => Yii::t('openBanking', 'Deposits'),

            ],
        ];

        if (isset($code))
            return $_items[$type][$code] ?? false;
        else
            return $_items[$type] ?? false;
    }

    function maskSensitiveData($array, $sensitiveKeys = ['password', 'Token-Id', 'Authorization']) {
        foreach ($array as $key => &$value) {
            if (in_array($key, $sensitiveKeys)) {
                $value = '*******';
            } elseif (is_array($value)) {
                $value = $this->maskSensitiveData($value, $sensitiveKeys);
            }
        }
        return $array;
    }

    public function beforeSave($insert): bool
    {
        $this->headers = $this->maskSensitiveData($this->headers);
        $this->data = $this->maskSensitiveData($this->data);

        return parent::beforeSave($insert);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);

    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                //'value' => new Expression('NOW()'),
            ],
            'BlameableBehavior' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false
                //'value' => Yii::$app->user->id,
            ],
            /*'Jsonable' => [
                'class' => Jsonable::class,
                'jsonAttributes' => [
                    'response' => [
                    ],
                ],
            ],*/
        ]);
    }

    /**
     * @return string[]
     */
    public function fields(): array
    {
        $fields = [
            'id',
        ];

        return $fields;
    }

    /**
     * @return string[]
     */
    public function extraFields(): array
    {
        $extraFields = [

        ];

        return $extraFields;
    }
}