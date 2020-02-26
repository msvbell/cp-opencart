<?php
 namespace Respect\Validation\Rules; class ResourceType extends AbstractRule { public function validate($input) { return is_resource($input); } } 