<?php
/**
 * Application configuration for acceptance tests
 */
return yii\helpers\ArrayHelper::merge(
    (new \janisto\environment\Environment(__DIR__ . '/../../../config', 'test'))->web,
    [

    ]
);
