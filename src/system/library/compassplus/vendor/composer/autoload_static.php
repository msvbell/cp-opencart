<?php
 namespace Composer\Autoload; class ComposerStaticInit78feab20123085d7465c959963ea9504 { public static $files = array ( 'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php', '383eaff206634a77a1be54e64e6459c7' => __DIR__ . '/..' . '/sabre/uri/lib/functions.php', '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php', '3569eecfeed3bcf0bad3c998a494ecb8' => __DIR__ . '/..' . '/sabre/xml/lib/Deserializer/functions.php', '93aa591bc4ca510c520999e34229ee79' => __DIR__ . '/..' . '/sabre/xml/lib/Serializer/functions.php', ); public static $prefixLengthsPsr4 = array ( 'S' => array ( 'Symfony\\Polyfill\\Mbstring\\' => 26, 'Sabre\\Xml\\' => 10, 'Sabre\\Uri\\' => 10, ), 'R' => array ( 'Respect\\Validation\\' => 19, 'React\\Promise\\' => 14, ), 'P' => array ( 'Psr\\Log\\' => 8, ), 'M' => array ( 'Monolog\\' => 8, 'Matriphe\\ISO639\\' => 16, ), 'L' => array ( 'League\\ISO3166\\' => 15, ), 'G' => array ( 'GuzzleHttp\\Stream\\' => 18, 'GuzzleHttp\\Ring\\' => 16, 'GuzzleHttp\\' => 11, ), 'C' => array ( 'Compassplus\\Sdk\\' => 16, ), ); public static $prefixDirsPsr4 = array ( 'Symfony\\Polyfill\\Mbstring\\' => array ( 0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring', ), 'Sabre\\Xml\\' => array ( 0 => __DIR__ . '/..' . '/sabre/xml/lib', ), 'Sabre\\Uri\\' => array ( 0 => __DIR__ . '/..' . '/sabre/uri/lib', ), 'Respect\\Validation\\' => array ( 0 => __DIR__ . '/..' . '/respect/validation/library', ), 'React\\Promise\\' => array ( 0 => __DIR__ . '/..' . '/react/promise/src', ), 'Psr\\Log\\' => array ( 0 => __DIR__ . '/..' . '/psr/log/Psr/Log', ), 'Monolog\\' => array ( 0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog', ), 'Matriphe\\ISO639\\' => array ( 0 => __DIR__ . '/..' . '/matriphe/iso-639/src', ), 'League\\ISO3166\\' => array ( 0 => __DIR__ . '/..' . '/league/iso3166/src', ), 'GuzzleHttp\\Stream\\' => array ( 0 => __DIR__ . '/..' . '/guzzlehttp/streams/src', ), 'GuzzleHttp\\Ring\\' => array ( 0 => __DIR__ . '/..' . '/guzzlehttp/ringphp/src', ), 'GuzzleHttp\\' => array ( 0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src', ), 'Compassplus\\Sdk\\' => array ( 0 => __DIR__ . '/../..' . '/src', ), ); public static function getInitializer(ClassLoader $loader) { return \Closure::bind(function () use ($loader) { $loader->prefixLengthsPsr4 = ComposerStaticInit78feab20123085d7465c959963ea9504::$prefixLengthsPsr4; $loader->prefixDirsPsr4 = ComposerStaticInit78feab20123085d7465c959963ea9504::$prefixDirsPsr4; }, null, ClassLoader::class); } } 