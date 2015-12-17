<?php

/**
 * Testing configuration.
 */
return [
    // Path aliases.
    'aliases' => [
        '@tests' => dirname(__DIR__) . '/tests',
    ],
    // Web application configuration.
    'web'=>[
        'language' => 'en-US',
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
                'enablePrettyUrl' => false,
            ],
        ],
        'params' => [
            'key' => 'value4',
        ],
    ],

    // Console application configuration.
    'console'=>[
        'language' => 'en-US',
        'controllerMap' => [
            'fixture' => [
                'class' => 'yii\faker\FixtureController',
                'fixtureDataPath' => '@tests/codeception/fixtures',
                'templatePath' => '@tests/codeception/templates',
                'namespace' => 'tests\codeception\fixtures',
            ],
        ],
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
