<?php
 namespace Respect\Validation\Exceptions; class BicException extends ValidationException { public static $defaultTemplates = [ self::MODE_DEFAULT => [ self::STANDARD => '{{name}} must be a BIC', ], self::MODE_NEGATIVE => [ self::STANDARD => '{{name}} must not be a BIC', ], ]; } 