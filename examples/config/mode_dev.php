<?php

/**
 * Development configuration.
 */
return [
    // Set YII_DEBUG flag.
    'yiiDebug' => true,

    // Web application configuration.
    'web'=>[
        'bootstrap' => ['log', 'gii', 'debug'],
        'modules' => [
            'gii' => 'yii\gii\Module',
            'debug' => 'yii\debug\Module',
        ],
        'components' => [
            'log' => [
                'traceLevel' => 3,
            ],
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=yii2basic',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'useFileTransport' => true,
            ],
        ],
        'params' => [
            'key' => 'value1',
        ],
    ],

    // Console application configuration.
    'console'=>[
        'bootstrap' => ['log', 'gii'],
        'modules' => [
            'gii' => 'yii\gii\Module',
        ],
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=yii2basic',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
        ],
        'params' => [
            'key' => 'value1',
        ],
    ],
];
