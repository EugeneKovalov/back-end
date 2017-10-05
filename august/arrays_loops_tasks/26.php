<?php

$arr = array();
$result = 0;

for ($i = 0; $i < 15; $i++) {
    $arr[] = rand(1, 100);
}

print_r($arr);

for ($i = 0; $i < count($arr); $i++) {
    if ($i % 2 == 0 && $arr[$i] > 0) {
        $result *= $arr[$i];
    }
}

for ($i = 0; $i < count($arr); $i++) {
    if ($i % 2 != 0 && $arr[$i] > 0) {
        echo $arr[$i] . "\n";
    }
}