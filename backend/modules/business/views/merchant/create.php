<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Merchant */

$this->title = Yii::t('app', '添加商户');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '商户列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if (Yii::$app->getSession()->hasFlash('success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-success',],
        'body' => Yii::$app->getSession()->getFlash('success'), //消息体,
    ]);
}

if (Yii::$app->getSession()->hasFlash('danger')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-danger',],
        'body' => Yii::$app->getSession()->getFlash('danger'), //消息体,
    ]);
}
?>

<div class="merchant-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
