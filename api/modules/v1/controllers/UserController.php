<?php
namespace api\modules\v1\controllers;

use api\models\LoginForm;
use common\controllers\Base;
use common\models\User;
use Yii;

class UserController extends Base
{

    protected function exceptionalAuthenticationActions()
    {
        return ['login', 'signup-test'];
    }

    public function actionLogin() {
        $model = new LoginForm;
        $model->setAttributes(Yii::$app->request->post());
        if ($user = $model->login()) {
            if ($user instanceof IdentityInterface) {
                return $user->api_token;
            } else {
                return $user->errors;
            }
        } else {
            return $model->errors;
        }
    }

    /**
     * 获取用户信息
     */
    public function actionProfile ()
    {
        $user = User::findIdentityByAccessToken();
        return [
            'id' => $user->id,
            'username' => $user->username,
        ];
    }

    /**
     * 搞测试用的
     * @return array
     */
    public function actionSignupTest ()
    {
        $user = new User();
        $user->generateAuthKey();
        $user->setPassword('123456');
        $user->username = '111';
        $user->email = '111@111.com';
        $user->save(false);

        return [
            'code' => 0
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
