<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class MwSubdivisionCode extends AbstractSearcher { public $haystack = [ 'C', 'N', 'S', 'BA', 'BL', 'CK', 'CR', 'CT', 'DE', 'DO', 'KR', 'KS', 'LI', 'LK', 'MC', 'MG', 'MH', 'MU', 'MW', 'MZ', 'NB', 'NE', 'NI', 'NK', 'NS', 'NU', 'PH', 'RU', 'SA', 'TH', 'ZO', ]; public $compareIdentical = true; } 