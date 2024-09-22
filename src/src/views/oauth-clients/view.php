<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;
use yii\web\YiiAsset;
use sadi01\openbanking\models\ObOauthClients;

/** @var View $this */
/** @var sadi01\openbanking\models\ObOauthClients $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('openBanking', 'Ob Oauth Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="ob-oauth-clients-view card">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>
        <p>
            <?= Html::a(Yii::t('openBanking', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('openBanking', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('openBanking', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'client_id',
                'base_url:url',
                'client_secret',
                'grant_types',
                'scope',
                'username',
                'password',
                //'add_on',
            ],
        ]) ?>
    </div>
</div>