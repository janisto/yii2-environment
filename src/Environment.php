<?php

namespace janisto\environment;

/**
 * Environment class for Yii 2, used to set configuration for console and web apps depending on the server environment.
 *
 * @author Jani Mikkonen <janisto@php.net>
 * @license public domain (http://unlicense.org)
 * @link https://github.com/janisto/yii2-environment
 */
class Environment
{
    /**
     * Environment variable. Use Apache SetEnv or export in shell.
     *
     * @var string environment variable name
     */
    protected $envName = 'YII_ENV';
    /**
     * @var array list of valid modes
     */
    protected $validModes = [
        'dev',
        'test',
        'stage',
        'prod',
    ];
    /**
     * @var array configuration directory(s)
     */
    protected $configDir = [];
    /**
     * @var string selected environment mode
     */
    protected $mode;
    /**
     * @var string path to Yii.php
     */
    public $yiiPath;
    /**
     * @var boolean debug mode or not
     */
    public $yiiDebug;
    /**
     * @var string defines in which environment the application is running
     */
    public $yiiEnv;
    /**
     * @var array register path aliases
     */
    public $aliases = [];
    /**
     * @var array merge class map used by the Yii autoloading mechanism
     */
    public $classMap = [];
    /**
     * @var array web application configuration array
     */
    public $web = [];
    /**
     * @var array console application configuration array
     */
    public $console = [];

    /**
     * Constructor. Initializes the Environment class.
     *
     * @param string|array $configDir configuration directory(s)
     * @param string $mode override automatically set environment mode
     * @throws \Exception
     */
    public function __construct($configDir, $mode = null)
    {
        if ($configDir === null) {
            throw new \Exception('Path to configuration directory(s) missing.');
        }
        $this->setConfigDir($configDir);
        $this->setMode($mode);
        $this->setEnvironment();
    }

    /**
     * Set configuration directory(s) where the config files are stored.
     *
     * @param string|array $configDir configuration directory(s)
     * @throws \Exception
     */
    protected function setConfigDir($configDir)
    {
        $this->configDir = [];
        foreach ((array) $configDir as $k => $v) {
            $dir = rtrim($v, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
            if (!is_dir($dir)) {
                throw new \Exception('Invalid configuration directory "' . $dir . '".');
            }
            $this->configDir[$k] = $dir;
        }
    }

    /**
     * Set environment mode.
     *
     * @param string|null $mode environment mode
     * @throws \Exception
     */
    protected function setMode($mode)
    {
        if ($mode === null) {
            // Return mode based on environment variable.
            $mode = getenv($this->envName);
            if ($mode === false) {
                // Defaults to production.
                $mode = 'prod';
            }
        }

        // Check if mode is valid.
        $mode = strtolower($mode);
        if (!in_array($mode, $this->validModes, true)) {
            throw new \Exception('Invalid environment mode supplied or selected: ' . $mode);
        }

        $this->mode = $mode;
    }

    /**
     * Load and merge configuration files into one array.
     *
     * @return array $config array to be processed by setEnvironment
     * @throws \Exception
     */
    protected function getConfig()
    {
        $configMerged = [];
        foreach ($this->configDir as $configDir) {
            // Merge main config.
            $fileMainConfig = $configDir . 'main.php';
            if (!file_exists($fileMainConfig)) {
                throw new \Exception('Cannot find main config file "' . $fileMainConfig . '".');
            }
            $configMain = require($fileMainConfig);
            if (is_array($configMain)) {
                $configMerged = \yii\helpers\ArrayHelper::merge($configMerged, $configMain);
            }

            // Merge mode specific config.
            $fileSpecificConfig = $configDir . 'mode_' . $this->mode . '.php';
            if (!file_exists($fileSpecificConfig)) {
                throw new \Exception('Cannot find mode specific config file "' . $fileSpecificConfig . '".');
            }
            $configSpecific = require($fileSpecificConfig);
            if (is_array($configSpecific)) {
                $configMerged = \yii\helpers\ArrayHelper::merge($configMerged, $configSpecific);
            }

            // If one exists, merge local config.
            $fileLocalConfig = $configDir . 'local.php';
            if (file_exists($fileLocalConfig)) {
                $configLocal = require($fileLocalConfig);
                if (is_array($configLocal)) {
                    $configMerged = \yii\helpers\ArrayHelper::merge($configMerged, $configLocal);
                }
            }
        }

        return $configMerged;
    }

    /**
     * Sets the environment and configuration for the selected mode.
     *
     * @throws \Exception
     */
    protected function setEnvironment()
    {
        $config = $this->getConfig();
        if (!is_readable($config['yiiPath'])) {
            throw new \Exception('Invalid Yii framework path "' . $config['yiiPath'] . '".');
        }

        // Set attributes.
        $this->yiiPath = $config['yiiPath'];
        $this->yiiDebug = isset($config['yiiDebug']) ? $config['yiiDebug'] : false;
        $this->yiiEnv = isset($config['yiiEnv']) ? $config['yiiEnv'] : $this->mode;
        $this->web = isset($config['web']) ? $config['web'] : [];
        $this->web['params']['environment'] = $this->mode;
        $this->console = isset($config['console']) ? $config['console'] : [];
        $this->console['params']['environment'] = $this->mode;
        $this->aliases = isset($config['aliases']) ? $config['aliases'] : [];
        $this->classMap = isset($config['classMap']) ? $config['classMap'] : [];
    }

    /**
     * Defines Yii constants, includes base Yii class, sets aliases and merges class map.
     */
    public function setup()
    {
        /**
         * This constant defines whether the application should be in debug mode or not.
         */
        defined('YII_DEBUG') or define('YII_DEBUG', $this->yiiDebug);
        /**
         * This constant defines in which environment the application is running.
         * The value could be 'prod' (production), 'stage' (staging), 'test' (testing) or 'dev' (development).
         */
        defined('YII_ENV') or define('YII_ENV', $this->yiiEnv);
        /**
         * Whether the the application is running in staging environment.
         */
        defined('YII_ENV_STAGE') or define('YII_ENV_STAGE', YII_ENV === 'stage');

        // Include Yii.
        require($this->yiiPath);

        // Set aliases.
        foreach ($this->aliases as $alias => $path) {
            \Yii::setAlias($alias, $path);
        }

        // Merge class map.
        if (!empty($this->classMap)) {
            \Yii::$classMap = \yii\helpers\ArrayHelper::merge(\Yii::$classMap, $this->classMap);
        }
    }

    /**
     * Show current Environment class values.
     */
    public function showDebug()
    {
        print '<div style="position: absolute; left: 0; width: 100%; height: 250px; overflow: auto;'
            . 'bottom: 0; z-index: 9999; color: #000; margin: 0; border-top: 1px solid #000;">'
            . '<pre style="margin: 0; background-color: #ddd; padding: 5px;">'
            . htmlspecialchars(print_r($this, true)) . '</pre></div>';
    }
}
