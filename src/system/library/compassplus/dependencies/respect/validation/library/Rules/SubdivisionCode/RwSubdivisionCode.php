<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class RwSubdivisionCode extends AbstractSearcher { public $haystack = [ '01', '02', '03', '04', '05', ]; public $compareIdentical = true; } 