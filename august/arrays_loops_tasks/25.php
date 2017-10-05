<?php

$arr = array();

for ($i = 0; $i < 10; $i++) {
    $arr[] = rand(0, 150);
}

print_r($arr);

$min = $arr[0];
$max = $arr[0];

for ($i = 1; $i < count($arr); $i++) {

    if ($min > $arr[$i]) {
        $min = $arr[$i];
    }

    if ($max < $arr[$i]) {
        $max = $arr[$i];
    }
}

echo $max . " " . $min;

$boolMin = true;
$boolMax = true;

for ($i = 0; $i < count($arr); $i++) {
    if ($arr[$i] == $min && $boolMin) {
        $arr[$i] = $max;
        $boolMin = false;
    }
    if ($arr[$i] == $max && $boolMax) {
        $arr[$i] = $min;
        $boolMax = false;
    }
}

print_r($arr);

