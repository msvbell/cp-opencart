<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class NpSubdivisionCode extends AbstractSearcher { public $haystack = [ '1', '2', '3', '4', '5', 'BA', 'BH', 'DH', 'GA', 'JA', 'KA', 'KO', 'LU', 'MA', 'ME', 'NA', 'RA', 'SA', 'SE', ]; public $compareIdentical = true; } 