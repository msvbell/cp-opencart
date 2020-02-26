<?php
 namespace Respect\Validation\Rules; class StringType extends AbstractRule { public function validate($input) { return is_string($input); } } 