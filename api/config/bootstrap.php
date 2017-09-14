<?php

use yii\filters\ContentNegotiator;
use yii\web\Response;

return [
    'log',
    [
        'class' => ContentNegotiator::className(),
        'formats' => [
            'application/json' => Response::FORMAT_JSON,
            'application/xml' => Response::FORMAT_XML,
        ],
        'languages' => [
            'en-US',
            'de',
        ],
    ],
];