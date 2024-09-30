<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;
use sadi01\openbanking\models\ObRequestLog;

/** @var View $this */
/** @var sadi01\openbanking\models\ObRequestLogSearch $model */
/** @var ActiveForm $form */
?>

<div class="ob-request-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'service_type') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'message') ?>

    <?= $form->field($model, 'slave_id') ?>

    <?php // echo $form->field($model, 'track_id') ?>

    <?php // echo $form->field($model, 'request_info') ?>

    <?php // echo $form->field($model, 'response_info') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('openBanking', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('openBanking', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>