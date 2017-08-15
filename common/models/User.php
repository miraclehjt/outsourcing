<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $user_id
 * @property string $mobile
 * @property string $password
 * @property string $access_token
 * @property string $nickname
 * @property string $avatar
 * @property string $gender
 * @property string $birthday
 * @property string $region
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile', 'password', 'create_time'], 'required'],
            [['gender'], 'string'],
            [['birthday', 'create_time', 'update_time'], 'safe'],
            [['status'], 'integer'],
            [['mobile'], 'string', 'max' => 16],
            [['password', 'nickname'], 'string', 'max' => 32],
            [['access_token'], 'string', 'max' => 40],
            [['avatar'], 'string', 'max' => 128],
            [['region'], 'string', 'max' => 256],
            [['mobile'], 'unique'],
            [['access_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', '用户ID'),
            'mobile' => Yii::t('app', '手机号'),
            'password' => Yii::t('app', '登陆密码'),
            'access_token' => Yii::t('app', '用户访问令牌'),
            'nickname' => Yii::t('app', '昵称'),
            'avatar' => Yii::t('app', '用户头像路径'),
            'gender' => Yii::t('app', '性别 0-未选择 1-男 2-女'),
            'birthday' => Yii::t('app', '出生日期'),
            'region' => Yii::t('app', '所在地域'),
            'status' => Yii::t('app', '用户状态 0-正常 1-关闭'),
            'create_time' => Yii::t('app', '注册时间'),
            'update_time' => Yii::t('app', '更新时间'),
        ];
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }
}
