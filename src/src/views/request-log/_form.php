<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;
use sadi01\openbanking\models\ObRequestLog;

/** @var View $this */
/** @var sadi01\openbanking\models\ObRequestLog $model */
/** @var ActiveForm $form */
?>

<div class="ob-request-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->textInput() ?>

    <?= $form->field($model, 'service_type')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'track_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slave_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput() ?>

    <?= $form->field($model, 'request_info')->textInput() ?>

    <?= $form->field($model, 'response_info')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('openBanking', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>