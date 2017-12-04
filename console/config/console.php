<?php
Yii::setAlias('tests', __DIR__ . '/../tests');

return [
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
        ],
    ],
];
