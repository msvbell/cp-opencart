<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class TjSubdivisionCode extends AbstractSearcher { public $haystack = [ 'GB', 'KT', 'SU', ]; public $compareIdentical = true; } 