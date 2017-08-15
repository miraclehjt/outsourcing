<?php
/**
 * Api基类
 */
namespace common\controllers;

use \Yii;
use yii\base\Event;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\UnauthorizedHttpException;

abstract class Base extends Controller
{
    protected function isAuthenticatorEnabled()
    {
        return true;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // 不处理OPTIONS请求
        $behaviors['authenticator']['except'] = ['options'];

        /*
         * 只返回JSON格式的数据。
         */
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON,
        ];

        if ($this->isAuthenticatorEnabled()) {
            $behaviors['authenticator'] = [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    HttpBasicAuth::className(),
                    QueryParamAuth::className(),
                    HttpBearerAuth::className(),
                ],
                'except' => $this->exceptionalAuthenticationActions(),
                'optional' => $this->optionalAuthenticationActions(),
            ];
        }

        return $behaviors;
    }

    public function init()
    {
        parent::init();
    }

    public function handleResponse(Event $event)
    {

    }

    /**
     * 不需要身份认证的Actions.
     *
     * @return array
     */
    protected function exceptionalAuthenticationActions()
    {
        return [];
    }

    /**
     * 可选身份认证的Actions.
     * @return array
     */
    protected function optionalAuthenticationActions()
    {
        return [];
    }
}