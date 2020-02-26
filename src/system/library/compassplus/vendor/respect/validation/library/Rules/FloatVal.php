<?php
 namespace Respect\Validation\Rules; class FloatVal extends AbstractRule { public function validate($input) { return is_float(filter_var($input, FILTER_VALIDATE_FLOAT)); } } 