<?php

$number = 123456789;

function sumOfNumber($number) {
    if (is_numeric($number)) {
        $result = 0;
        $length = strlen((string) $number);

        for ($i = 0; $i < $length; $i++) {
            $result += $number % 10;
            $number = floor($number / 10);
        }

        echo $result;
    } else {
        echo "Введите корректное числовое значение.";
    }
}

sumOfNumber($number);