<?php
 namespace Respect\Validation\Rules; class IntVal extends AbstractRule { public function validate($input) { return is_numeric($input) && (int) $input == $input; } } 