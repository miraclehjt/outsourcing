<?php

use common\models\Merchant;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\MerchantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '商户列表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-index">
    <p>
        <?= Html::a(Yii::t('app', '添加商户'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'merchant_id',
            'name',
            [
                'attribute' => 'logo',
                'visible' => true, // 列是否可见
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::img('/uploads/'.$data->logo, ['style' => [
                        'width' => '40px'
                    ]]);
                }
            ],
            'address',
            [
                'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
                'attribute' => 'status', // 字段名， 与数据库对应
                'filter' => Merchant::$status, // 过滤条件
                'visible' => true, // 列是否可见
                'format' => 'raw',
                'value' => function ($data) {
                    return Merchant::$status[$data->status]; // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                },
            ],
            'create_time',
            [
                //'class' => ActionColumn::className(),// you may configure additional properties here
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作', // 列名
                'template' => '{view} {update}',
                'contentOptions' => ['style' => 'width:10%'],

                'buttons' => [
                    // 下面代码来自于 yii\grid\ActionColumn 简单修改了下
                    // $url Grid-View-Demo/my-view
                    // $model 当前行 的数据模型
                    // $key 当前行ID
                    'view' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', '查看'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' => "btn btn-success btn-sm"
                        ];

                        return Html::a('查看', $url, $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', '编辑'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' => "btn btn-warning btn-sm"
                        ];

                        return Html::a('编辑', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
