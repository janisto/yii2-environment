<?php

/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files.
 */
return [
    // Set Yii framework path.
    'yiiPath' => dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php',

    // Set YII_DEBUG flag.
    'yiiDebug' => false,

    // Path aliases.
    'aliases' => [
        '@uploads' => dirname(__DIR__) . '/web/uploads',
    ],

    // Web application configuration.
    'web'=>[
        'id' => 'basic',
        'basePath' => dirname(__DIR__),
        'bootstrap' => ['log'],
        'components' => [
            'request' => [
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => 'Po1xGeFIu2J5k7CzY6-ehGwFQUG_rFI_',
            ],
            'cache' => [
                'class' => 'yii\caching\FileCache',
            ],
            'user' => [
                'identityClass' => 'app\models\User',
                'enableAutoLogin' => true,
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            'log' => [
                'traceLevel' => 0,
                'targets' => [
                    [
                        'class' => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
            'urlManager' => [
                'class' => 'yii\web\UrlManager',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
            ],
        ],
        'params' => [
            'adminEmail' => 'admin@example.com',
        ],
    ],

    // Console application configuration.
    'console'=>[
        'id' => 'basic-console',
        'basePath' => dirname(__DIR__),
        'bootstrap' => ['log'],
        'controllerNamespace' => 'app\commands',
        'components' => [
            'cache' => [
                'class' => 'yii\caching\FileCache',
            ],
            'log' => [
                'targets' => [
                    [
                        'class' => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
        ],
        'params' => [
            'adminEmail' => 'admin@example.com',
        ],
    ],
];
