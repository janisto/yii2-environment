<?php

/**
 * Testing configuration.
 */
return [
    // Web application configuration.
    'web'=>[
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=yii2_basic_tests',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'useFileTransport' => true,
            ],
            'urlManager' => [
                'showScriptName' => true,
            ],
        ],
        'params' => [
            'key' => 'value4',
        ],
    ],

    // Console application configuration.
    'console'=>[
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=yii2_basic_tests',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
        ],
        'params' => [
            'key' => 'value4',
        ],
    ],
];
