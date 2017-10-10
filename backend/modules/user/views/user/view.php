<?php

use common\models\Merchant;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->nickname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'mobile',
            'nickname',
            'avatar',
            [
                'attribute' => 'gender',
                'label' => '性别',
                'value' => User::$gender[$model->gender],
            ],
            'birthday',
            'region',
            'sign',
            'star',
            'verify',
            [
                'attribute' => 'user_level',
                'label' => '级别',
                'value' => User::$level[$model->user_level],
            ],
            'status',
            [
                'attribute' => 'status',
                'label' => '状态',
                'value' => User::$status[$model->status],
            ],
            'follow',
            'fans',
            'like',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
