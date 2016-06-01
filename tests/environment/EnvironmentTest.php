<?php

use janisto\environment\Environment;

class EnvironmentTest extends \PHPUnit_Framework_TestCase
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
    
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid configuration directory
     */
    public function testInvalidConfigurationDirectory()
    {
        $env = new Environment(dirname(__DIR__) . '/invalid-directory');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid Yii framework path
     */
    public function testInvalidYiiFrameworkPath()
    {
        $env = new Environment(dirname(__DIR__) . '/config-invalid');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Cannot find main config file
     */
    public function testMainFileInConfigurationDirectory()
    {
        $env = new Environment(dirname(__DIR__));
    }
    
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Cannot find mode specific config file
     */
    public function testModeFileInConfigurationDirectory()
    {
        $env = new Environment(dirname(__DIR__) . '/config-missing');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid environment mode supplied or selected
     */
    public function testInvalidEnvironmentMode()
    {
        $env = new Environment(dirname(__DIR__) . '/config', 'invalid-mode');
    }

    public function testConfigurationDirectory()
    {
        $env = new Environment(dirname(__DIR__) . '/config');
        
        $this->assertEquals('value-2', $env->web['params']['key']);
        $this->assertEquals('value-2', $env->console['params']['key']);

        $this->assertEquals('test', $env->web['params']['environment']);
        $this->assertEquals('test', $env->console['params']['environment']);
        $this->assertEquals('test', $env->yiiEnv);

        $this->assertTrue($env->yiiDebug);
    }
    
    public function testTwoConfigurationDirectories()
    {
        $env = new Environment([
            dirname(__DIR__) . '/config-common',
            dirname(__DIR__) . '/config',
        ]);

        $this->assertEquals('value-2', $env->web['params']['key']);
        $this->assertEquals('value-2', $env->web['common']);
        $this->assertEquals('value-2', $env->console['params']['key']);
        $this->assertEquals('value-2', $env->console['common']);

        $this->assertEquals('test', $env->web['params']['environment']);
        $this->assertEquals('test', $env->console['params']['environment']);
        $this->assertEquals('test', $env->yiiEnv);

        $this->assertTrue($env->yiiDebug);
    }

    public function testForceDevelopmentMode()
    {
        $env = new Environment(dirname(__DIR__) . '/config', 'dev');

        $this->assertEquals('value-1', $env->web['params']['key']);
        $this->assertEquals('value-1', $env->console['params']['key']);

        $this->assertEquals('dev', $env->web['params']['environment']);
        $this->assertEquals('dev', $env->console['params']['environment']);
        $this->assertEquals('dev', $env->yiiEnv);

        $this->assertTrue($env->yiiDebug);
    }
    
    public function testForceTestingMode()
    {
        $env = new Environment(dirname(__DIR__) . '/config', 'test');

        $this->assertEquals('value-2', $env->web['params']['key']);
        $this->assertEquals('value-2', $env->console['params']['key']);

        $this->assertEquals('test', $env->web['params']['environment']);
        $this->assertEquals('test', $env->console['params']['environment']);
        $this->assertEquals('test', $env->yiiEnv);

        $this->assertTrue($env->yiiDebug);
    }

    public function testForceStagingMode()
    {
        $env = new Environment(dirname(__DIR__) . '/config', 'stage');

        $this->assertEquals('value-3', $env->web['params']['key']);
        $this->assertEquals('value-3', $env->console['params']['key']);

        $this->assertEquals('stage', $env->web['params']['environment']);
        $this->assertEquals('stage', $env->console['params']['environment']);
        $this->assertEquals('stage', $env->yiiEnv);

        $this->assertFalse($env->yiiDebug);
    }

    public function testForceProductionMode()
    {
        $env = new Environment(dirname(__DIR__) . '/config', 'prod');

        $this->assertEquals('value-4', $env->web['params']['key']);
        $this->assertEquals('value-4', $env->console['params']['key']);

        $this->assertEquals('prod', $env->web['params']['environment']);
        $this->assertEquals('prod', $env->console['params']['environment']);
        $this->assertEquals('prod', $env->yiiEnv);

        $this->assertFalse($env->yiiDebug);
    }

    public function testShowDebug()
    {
        $env = new Environment(dirname(__DIR__) . '/config');

        ob_start();
        $env->showDebug();
        $message = ob_get_contents();
        ob_end_clean();

        $this->assertStringStartsWith('<div style="position: absolute;', $message);
        $this->assertRegExp('/Environment/', $message);
        $this->assertStringEndsWith('</pre></div>', $message);
    }
}
