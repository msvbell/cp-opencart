<?php
 namespace Respect\Validation\Rules\SubdivisionCode; use Respect\Validation\Rules\AbstractSearcher; class ClSubdivisionCode extends AbstractSearcher { public $haystack = [ 'AI', 'AN', 'AP', 'AR', 'AT', 'BI', 'CO', 'LI', 'LL', 'LR', 'MA', 'ML', 'RM', 'TA', 'VS', ]; public $compareIdentical = true; } 