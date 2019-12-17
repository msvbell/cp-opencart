<?php
 namespace Respect\Validation\Rules; class NullType extends NotEmpty { public function validate($input) { return is_null($input); } } 