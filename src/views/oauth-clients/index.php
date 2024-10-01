<?php
use sadi01\openbanking\models\ObOauthClients;
use sadi01\openbanking\components\OpenBanking;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\web\View;
use yii\data\ActiveDataProvider;
use sadi01\openbanking\models\ObOauthClientsSearch;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var View $this */
/** @var sadi01\openbanking\models\ObOauthClientsSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('openBanking', 'Ob Oauth Clients');
$this->params['breadcrumbs'][] = ['label' => 'سرویس های بانکی', 'url' => '/openbanking'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ob-oauth-clients-index card">
    <div class="card-header d-flex justify-content-between">
        <h5><?= Html::encode($this->title) ?></h5>

        <?php if (Yii::$app->openBanking->bsVersion == OpenBanking::BS_4): ?>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                ثبت سرویس دهنده
            </button>
            <div class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= Url::to(['create', 'platform' => ObOauthClients::PLATFORM_FARABOOM]) ?>">فرابوم</a></li>
                <li><a class="dropdown-item" href="<?= Url::to(['create', 'platform' => ObOauthClients::PLATFORM_FINNOTECH]) ?>">فینوتک</a></li>
                <li><a class="dropdown-item" href="<?= Url::to(['create', 'platform' => ObOauthClients::PLATFORM_IRABIAN]) ?>">ایرانیان</a></li>
            </div>
        </div>
        <?php endif; ?>

        <?php if (Yii::$app->openBanking->bsVersion == OpenBanking::BS_5): ?>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light"
                    data-bs-toggle="dropdown" aria-expanded="false">
                ثبت سرویس دهنده
            </button>
            <ul class="dropdown-menu" style="">
                <li><a class="dropdown-item" href="<?= Url::to(['create', 'platform' => ObOauthClients::PLATFORM_FARABOOM]) ?>">فرابوم</a></li>
                <li><a class="dropdown-item" href="<?= Url::to(['create', 'platform' => ObOauthClients::PLATFORM_FINNOTECH]) ?>">فینوتک</a></li>
                <li><a class="dropdown-item" href="<?= Url::to(['create', 'platform' => ObOauthClients::PLATFORM_IRABIAN]) ?>">ایرانیان</a></li>
            </ul>
        </div>
        <?php endif; ?>

    </div>
    <div class="card-body">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'attribute' => 'client_id',
                    'value' => function ($model) {
                        return ObOauthClients::itemAlias('Client', $model->client_id);
                    }
                ],
                'base_url:url',
                //'client_secret',
                // 'grant_types',
                //'scope',
                //'username',
                //'password',
                //'add_on',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, ObOauthClients $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>