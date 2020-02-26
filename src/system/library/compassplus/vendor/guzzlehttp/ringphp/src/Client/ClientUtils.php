<?php
namespace GuzzleHttp\Ring\Client; class ClientUtils { public static function getDefaultCaBundle() { static $cached = null; static $cafiles = [ '/etc/pki/tls/certs/ca-bundle.crt', '/etc/ssl/certs/ca-certificates.crt', '/usr/local/share/certs/ca-root-nss.crt', '/usr/local/etc/openssl/cert.pem', 'C:\\windows\\system32\\curl-ca-bundle.crt', 'C:\\windows\\curl-ca-bundle.crt', ]; if ($cached) { return $cached; } if ($ca = ini_get('openssl.cafile')) { return $cached = $ca; } if ($ca = ini_get('curl.cainfo')) { return $cached = $ca; } foreach ($cafiles as $filename) { if (file_exists($filename)) { return $cached = $filename; } } throw new \RuntimeException(self::CA_ERR); } const CA_ERR = "
No system CA bundle could be found in any of the the common system locations.
PHP versions earlier than 5.6 are not properly configured to use the system's
CA bundle by default. In order to verify peer certificates, you will need to
supply the path on disk to a certificate bundle to the 'verify' request
option: http://docs.guzzlephp.org/en/5.3/clients.html#verify. If you do not
need a specific certificate bundle, then Mozilla provides a commonly used CA
bundle which can be downloaded here (provided by the maintainer of cURL):
https://raw.githubusercontent.com/bagder/ca-bundle/master/ca-bundle.crt. Once
you have a CA bundle available on disk, you can set the 'openssl.cafile' PHP
ini setting to point to the path to the file, allowing you to omit the 'verify'
request option. See http://curl.haxx.se/docs/sslcerts.html for more
information."; } 