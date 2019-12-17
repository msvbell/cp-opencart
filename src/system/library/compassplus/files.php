<?php
$dependenciesDir = __DIR__ . '/dependencies';
$singleFiles = array(
    $dependenciesDir . '/react/promise/src/functions_include.php',
    $dependenciesDir . '/sabre/uri/lib/functions.php',
    $dependenciesDir . '/symfony/polyfill-mbstring/bootstrap.php',
    $dependenciesDir . '/sabre/xml/lib/Deserializer/functions.php',
    $dependenciesDir . '/sabre/xml/lib/Serializer/functions.php',
);

foreach ($singleFiles as $file) {
    require_once $file;
}
