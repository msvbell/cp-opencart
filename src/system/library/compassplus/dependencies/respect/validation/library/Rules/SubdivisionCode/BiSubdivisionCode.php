<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class BiSubdivisionCode extends AbstractSearcher { public $haystack = [ 'BB', 'BL', 'BM', 'BR', 'CA', 'CI', 'GI', 'KI', 'KR', 'KY', 'MA', 'MU', 'MW', 'MY', 'NG', 'RT', 'RY', ]; public $compareIdentical = true; } 