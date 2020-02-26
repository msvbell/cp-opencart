<?php
namespace GuzzleHttp\Event; trait HasEmitterTrait { private $emitter; public function getEmitter() { if (!$this->emitter) { $this->emitter = new Emitter(); } return $this->emitter; } } 