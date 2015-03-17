# Yii 2 Environment

Environment class for Yii 2, used to set configuration for console and web apps depending on the server environment.

[![Software License](https://img.shields.io/badge/license-Unlicense-blue.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/janisto/yii2-environment/master.svg?style=flat-square)](https://travis-ci.org/janisto/yii2-environment)
[![Quality Score](https://img.shields.io/scrutinizer/g/janisto/yii2-environment.svg?style=flat-square)](https://scrutinizer-ci.com/g/janisto/yii2-environment)
[![Packagist Version](https://img.shields.io/packagist/v/janisto/yii2-environment.svg?style=flat-square)](https://packagist.org/packages/janisto/yii2-environment)
[![Total Downloads](https://img.shields.io/packagist/dt/janisto/yii2-environment.svg?style=flat-square)](https://packagist.org/packages/janisto/yii2-environment)

## Installation

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

## Usage

### web index.php

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

### console yii

```php
#!/usr/bin/env php
<?php

require(__DIR__ . '/vendor/autoload.php');

// fcgi doesn't have STDIN and STDOUT defined by default
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
defined('STDOUT') or define('STDOUT', fopen('php://stdout', 'w'));

$env = new \janisto\environment\Environment(__DIR__ . '/config');
$env->setup();
$exitCode = (new yii\console\Application($env->console))->run();
exit($exitCode);
```

Use yii

```
export YII_ENV='dev' && ./yii
```

## Documentation

See `examples/`.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Jani Mikkonen](https://github.com/janisto)
- [All Contributors](../../contributors)

## License

Public domain. Please see [License File](LICENSE.md) for more information.
