<?php

use yii\helpers\Html;
use yii\web\View;
use sadi01\openbanking\models\ObRequestLog;

/** @var View $this */
/** @var sadi01\openbanking\models\ObRequestLog $model */

$this->title = Yii::t('openBanking', 'Create Ob Request Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('openBanking', 'Ob Request Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ob-request-log-create card">
    <div class="card-header"><h3><?= Html::encode($this->title) ?></h3></div>
    <div class="card-body">
        <?= $this->render('_form', [
        'model' => $model,
        ]) ?>
    </div>
</div>