<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class KiSubdivisionCode extends AbstractSearcher { public $haystack = [ 'G', 'L', 'P', ]; public $compareIdentical = true; } 