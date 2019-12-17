<?php
 namespace Respect\Validation\Rules; class CallableType extends AbstractRule { public function validate($input) { return is_callable($input); } } 