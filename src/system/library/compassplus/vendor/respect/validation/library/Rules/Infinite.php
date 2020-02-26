<?php
 namespace Respect\Validation\Rules; class Infinite extends AbstractRule { public function validate($input) { return is_numeric($input) && is_infinite($input); } } 