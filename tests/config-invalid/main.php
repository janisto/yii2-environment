<?php

/**
 * Main configuration.
 * All properties can be overridden in mode_<mode>.php files.
 */
return [
    // Set Yii framework path.
    'yiiPath' => '/invalid/path/yiisoft/yii2/Yii.php',

    // Set YII_DEBUG flag.
    'yiiDebug' => false,

    // Web application configuration.
    'web' => [
        'id' => 'basic',
        'basePath' => dirname(__DIR__),
        'components' => [
            'request' => [
                'cookieValidationKey' => 'eBDpJ_4AHwJyzdvgQBbuzfFAQ5YSZkU9',
                'scriptFile' => __DIR__ . '/index.php',
                'scriptUrl' => '/index.php',
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
