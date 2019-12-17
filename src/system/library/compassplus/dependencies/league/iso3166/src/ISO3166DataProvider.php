<?php
 namespace League\ISO3166; interface ISO3166DataProvider { public function name($name); public function alpha2($alpha2); public function alpha3($alpha3); public function numeric($numeric); } 