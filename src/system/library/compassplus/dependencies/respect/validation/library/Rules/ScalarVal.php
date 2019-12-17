<?php
 namespace Respect\Validation\Rules; class ScalarVal extends AbstractRule { public function validate($input) { return is_scalar($input); } } 