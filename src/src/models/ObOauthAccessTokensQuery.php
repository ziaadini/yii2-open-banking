<?php

namespace sadi01\openbanking\models;

/**
 * This is the ActiveQuery class for [[ObOauthAccessTokens]].
 *
 * @see ObOauthAccessTokens
 */
class ObOauthAccessTokensQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->onCondition(['<>', ObOauthAccessTokens::tableName() . '.status', ObOauthAccessTokens::STATUS_DELETED]);
    }

    /**
     * {@inheritdoc}
     * @return ObOauthAccessTokens[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ObOauthAccessTokens|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byClientId($client_id)
    {
        return $this->andWhere([ObOauthAccessTokens::tableName() . '.client_id' => $client_id]);
    }

    public function byScope($scope)
    {
        return $this->andWhere(['like', ObOauthAccessTokens::tableName() . '.scope', $scope]);
    }

    public function notExpire(): ObOauthAccessTokensQuery
    {
        return $this->andWhere(['>', ObOauthAccessTokens::tableName() . '.expires', date('Y-m-d H:i:s', time())]);
    }


}