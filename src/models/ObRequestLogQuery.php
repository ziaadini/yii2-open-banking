<?php

namespace sadi01\openbanking\models;

/**
 * This is the ActiveQuery class for [[ObRequestLog]].
 *
 * @see ObRequestLog
 */
class ObRequestLogQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->onCondition(['<>', ObRequestLog::tableName() . '.status', ObRequestLog::STATUS_DELETED]);
    }

    /**
     * {@inheritdoc}
     * @return ObRequestLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ObRequestLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}