<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class CsSubdivisionCode extends AbstractSearcher { public $haystack = [ 'KOS', 'MON', 'SER', 'VOJ', ]; public $compareIdentical = true; } 