<?php
// boolean variable $a with a value 20 returns TRUE because,
// only empty string, null type, '0' string or 0 numeric value returns FALSE.

$a = (bool) 20;

var_dump($a);
?>