<?php

use sadi01\openbanking\models\BaseOpenBanking;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;
use yii\web\YiiAsset;
use sadi01\openbanking\models\ObRequestLog;

/** @var View $this */
/** @var sadi01\openbanking\models\ObRequestLog $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('openBanking', 'Ob Request Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="ob-request-log-view card">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //  'id',
                [
                    'attribute' => 'client_id',
                    'value' => BaseOpenBanking::itemAlias('Platform', $model->client_id),
                ],
                [
                    'attribute' => 'service_type',
                    'value' => BaseOpenBanking::itemAlias('ServiceType', $model->service_type),
                ],
                'status',
                'message',
                'track_id',
                'slave_id',
                'url',
                [
                    'attribute' => 'headers',
                    'value' =>json_encode($model->headers,JSON_UNESCAPED_UNICODE),
                ],
                [
                    'attribute' => 'data',
                    'value' =>json_encode($model->data,JSON_UNESCAPED_UNICODE),
                ],
                [
                    'attribute' => 'response',
                    'value' =>json_encode($model->response,JSON_UNESCAPED_UNICODE),
                ],
                'created_at:datetime',
                [
                    'attribute' => 'created_by',
                    'value' => $model->createdBy->username,
                ]
            ],
        ]) ?>
    </div>
</div>