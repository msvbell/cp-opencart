<?php
 namespace Respect\Validation\Exceptions; class NumericException extends ValidationException { public static $defaultTemplates = [ self::MODE_DEFAULT => [ self::STANDARD => '{{name}} must be numeric', ], self::MODE_NEGATIVE => [ self::STANDARD => '{{name}} must not be numeric', ], ]; } 