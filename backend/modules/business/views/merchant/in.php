<?php

use common\models\Merchant;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Merchant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchant-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <input style="margin-bottom: 10px;" name="price_file" value="" type="file" />

    <div class="form-group">
        <button class="btn btn-primary" type="submit">导入</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
