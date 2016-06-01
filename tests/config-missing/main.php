<?php

/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files.
 */
return [
    // Set Yii framework path.
    'yiiPath' => dirname(dirname(__DIR__)) . '/vendor/yiisoft/yii2/Yii.php',

    // Set YII_DEBUG flag.
    'yiiDebug' => false,

    // Web application configuration.
    'web' => [
        'id' => 'basic',
        'basePath' => dirname(__DIR__),
        'components' => [
            'request' => [
                // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
                'cookieValidationKey' => 'eBDpJ_4AHwJyzdvgQBbuzfFAQ5YSZkU9',
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            'urlManager' => [
                'class' => 'yii\web\UrlManager',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
            ],
        ],
        'params' => [
            'key' => 'value',
        ],
    ],

    // Console application configuration.
    'console' => [
        'id' => 'basic-console',
        'basePath' => dirname(__DIR__),
        'controllerNamespace' => 'app\commands',
        'params' => [
            'key' => 'value',
        ],
    ],
];
