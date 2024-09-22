<?php

namespace sadi01\openbanking\models;

use common\models\User;
use Yii;
use common\behaviors\Jsonable;

/**
 * This is the model class for table "{{%ob_oauth_refresh_tokens}}".
 *
 * @property string $refresh_token
 * @property string $client_id
 * @property string $expires
 * @property int $user_id
 * @property string|null $scope
 * @property string|null $add_on
 *
 * @mixin Jsonable;
 */
class ObOauthRefreshTokens extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    const SCENARIO_DELETE = 'delete';

    public ?string $national_code = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ob_oauth_refresh_tokens}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['refresh_token', 'client_id','user_id'], 'required'],
            [['expires', 'add_on'], 'safe'],
            [['user_id'], 'integer'],
            [['refresh_token'], 'string', 'max' => 2048],
            [['client_id'], 'string', 'max' => 32],
            [['national_code'], 'string', 'max' => 10],
            [['scope'], 'string', 'max' => 2000],
            [['refresh_token'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'refresh_token' => Yii::t('openBanking', 'Refresh Token'),
            'client_id' => Yii::t('openBanking', 'Client ID'),
            'expires' => Yii::t('openBanking', 'Expires'),
            'scope' => Yii::t('openBanking', 'Scope'),
            'user_id' => Yii::t('openBanking', 'User ID'),
            'add_on' => Yii::t('openBanking', 'Add On'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ObOauthRefreshTokensQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new ObOauthRefreshTokensQuery(get_called_class());
        return $query;
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
        ];

        if (isset($code))
            return $_items[$type][$code] ?? false;
        else
            return $_items[$type] ?? false;
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'Jsonable' => [
                'class' => Jsonable::class,
                'jsonAttributes' => [
                    'add_on' => [
                        'national_code'
                    ],
                ],
            ],
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