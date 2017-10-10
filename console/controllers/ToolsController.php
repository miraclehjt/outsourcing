<?php

namespace console\controllers;

use yii\console\Controller;

class ToolsController extends Controller
{
    /**
     * 生成常量
     * ./yii tools/cc
     */
    public function actionCc()
    {
        echo '// ' . $str = 'status -- 1:Y:启用 2:N:禁用' . PHP_EOL;
        $column_values = explode(' -- ', $str);
        $values = explode(' ', $column_values[1]);
        foreach ($values as &$item) {
            $tmpArr = explode(':', $item);
            echo 'const ' . strtoupper($column_values[0]) . '_' . $tmpArr[1] . ' = ' . $tmpArr[0] . ';' . PHP_EOL;
        }
    }
}