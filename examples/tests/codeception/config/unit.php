<?php
/**
 * Application configuration for unit tests
 */
return yii\helpers\ArrayHelper::merge(
    (new \janisto\environment\Environment(__DIR__ . '/../../../config', 'test'))->web,
    [

    ]
);
