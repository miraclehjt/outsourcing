<?php

use common\models\Merchant;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Merchant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '商户列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-view">

    <p>
        <?= Html::a(Yii::t('app', '修改'), ['update', 'id' => $model->merchant_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '导入价目表'), ['in', 'id' => $model->merchant_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'merchant_id',
            'name',
            'logo',
            'address',
            'lng',
            'lat',
            [
                'attribute' => 'status',
                'label' => '状态',
                'value' => Merchant::$status[$model->status],
            ],
            'description',
            'create_time',
            'update_time',
        ],
    ]) ?>
</div>

<div class="merchant-view">
    <h3>价目表:</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'merchant_id',
                'filter' => false,
            ],
            'start',
            'end',
            'create_time',
            'update_time',
            [
                //'class' => ActionColumn::className(),// you may configure additional properties here
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作', // 列名
                'template' => '{delete}',
                'contentOptions' => ['style' => 'width:10%'],

                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', '删除'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', '确认删除?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => "btn btn-danger btn-sm"
                        ];

                        return Html::a('删除', $url, $options);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
