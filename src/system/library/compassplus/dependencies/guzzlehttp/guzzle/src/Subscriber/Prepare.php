<?php
namespace GuzzleHttp\Subscriber; use GuzzleHttp\Event\BeforeEvent; use GuzzleHttp\Event\RequestEvents; use GuzzleHttp\Event\SubscriberInterface; use GuzzleHttp\Message\AppliesHeadersInterface; use GuzzleHttp\Message\RequestInterface; use GuzzleHttp\Mimetypes; use GuzzleHttp\Stream\StreamInterface; class Prepare implements SubscriberInterface { public function getEvents() { return ['before' => ['onBefore', RequestEvents::PREPARE_REQUEST]]; } public function onBefore(BeforeEvent $event) { $request = $event->getRequest(); if (!($body = $request->getBody())) { return; } $this->addContentLength($request, $body); if ($body instanceof AppliesHeadersInterface) { $body->applyRequestHeaders($request); } elseif (!$request->hasHeader('Content-Type')) { $this->addContentType($request, $body); } $this->addExpectHeader($request, $body); } private function addContentType( RequestInterface $request, StreamInterface $body ) { if (!($uri = $body->getMetadata('uri'))) { return; } if ($contentType = Mimetypes::getInstance()->fromFilename($uri)) { $request->setHeader('Content-Type', $contentType); } } private function addContentLength( RequestInterface $request, StreamInterface $body ) { if ($request->hasHeader('Content-Length')) { $request->removeHeader('Transfer-Encoding'); return; } if ($request->hasHeader('Transfer-Encoding')) { return; } if (null !== ($size = $body->getSize())) { $request->setHeader('Content-Length', $size); $request->removeHeader('Transfer-Encoding'); } elseif ('1.1' == $request->getProtocolVersion()) { $request->setHeader('Transfer-Encoding', 'chunked'); $request->removeHeader('Content-Length'); } } private function addExpectHeader( RequestInterface $request, StreamInterface $body ) { if ($request->hasHeader('Expect')) { return; } $expect = $request->getConfig()['expect']; if ($expect === false || $request->getProtocolVersion() !== '1.1') { return; } if ($expect === true) { $request->setHeader('Expect', '100-Continue'); return; } if ($expect === null) { $expect = 1048576; } $size = $body->getSize(); if ($size === null || $size >= (int) $expect || !$body->isSeekable()) { $request->setHeader('Expect', '100-Continue'); } } } 