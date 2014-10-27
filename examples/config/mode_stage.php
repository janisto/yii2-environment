<?php

/**
 * Staging configuration.
 */
return [
    // Web application configuration.
    'web'=>[
        'components' => [
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
                    'class' => 'Swift_SendmailTransport',
                ],
            ],
        ],
        'params' => [
            'key' => 'value3',
        ],
    ],

    // Console application configuration.
    'console'=>[
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
            'key' => 'value3',
        ],
    ],
];
