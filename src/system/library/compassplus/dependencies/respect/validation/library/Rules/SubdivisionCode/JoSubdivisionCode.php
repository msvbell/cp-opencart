<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class JoSubdivisionCode extends AbstractSearcher { public $haystack = [ 'AJ', 'AM', 'AQ', 'AT', 'AZ', 'BA', 'IR', 'JA', 'KA', 'MA', 'MD', 'MN', ]; public $compareIdentical = true; } 