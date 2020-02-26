<?php
 namespace Respect\Validation\Rules; class Finite extends AbstractRule { public function validate($input) { return is_numeric($input) && is_finite($input); } } 