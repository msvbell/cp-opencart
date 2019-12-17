<?php
namespace GuzzleHttp\Event; class EndEvent extends AbstractTransferEvent { public function getException() { return $this->transaction->exception; } } 