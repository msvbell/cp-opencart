<?php
namespace GuzzleHttp\Event; interface EventInterface { public function isPropagationStopped(); public function stopPropagation(); } 