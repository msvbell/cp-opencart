<?php
namespace GuzzleHttp; trait HasDataTrait { protected $data = []; public function getIterator() { return new \ArrayIterator($this->data); } public function offsetGet($offset) { return isset($this->data[$offset]) ? $this->data[$offset] : null; } public function offsetSet($offset, $value) { $this->data[$offset] = $value; } public function offsetExists($offset) { return isset($this->data[$offset]); } public function offsetUnset($offset) { unset($this->data[$offset]); } public function toArray() { return $this->data; } public function count() { return count($this->data); } public function getPath($path) { return Utils::getPath($this->data, $path); } public function setPath($path, $value) { Utils::setPath($this->data, $path, $value); } } 