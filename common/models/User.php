<?php

namespace common\models;

use OAuth2\Storage\UserCredentialsInterface;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UnauthorizedHttpException;

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
class User extends ActiveRecord implements IdentityInterface, UserCredentialsInterface
{

    public function init()
    {
        parent::init();
    }

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
            [['password', 'nickname', 'email'], 'string', 'max' => 32],
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
            'email' => Yii::t('app', '邮箱'),
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

    public static function findByUsername($username) {
        return static::findOne(['nickname' => $username]);
    }

    public static function findByMobile($mobile) {
        return static::findOne(['mobile' => $mobile]);
    }

    public static function findByEmail($email) {
        return static::findOne(['email' => $email]);
    }

    /**
     * 验证密码
     * @param $password 用户传过来的密码
     * @return bool
     */
    public function validatePassword($password) {
        if ($this->password != md5($password)) {
            return false;
        }

        return true;
    }

    /**
     * Implemented for Oauth2 Interface
     * @param $token
     * @param $type
     * @return object
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $retval = null;

        $oauthServer = Yii::$app->getModule('oauth2')->getServer();
        $oauthRequest = Yii::$app->getModule('oauth2')->getRequest();

        $oauthServer->verifyResourceRequest($oauthRequest);

        $token = $oauthServer->getAccessTokenData($oauthRequest);
        $retval = self::findOne($token['user_id']);

        return $retval;

    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function checkUserCredentials($username, $password)
    {
        $user = static::findByUsername($username);
        if (empty($user)) {
            return false;
        }
        return $user->validatePassword($password);
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function getUserDetails($username)
    {
        $user = static::findByUsername($username);
        return ['user_id' => $user->getId()];
    }

    /**
     * 生成 api_token
     */
    public function generateApiToken() {
        $this->access_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * 校验api_token是否有效
     * @param $token string
     * @return boolean
     */
    public static function apiTokenIsValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.apiTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
