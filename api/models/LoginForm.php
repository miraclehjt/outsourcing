<?php
namespace api\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $mobile;
    public $password;

    /* @var $_user User */
    private $_user;

    const GET_API_TOKEN = 'generate_api_token';

    public function init ()
    {
        parent::init();
        $this->on(self::GET_API_TOKEN, [$this, 'onGenerateApiToken']);
    }

    public function attributeLabels()
    {
        return [
            'mobile' => '手机号',
            'password' => '密码',
        ];
    }

    /**
     * @inheritdoc
     * 对客户端表单数据进行验证的rule
     */
    public function rules()
    {
        return [
            [['mobile', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * 自定义的密码认证方法
     * @param $attribute
     * @param $params
     * @return boolean
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_user = $this->getUser();

            // 验证密码
            if (!$this->_user || (md5($this->password) != $this->_user->password)) {
                $this->addError($attribute, '用户名或密码错误.');
                return false;
            }
        }
    }

    /**
     * Logs in a user using the provided mobile and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $this->trigger(self::GET_API_TOKEN);
            return $this->_user;
        } else {
            return null;
        }
    }

    /**
     * 根据用户名获取用户的认证信息
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByMobile($this->mobile);
        }

        return $this->_user;
    }

    /**
     * 登录校验成功后，为用户生成新的token
     * 如果token失效，则重新生成token
     */
    public function onGenerateApiToken () {
        if (!User::apiTokenIsValid($this->_user->access_token)) {
            $this->_user->generateApiToken();
            $this->_user->save(false);
        }
    }
}