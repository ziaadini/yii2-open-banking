<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;
use sadi01\openbanking\models\ObOauthClients;

/** @var View $this */
/** @var sadi01\openbanking\models\ObOauthClients $model */
/** @var ActiveForm $form */
?>

<div class="ob-oauth-clients-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

    if ($platform == ObOauthClients::PLATFORM_FARABOOM) { ?>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'base_url')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'app_key')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'app_secret')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-4">
                <?= $form->field($model, 'bank_id')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'client_device_id')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-4">
                <?= $form->field($model, 'client_platform_type')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-4">
                <?= $form->field($model, 'client_user_id')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'device_id')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-4">
                <?= $form->field($model, 'token_id')->passwordInput(['maxlength' => true]) ?>
            </div>
        </div>


    <?php } elseif ($platform == ObOauthClients::PLATFORM_FINNOTECH) { ?>
        <div class="row">
            <div class="col-sm-12">
                <?= $form->field($model, 'base_url')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'app_key')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'app_password')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-sm-4">
                <?= $form->field($model, 'nid')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'finno_limit')->textInput() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'finno_count')->textInput() ?>
            </div>
        </div>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('openBanking', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>