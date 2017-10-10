<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%merchant_price}}".
 *
 * @property integer $mp_id
 * @property integer $merchant_id
 * @property integer $start
 * @property integer $end
 * @property integer $price
 * @property string $status
 * @property string $create_time
 * @property string $update_time
 */
class MerchantPrice extends \yii\db\ActiveRecord
{
    const EXCEL_MAX_COL = 2;

    const STATUS_Y = 'Y';
    const STATUS_N = 'N';

    public static $status = [
        self::STATUS_Y => '激活',
        self::STATUS_N => '禁用',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id', 'start', 'end'], 'integer'],
            [['create_time', 'update_time'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mp_id' => Yii::t('app', '自增ID'),
            'merchant_id' => Yii::t('app', '商家ID'),
            'start' => Yii::t('app', '开始时间'),
            'end' => Yii::t('app', '结束时间'),
            'status' => Yii::t('app', 'status Y - N'),
            'create_time' => Yii::t('app', '添加时间'),
            'update_time' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * @inheritdoc
     * @return MerchantPriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MerchantPriceQuery(get_called_class());
    }
}
