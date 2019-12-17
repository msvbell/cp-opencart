<?php
 namespace Respect\Validation\Rules; class ArrayType extends AbstractRule { public function validate($input) { return is_array($input); } } 