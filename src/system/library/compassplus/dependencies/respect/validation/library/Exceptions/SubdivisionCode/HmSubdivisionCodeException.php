<?php
 namespace Respect\Validation\Exceptions\SubdivisionCode; use Respect\Validation\Exceptions\SubdivisionCodeException; class HmSubdivisionCodeException extends SubdivisionCodeException { public static $defaultTemplates = [ self::MODE_DEFAULT => [ self::STANDARD => '{{name}} must be a subdivision code of Heard Island and McDonald Islands', ], self::MODE_NEGATIVE => [ self::STANDARD => '{{name}} must not be a subdivision code of Heard Island and McDonald Islands', ], ]; } 