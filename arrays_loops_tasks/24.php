<?php

$number = 234252582;

function repeatingNumber($number, $key) {
    $result = 0;
    $length = strlen((string) $number);

    for ($i = 0; $i < $length; $i++) {
        if ($key == $number % 10) {
            $result++;
        }
        $number = floor($number / 10);
    }

    echo $result;
}

repeatingNumber($number, 2);