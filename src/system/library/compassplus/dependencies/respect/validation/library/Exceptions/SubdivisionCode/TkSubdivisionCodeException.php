<?php
 namespace Respect\Validation\Exceptions\SubdivisionCode; use Respect\Validation\Exceptions\SubdivisionCodeException; class TkSubdivisionCodeException extends SubdivisionCodeException { public static $defaultTemplates = [ self::MODE_DEFAULT => [ self::STANDARD => '{{name}} must be a subdivision code of Tokelau', ], self::MODE_NEGATIVE => [ self::STANDARD => '{{name}} must not be a subdivision code of Tokelau', ], ]; } 