<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class UySubdivisionCode extends AbstractSearcher { public $haystack = [ 'AR', 'CA', 'CL', 'CO', 'DU', 'FD', 'FS', 'LA', 'MA', 'MO', 'PA', 'RN', 'RO', 'RV', 'SA', 'SJ', 'SO', 'TA', 'TT', ]; public $compareIdentical = true; } 