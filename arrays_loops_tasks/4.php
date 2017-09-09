<?php

$arr = array(
    'green' => 'зеленый',
    'red' => 'красный',
    'blue' => 'синий'
);

foreach ($arr as $key => $value) {
    echo $key . "\n";
}

foreach ($arr as $value) {
    echo $value . "\n";
}