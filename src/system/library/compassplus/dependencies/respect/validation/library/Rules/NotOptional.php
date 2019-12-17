<?php
 namespace Respect\Validation\Rules; class NotOptional extends AbstractRule { public function validate($input) { return (false === in_array($input, [null, ''], true)); } } 