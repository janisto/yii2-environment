<?php

use janisto\environment\Environment;

class SetupEnvironmentTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        // Set environment variable
        putenv("YII_ENV=test");
    }

    public function testEnvironmentVariable()
    {
        $this->assertEquals('test', getenv('YII_ENV'));
    }

    public function testSetupWebApplication()
    {
        $env = new Environment(dirname(__DIR__) . '/config');
        $env->setup();
        (new yii\web\Application($env->web));

        $this->assertTrue($env->web['params']['local']);
        $this->assertTrue($env->console['params']['local']);
        $this->assertTrue(Yii::$app->params['local']);

        $this->assertEquals('value-2', $env->web['params']['key']);
        $this->assertEquals('value-2', $env->console['params']['key']);
        $this->assertEquals('value-2', Yii::$app->params['key']);

        $this->assertEquals('test', $env->web['params']['environment']);
        $this->assertEquals('test', $env->console['params']['environment']);
        $this->assertEquals('test', $env->yiiEnv);
        $this->assertEquals('test', Yii::$app->params['environment']);
        $this->assertEquals('test', YII_ENV);
        $this->assertTrue(YII_ENV_TEST);

        $this->assertTrue($env->yiiDebug);
        $this->assertTrue(YII_DEBUG);

        $this->assertEquals(dirname(__DIR__), Yii::getAlias('@app'));
        $this->assertEquals(dirname(__DIR__) . '/web/uploads', Yii::getAlias('@uploads'));

        $this->assertEquals(42, yii\helpers\Html::test());
    }
}
