<?php

namespace backend\modules\user;

/**
 * 用户管理模块
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\user\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        // 模块实例用来帮模块内代码共享数据和组件。
        \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
