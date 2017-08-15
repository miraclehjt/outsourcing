<?php
namespace api\modules\v1\controllers;

use common\controllers\Base;

class UserController extends Base
{

    protected function exceptionalAuthenticationActions()
    {
        return ['login'];
    }

    public function actionLogin() {
        return ['111', '111'];
    }

    public function actionSignupTest() {

    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
