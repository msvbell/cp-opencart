<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class HnSubdivisionCode extends AbstractSearcher { public $haystack = [ 'AT', 'CH', 'CL', 'CM', 'CP', 'CR', 'EP', 'FM', 'GD', 'IB', 'IN', 'LE', 'LP', 'OC', 'OL', 'SB', 'VA', 'YO', ]; public $compareIdentical = true; } 