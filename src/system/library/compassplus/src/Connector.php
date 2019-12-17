<?php


namespace Compassplus\Sdk;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Message\FutureResponse;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Ring\Future\FutureInterface;
use InvalidArgumentException;
use Compassplus\Sdk\Config\Config;
use Compassplus\Sdk\Request\DataProvider;
use SplFileInfo;

/**
 * Class Connector
 *
 * @package Compassplus
 */
class Connector
{
    /**
     * @var DataProvider
     */
    public $orderData;

    public $debug = false;
    /**
     * @var
     */
    private $pathToCertFile;
    /**
     * @var
     */
    private $certPassword;
    /**
     * @var bool
     */
    private $secureConnectionOnly = true;
    /**
     * @var false|string
     */
    private $pathToKey;

    /**
     * Connector constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return FutureResponse|ResponseInterface|FutureInterface
     * @throws Exception
     */
    public function sendRequest()
    {
        $url = $this->getUrl();
        $body = $this->orderData;
        return $this->getResponse($url, $body);
    }

    /**
     * @return string TWPG server url
     */
    private function getUrl()
    {
        if (Config::getPort()) {
            $url = Config::getHostName() . ':' . Config::getPort() . '/exec';
        } else {
            $url = Config::getHostName() . '/exec';
        }

        if (!strpos($url, "://")) {
            $url = 'https://' . $url;
        }

        return $url;
    }

    /**
     * @param $url
     * @param $body
     * @return FutureResponse|ResponseInterface|FutureInterface|null
     * @throws Exception
     */
    private function getResponse($url, $body)
    {
        $response = $this->send($url, $body);
        return $response;
    }

    /**
     * @param $url
     * @param $body
     * @param bool $debug
     * @return FutureResponse|ResponseInterface|FutureInterface|null
     */
    private function send($url, $body)
    {
        $caCertFileName = 'CA.crt';
        $client = new Client();
        ini_set("curl.cainfo", dirname(__DIR__) . DIRECTORY_SEPARATOR . $caCertFileName);
        $options = [
            'body' => $body,
            'verify' => dirname(__DIR__) . DIRECTORY_SEPARATOR . $caCertFileName,
            'cert' => [$this->pathToCertFile, $this->certPassword],
            'config' => [
                'curl' => [
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_CAINFO => dirname(__DIR__) . DIRECTORY_SEPARATOR . $caCertFileName
                ]
            ],
            'allow_redirects' => [
                'max' => 5,
                'strict' => true,
                'referer' => true,
                'protocols' => ['https', 'http'],
            ]
        ];

        if (!$this->secureConnectionOnly) {
            $options['protocols'] = ['https', 'http'];
        }

        if (!empty($this->pathToKey)) {
            $options['ssl_key'] = $this->pathToKey;
        }

        if (is_bool($this->debug) && $this->debug) {
            $options['debug'] = true;
        }
        if (is_bool($this->debug) && $this->debug) {
            var_dump(array([
                "CAcert path" => dirname(__DIR__) . DIRECTORY_SEPARATOR . $caCertFileName,
                "Cert path" => $this->pathToCertFile,
                "URL" => $url,
                "Body" => $body
//                "Openssl certs locations" => openssl_get_cert_locations()
            ]));
        }
        $response = $client->post($url, $options);


        return $response;
    }

    /**
     *
     */
    public function setUnsecuredConnection()
    {
        $this->secureConnectionOnly = false;
    }

    /**
     * Set client pem certificate file
     * @param string $pathToCert
     * @param string $password Password for cert file
     * @throws Exception
     */
    public function setCert($pathToCert, $password)
    {
        $this->pathToCertFile = $this->getRealPath($pathToCert);
        $this->certPassword = $password;
    }

    public function setKey($pathToKey)
    {
        try {
            $this->pathToKey = $this->getRealPath($pathToKey);
        } catch (Exception $e) {
            var_dump($e);
        }
    }

    /**
     * @param $pathToFile
     * @return false|string
     * @throws Exception
     */
    private function getRealPath($pathToFile)
    {
        $info = new \SplFileInfo($pathToFile);
        if (!$info->isFile()) {
            throw new \InvalidArgumentException('Cert file not found');
        }
        if (!$info->isReadable()) {
            throw new \Exception('Cert file not readable');
        }
        return $info->getRealPath(); // ???
    }
}
