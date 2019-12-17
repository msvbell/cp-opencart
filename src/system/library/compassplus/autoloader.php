<?php

require_once dirname(dirname(__FILE__)) . '/files.php';
$classMap = require __DIR__ . 'classMap.php';

$loader = new \Composer\Autoload\ClassLoader();
$loader->addClassMap($classMap);
$loader->register();
