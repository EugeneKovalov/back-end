<?php

// $s hold km value
$s = 120;

// $t hold hour value
$t = 2;

function kmPerHour($s, $t) {
    return $s / $t;
}

function metersPerSec($s, $t) {
    return ($s * 1000) / (($t * 60) * 60);
}

echo kmPerHour($s, $t) . "\n";
echo metersPerSec($s, $t);

?>