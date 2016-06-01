<?php

error_reporting(-1);

require __DIR__ . '/../vendor/autoload.php';

defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
defined('STDOUT') or define('STDOUT', fopen('php://stdout', 'w'));
