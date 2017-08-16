<?php
namespace api\modules\v1\controllers;

use common\controllers\Base;
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
       return Yii::$app->user->identity;
    }

    /**
     * 搞测试用的
     * @return array
     */
    public function actionSignupTest ()
    {
        return [
            'code' => Yii::$app->getSecurity()->generatePasswordHash('123123')
        ];
    }

}
