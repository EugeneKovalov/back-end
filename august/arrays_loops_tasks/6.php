<?php

$arr = array(
    'green' => 'зеленый',
    'red' => 'красный',
    'blue' => 'синий'
);

$en = array();
$ru = array();

foreach ($arr as $key => $value) {
    $ru[] = $value;
    $en[] = $key;
}

print_r($en);
print_r($ru);

