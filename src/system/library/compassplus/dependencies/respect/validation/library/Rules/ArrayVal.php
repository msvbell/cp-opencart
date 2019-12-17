<?php
 namespace Respect\Validation\Rules; class ArrayVal extends AbstractRule { public function validate($input) { return is_array($input) || $input instanceof \ArrayAccess; } } 