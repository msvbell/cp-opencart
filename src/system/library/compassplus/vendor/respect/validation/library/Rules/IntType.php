<?php
 namespace Respect\Validation\Rules; class IntType extends AbstractRule { public function validate($input) { return is_int($input); } } 