<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class IsSubdivisionCode extends AbstractSearcher { public $haystack = [ '1', '2', '3', '4', '5', '6', '7', '8', ]; public $compareIdentical = true; } 