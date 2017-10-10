<?php

namespace common\models;

use OAuth2\Storage\UserCredentialsInterface;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $user_id
 * @property string $mobile
 * @property string $password
 * @property string $salt
 * @property string $nickname
 * @property string $avatar
 * @property string $gender
 * @property string $birthday
 * @property string $region
 * @property string $sign
 * @property string $star
 * @property integer $verify
 * @property integer $user_level
 * @property integer $status
 * @property integer $follow
 * @property integer $fans
 * @property integer $like
 * @property string $create_time
 * @property string $update_time
 */
class User extends ActiveRecord implements IdentityInterface, UserCredentialsInterface
{
    // 单一设备登录
    const SINGLE_LOGIN = true;

    //0-未选择 1-男 2-女
    const GENDER_DEFAULT = 0;
    const GENDER_MAN = 1;
    const GENDER_WONMAN = 2;

    public static $gender = [
        self::GENDER_DEFAULT => '未选择',
        self::GENDER_MAN => '男',
        self::GENDER_WONMAN => '女',
    ];

    // 0-未认证 1-待审核 2-已认证 3-认证失败
    const VERIFY_NO = 0;
    const VERIFY_WAIT = 1;
    const VERIFY_SUCCESS = 2;
    const VERIFY_FAIL = 3;
    
    public static $verify = [
        self::VERIFY_NO => '未认证',
        self::VERIFY_WAIT => '待审核',
        self::VERIFY_SUCCESS => '已认证',
        self::VERIFY_FAIL => '认证失败',
    ];

    // 1普通 2认证 3明星
    const LEVEL_NOMAREL = 1;
    const LEVEL_VERIFY = 2;
    const LEVEL_STAR = 3;
    public static $level = [
        self::LEVEL_NOMAREL => '普通',
        self::LEVEL_VERIFY => '认证',
        self::LEVEL_STAR => '明星',
    ];

    //  0-正常 1-关闭
    const STATUS_Y = 0;
    const STATUS_N = 1;
    public static $status = [
        self::STATUS_Y => '激活',
        self::STATUS_N => '禁用',
    ];

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
            [['mobile', 'password', 'salt', 'create_time', 'update_time'], 'required'],
            [['gender'], 'string'],
            [['birthday', 'create_time', 'update_time'], 'safe'],
            [['verify', 'user_level', 'status', 'follow', 'fans', 'like'], 'integer'],
            [['mobile', 'salt'], 'string', 'max' => 16],
            [['password', 'nickname', 'star'], 'string', 'max' => 32],
            [['avatar', 'sign'], 'string', 'max' => 128],
            [['region'], 'string', 'max' => 256],
            [['mobile'], 'unique'],
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
            'salt' => Yii::t('app', '加密盐'),
            'nickname' => Yii::t('app', '昵称'),
            'avatar' => Yii::t('app', '用户头像路径'),
            'gender' => Yii::t('app', '性别'),
            'birthday' => Yii::t('app', '出生日期'),
            'region' => Yii::t('app', '所在地域'),
            'sign' => Yii::t('app', '签名'),
            'star' => Yii::t('app', '星座'),
            'verify' => Yii::t('app', '是否认证'),
            'user_level' => Yii::t('app', '级别'),
            'status' => Yii::t('app', '用户状态'),
            'follow' => Yii::t('app', '关注的人数'),
            'fans' => Yii::t('app', '粉丝数'),
            'like' => Yii::t('app', '被赞数'),
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
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
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

        $tokenDetail = $oauthServer->getAccessTokenData($oauthRequest);
        $retval = self::findOne($tokenDetail['user_id']);

        if (self::SINGLE_LOGIN) {
            self::singleLogin($tokenDetail['user_id'], $token);
        }

        return $retval;

    }

    /**
     * 单地登录
     * @param $userid
     * @param $token
     * @return boolean
     */
    public static function singleLogin($userid = 0, $token = '') {
        Yii::$app->db->createCommand()->delete(
            'oauth_access_tokens',
            "user_id = :userid and access_token != :token",
            [':userid' => $userid, ':token' => $token]
        )->execute();
    }

    /**
     * Implemented for Oauth2 Interface
     */
    public function checkUserCredentials($username, $password)
    {
        $user = static::findByUsername($username);
        if (empty($user)) {
            $user = static::findByMobile($username);
            if (empty($user)) {
                return false;
            }
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
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
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
