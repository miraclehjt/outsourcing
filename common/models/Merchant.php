<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\httpclient\Client;

/**
 * This is the model class for table "{{%merchant}}".
 *
 * @property integer $merchant_id
 * @property string $name
 * @property string $logo
 * @property string $address
 * @property string $lng
 * @property string $lat
 * @property string $status
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 */
class Merchant extends ActiveRecord
{
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
        return '{{%merchant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['name'], 'string', 'max' => 50],
            // [['logo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, jpeg, png', 'mimeTypes' => 'image/jpeg, image/jpg, image/png'],
            [['logo', 'address', 'description'], 'string', 'max' => 255],
            [['lng', 'lat'], 'string', 'max' => 21],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'merchant_id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '名称'),
            'logo' => Yii::t('app', 'logo'),
            'address' => Yii::t('app', '地址'),
            'lng' => Yii::t('app', '经度'),
            'lat' => Yii::t('app', '纬度'),
            'status' => Yii::t('app', '状态'),
            'description' => Yii::t('app', '描述'),
            'create_time' => Yii::t('app', '创建时间'),
            'update_time' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * @inheritdoc
     * @return MerchantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MerchantQuery(get_called_class());
    }

    public function geocodingAddress() {
        $http = new Client();
        try {
            $request = $http->createRequest()
                ->setMethod('get')
                ->setUrl(Yii::$app->params['baidu.map.gencode.api'])
                ->setData([
                    'ak' => Yii::$app->params['baidu.map.ak'],
                    'address' => $this->address
                ]);

            $response = $request->send();
            $addressDetail = $response->getData();
            if ($addressDetail['status'] != 0) {
                throw new \Exception('获取地址错误', -1);
            }

            return $addressDetail['result']['location'];
        } catch (\Exception $e) {
            Yii::error('获取地址错误', __METHOD__);
        }
    }
}
