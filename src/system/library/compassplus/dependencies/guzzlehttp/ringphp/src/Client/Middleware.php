<?php
namespace GuzzleHttp\Ring\Client; class Middleware { public static function wrapFuture( callable $default, callable $future ) { return function (array $request) use ($default, $future) { return empty($request['client']['future']) ? $default($request) : $future($request); }; } public static function wrapStreaming( callable $default, callable $streaming ) { return function (array $request) use ($default, $streaming) { return empty($request['client']['stream']) ? $default($request) : $streaming($request); }; } } 