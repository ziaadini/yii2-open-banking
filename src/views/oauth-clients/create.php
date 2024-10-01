<?php

use yii\helpers\Html;
use yii\web\View;
use sadi01\openbanking\models\ObOauthClients;

/** @var View $this */
/** @var Integer $platform */
/** @var sadi01\openbanking\models\ObOauthClients $model */

$this->title = Yii::t('openBanking', 'Create Ob Oauth Clients');
$this->params['breadcrumbs'][] = ['label' => Yii::t('openBanking', 'Ob Oauth Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ob-oauth-clients-create card">
    <div class="card-header">
        <h5><?= Html::encode($this->title) ?></h5>
    </div>
    <div class="card-body">
        <?= $this->render(ObOauthClients::itemAlias('View',$platform), [
            'model' => $model
        ]) ?>
    </div>
</div>