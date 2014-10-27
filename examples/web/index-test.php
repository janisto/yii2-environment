<?php

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

require(dirname(__DIR__) . '/vendor/autoload.php');

$env = new \janisto\environment\Environment(dirname(__DIR__) . '/config', 'test');
$env->setup();
(new yii\web\Application($env->web))->run();
