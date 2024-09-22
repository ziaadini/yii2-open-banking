<?php

namespace sadi01\openbanking\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use sadi01\openbanking\models\ObRequestLog;

/**
 * ObRequestLogSearch represents the model behind the search form of `sadi01\openbanking\models\ObRequestLog`.
 */
class ObRequestLogSearch extends ObRequestLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'service_type', 'status', 'created_at', 'created_by','slave_id'], 'integer'],
            [['url','message', 'track_id', 'data', 'response','headers','method'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ObRequestLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'client_id' => $this->client_id,
            'service_type' => $this->service_type,
            'status' => $this->status,
            'method' => $this->method,
            'method' => $this->slave_id,
            'headers' => $this->headers,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'track_id', $this->track_id])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'data', $this->data])
            ->andFilterWhere(['like', 'response', $this->response]);

        return $dataProvider;
    }
}