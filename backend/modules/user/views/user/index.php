<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '用户管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'user_id',
            'mobile',
            'nickname',
            [
                'label' => '头像', // 列名
                'attribute' => 'avatar', // 字段名， 与数据库对应
                'visible' => true, // 列是否可见
                'format' => 'raw',
                //'contentOptions' => ['style' => 'width:10%'],
            ],
            'gender',
            'birthday',
            'region',
            'sign',
            'star',
            'verify',
            'user_level',
            [
                'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
                'attribute' => 'status', // 字段名， 与数据库对应
                'filter' => User::$status, // 过滤条件
                'visible' => true, // 列是否可见
                'format' => 'raw',
                'value' => function ($data) {
                    return User::$status[$data->status]; // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
