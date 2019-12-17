<?php
 namespace Respect\Validation\Rules; class BoolType extends AbstractRule { public function validate($input) { return is_bool($input); } } 