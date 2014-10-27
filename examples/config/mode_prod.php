<?php

/**
 * Production configuration.
 */
return [
    // Web application configuration.
    'web'=>[
        'components' => [
            'cache' => [
                'class' => 'yii\caching\ApcCache',
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
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'localhost',
                    'username' => 'username',
                    'password' => 'password',
                    'port' => '587',
                    'encryption' => 'tls',
                ],
            ],
        ],
        'params' => [
            'key' => 'value2',
        ],
    ],

    // Console application configuration.
    'console'=>[
        'components' => [
            'cache' => [
                'class' => 'yii\caching\ApcCache',
            ],
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'mysql:host=localhost;dbname=yii2basic',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ],
        ],
        'params' => [
            'key' => 'value2',
        ],
    ],
];
