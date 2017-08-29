<?php

$age = "ch";

if ($age >= 18 && $age <= 59) {
    echo "Вам еще работать и работать";
} else if ($age > 59) {
    echo "Вам пора на пенсию";
} else if ($age < 0 || !is_numeric($age)) {
    echo "Неизвестный возраст";
} else if ($age >= 0 && $age < 18) {
    echo "Вам еще рано работать";
}

?>