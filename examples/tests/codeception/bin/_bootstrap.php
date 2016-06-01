<?php

defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', dirname(dirname(dirname(__DIR__))));

require(YII_APP_BASE_PATH . '/vendor/autoload.php');
$env = new \janisto\environment\Environment(YII_APP_BASE_PATH . '/config', 'test');
$env->setup();
