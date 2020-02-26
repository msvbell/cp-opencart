<?php
 namespace Respect\Validation\Rules; class ObjectType extends AbstractRule { public function validate($input) { return is_object($input); } } 