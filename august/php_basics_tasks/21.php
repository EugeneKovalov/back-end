<?php
// boolean variable $a with a value 0 returns FALSE because,
// only empty string, null type, '0' string or 0 numeric value returns FALSE.

$a = (bool) 0;

var_dump($a);
?>