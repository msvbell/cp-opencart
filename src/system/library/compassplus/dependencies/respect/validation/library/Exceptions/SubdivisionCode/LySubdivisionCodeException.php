<?php
 namespace Respect\Validation\Exceptions\SubdivisionCode; use Respect\Validation\Exceptions\SubdivisionCodeException; class LySubdivisionCodeException extends SubdivisionCodeException { public static $defaultTemplates = [ self::MODE_DEFAULT => [ self::STANDARD => '{{name}} must be a subdivision code of Libya', ], self::MODE_NEGATIVE => [ self::STANDARD => '{{name}} must not be a subdivision code of Libya', ], ]; } 