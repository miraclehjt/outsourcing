<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 2 => '2', 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sign')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'star')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'verify')->dropDownList(User::$verify) ?>

    <?= $form->field($model, 'status')->dropDownList(User::$status) ?>

    <?= $form->field($model, 'user_level')->dropDownList(User::$level) ?>

    <?= $form->field($model, 'follow')->textInput() ?>

    <?= $form->field($model, 'fans')->textInput() ?>

    <?= $form->field($model, 'like')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
