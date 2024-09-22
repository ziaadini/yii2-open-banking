<?php

use yii\helpers\Html;
use yii\web\View;
use sadi01\openbanking\models\ObRequestLog;

/** @var View $this */
/** @var sadi01\openbanking\models\ObRequestLog $model */

$this->title = Yii::t('openBanking', 'Update Ob Request Log: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('openBanking', 'Ob Request Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('openBanking', 'Update');
?>
<div class="ob-request-log-update card">
    <div class="card-header"><h3><?= Html::encode($this->title) ?></h3></div>
    <div class="card-body">
        <?= $this->render('_form', [
        'model' => $model,
        ]) ?>
    </div>
</div>