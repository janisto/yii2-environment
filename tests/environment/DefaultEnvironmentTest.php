<?php

use janisto\environment\Environment;

class DefaultEnvironmentTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        // Unset environment variable
        putenv("YII_ENV");
    }

    public function testDefaultMode()
    {
        $env = new Environment(dirname(__DIR__) . '/config');

        $this->assertEquals('prod', $env->web['params']['environment']);
        $this->assertEquals('prod', $env->console['params']['environment']);
        $this->assertEquals('prod', $env->yiiEnv);
        
        $this->assertFalse($env->yiiDebug);
    }
}
