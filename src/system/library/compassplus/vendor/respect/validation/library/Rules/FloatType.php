<?php
 namespace Respect\Validation\Rules; class FloatType extends AbstractRule { public function validate($input) { return is_float($input); } } 