<?php

function calculate($a, $b, $operator) {
    switch ($operator) {
        case '+':
            echo $a + $b;
            break;
        case '-':
            echo $a - $b;
            break;
        case '*':
            echo $a * $b;
            break;
        case '/':
            if($b == 0) {
                echo "Разделить на " . $b . " нельзя";
                break;
            }
            echo $a / $b;
            break;
        case '%':
            if($b == 0) {
                echo "Найти остаток от делителя на " . $b . " нельзя";
                break;
            }
            echo $a % $b;
            break;

        default:
            break;
    }
}

calculate(33, 33, '+');
//calculate(33, 66, '-');
//calculate(33, 0, '/');
//calculate(33, 2, '/');
//calculate(10, 2, '%');
//calculate(-10, 2, '*');

?>