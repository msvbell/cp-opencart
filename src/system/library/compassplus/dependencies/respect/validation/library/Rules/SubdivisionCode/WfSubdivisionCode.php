<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class WfSubdivisionCode extends AbstractSearcher { public $haystack = [ 'A', 'S', 'W', ]; public $compareIdentical = true; } 