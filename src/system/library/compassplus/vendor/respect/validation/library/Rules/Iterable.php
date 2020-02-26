<?php
 if (version_compare(PHP_VERSION, '7.1', '<')) { eval('namespace Respect\Validation\Rules; class Iterable extends IterableType {}'); } 