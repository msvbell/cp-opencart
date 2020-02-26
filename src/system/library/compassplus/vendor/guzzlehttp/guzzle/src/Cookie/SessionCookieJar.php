<?php
namespace GuzzleHttp\Cookie; use GuzzleHttp\Utils; class SessionCookieJar extends CookieJar { private $sessionKey; public function __construct($sessionKey) { $this->sessionKey = $sessionKey; $this->load(); } public function __destruct() { $this->save(); } public function save() { $json = []; foreach ($this as $cookie) { if ($cookie->getExpires() && !$cookie->getDiscard()) { $json[] = $cookie->toArray(); } } $_SESSION[$this->sessionKey] = json_encode($json); } protected function load() { $cookieJar = isset($_SESSION[$this->sessionKey]) ? $_SESSION[$this->sessionKey] : null; $data = Utils::jsonDecode($cookieJar, true); if (is_array($data)) { foreach ($data as $cookie) { $this->setCookie(new SetCookie($cookie)); } } elseif (strlen($data)) { throw new \RuntimeException("Invalid cookie data"); } } } 