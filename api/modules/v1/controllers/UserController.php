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
        return ['signup-test'];
    }

    /**
     * 获取用户信息
     */
    public function actionProfile ()
    {
        $user = Yii::$app->user->identity;
        return [
            'id' => $user->id,
            'username' => $user->nickname,
        ];
    }

    /**
     * 检查访问方法，判断访问令牌所有者是否为请求用户ID
     * @param $action
     * @param null $model
     * @param array $params
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        $oauthUser = Yii::$app->user->identity;

        if ($oauthUser['id'] != Yii::$app->request->get('id')) {
            throw new UnauthorizedHttpException(Yii::t('app/error', '30054'), $code = 30054);
        }
    }

    /**
     * 搞测试用的
     * @return array
     */
    public function actionSignupTest ()
    {
        return [
            'code' => 0
        ];
    }

}
