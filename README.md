Yii 2 Environment
================

Environment class for Yii 2, used to set configuration for console and web apps depending on the server environment.

[![Latest Stable Version](https://poser.pugx.org/janisto/yii2-environment/v/stable.svg)](https://packagist.org/packages/janisto/yii2-environment)
[![Total Downloads](https://poser.pugx.org/janisto/yii2-environment/downloads.svg)](https://packagist.org/packages/janisto/yii2-environment)
[![License](https://poser.pugx.org/janisto/yii2-environment/license.svg)](https://packagist.org/packages/janisto/yii2-environment)

Installation
------------

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this package using the following command:

```php
php composer.phar require "janisto/yii2-environment" "*"
```
or add

```json
"janisto/yii2-environment": "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

###web index.php

```php
<?php
require(dirname(__DIR__) . '/vendor/autoload.php');

$env = new \janisto\environment\Environment(dirname(__DIR__) . '/config');
$env->setup();
(new yii\web\Application($env->web))->run();
```

or if you have multiple configuration locations

```php
<?php
require(dirname(__DIR__) . '/vendor/autoload.php');

$env = new \janisto\environment\Environment([
    dirname(__DIR__) . '/common/config',
    dirname(__DIR__) . '/backend/config'
]);
$env->setup();
(new yii\web\Application($env->web))->run();
```

###console yii

```php
#!/usr/bin/env php
<?php

require(__DIR__ . '/vendor/autoload.php');

// fcgi doesn't have STDIN and STDOUT defined by default
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
defined('STDOUT') or define('STDOUT', fopen('php://stdout', 'w'));

$env = new \janisto\environment\Environment(__DIR__ . '/config');
$env->setup();
$application = new yii\console\Application($env->console);
$exitCode = $application->run();
exit($exitCode);
```

Use yii

```
export YII_ENV='dev' && ./yii
```

Documentation
-------------

See `examples/`.

License
-------

yii2-environment is free and unencumbered [public domain][Unlicense] software.

[Unlicense]: http://unlicense.org/