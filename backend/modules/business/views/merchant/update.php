<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Merchant */

$this->title = Yii::t('app', '更新 {modelClass}: ', [
    'modelClass' => 'Merchant',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->merchant_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="merchant-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
