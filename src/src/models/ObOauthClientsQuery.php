<?php

namespace sadi01\openbanking\models;

/**
 * This is the ActiveQuery class for [[ObOauthClients]].
 *
 * @see ObOauthClients
 */
class ObOauthClientsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->onCondition(['<>', ObOauthClients::tableName() . '.status', ObOauthClients::STATUS_DELETED]);
    }

    /**
     * {@inheritdoc}
     * @return ObOauthClients[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ObOauthClients|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byClient($client_id)
    {
        return $this->andWhere([ObOauthClients::tableName() . '.client_id' => $client_id]);
    }
}