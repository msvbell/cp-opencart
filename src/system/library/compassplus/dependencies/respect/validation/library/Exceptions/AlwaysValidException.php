<?php
 namespace Respect\Validation\Exceptions; class AlwaysValidException extends ValidationException { public static $defaultTemplates = [ self::MODE_DEFAULT => [ self::STANDARD => '{{name}} is always valid', ], self::MODE_NEGATIVE => [ self::STANDARD => '{{name}} is always invalid', ], ]; } 