<?php
namespace api\modules\v1\controllers;

use common\controllers\Base;
use common\models\Merchant;
use Yii;

class MerchantController extends Base
{
    protected function exceptionalAuthenticationActions()
    {
        return ['test', 'list'];
    }

    public function actionList() {
        $list = Merchant::find()->limit(10)->asArray()->    all();

        foreach ($list as $key => &$value) {
            $value['full_logo_url'] = Yii::$app->params['backend_domain'] . $value['logo'];
        }

        return $list;
    }
}