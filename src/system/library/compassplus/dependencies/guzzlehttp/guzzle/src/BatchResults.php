<?php
namespace GuzzleHttp; class BatchResults implements \Countable, \IteratorAggregate, \ArrayAccess { private $hash; public function __construct(\SplObjectStorage $hash) { $this->hash = $hash; } public function getKeys() { return iterator_to_array($this->hash); } public function getResult($forObject) { return isset($this->hash[$forObject]) ? $this->hash[$forObject] : null; } public function getSuccessful() { $results = []; foreach ($this->hash as $key) { if (!($this->hash[$key] instanceof \Exception)) { $results[] = $this->hash[$key]; } } return $results; } public function getFailures() { $results = []; foreach ($this->hash as $key) { if ($this->hash[$key] instanceof \Exception) { $results[] = $this->hash[$key]; } } return $results; } public function getIterator() { $results = []; foreach ($this->hash as $key) { $results[] = $this->hash[$key]; } return new \ArrayIterator($results); } public function count() { return count($this->hash); } public function offsetExists($key) { return $key < count($this->hash); } public function offsetGet($key) { $i = -1; foreach ($this->hash as $obj) { if ($key === ++$i) { return $this->hash[$obj]; } } return null; } public function offsetUnset($key) { throw new \RuntimeException('Not implemented'); } public function offsetSet($key, $value) { throw new \RuntimeException('Not implemented'); } } 