<?php
 namespace Respect\Validation\Rules; class Countable extends AbstractRule { public function validate($input) { return is_array($input) || $input instanceof \Countable; } } 