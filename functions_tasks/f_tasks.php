<?php

error_reporting(-1);
ini_set('display_errors', 1);

// 1 - Написать функцию, которая возводит число в заданную степень и возвращает его. Число передается в функцию первым аргументом, степень - вторым. По-умолчанию аргумент степени должен принимать значение 2. (Использовать встроенную в язык функцию pow нельзя)

function myPow($num, $powNum = 2) {

    $tmp = $num;
    for ($i = 1; $i < $powNum; $i++) {
        $num *= $tmp;
    }
    return $num;
}

echo myPow(4, 3) . "\n";
echo pow(4, 3);

// 2 - Написать функцию, которая создает массив и заполняет его случайными числами в диапазоне, указанном пользователем. Функция должна принимать три аргумента - начало диапазона, его конец и длину требуемого массива. После генерации она должна вернуть созданный массив

function randArr($randMin, $randMax, $arrLength) {
    $arr = array();

    for ($i = 0; $i < $arrLength; $i++) {
        $arr[] = rand($randMin, $randMax);
    }
    return $arr;
}

print_r(randArr(2, 10, 10));

// 3 - Написать функцию, которая будет возвращать сумму элементов целочисленного массива, который был передан в нее первым аргуметом.

function sumOfElementsArray($arr) {
    $sum = 0;

    foreach ($arr as $value) {
        $sum += $value;
    }

    return $sum;
}

echo sumOfElementsArray([2, 3, 5]) . "\n";

// 4 - Сгенерировать десять массивов из случайных чисел. Найти среди них один с максимальной суммой элементов и вывести его на экран. При решении задачи использовать две функции из двух задач выше.

function generateAndMaxSum() {
    $overlordArray = array();

    for ($i = 0; $i < 10; $i++) {
        $overlordArray[] = randArr(1, 30, 6);
    }

    for ($i = 1; $i <= count($overlordArray); $i++) {
        for ($j = $i; $j < count($overlordArray); $j++) {
            if(sumOfElementsArray($overlordArray[$i-1]) > sumOfElementsArray($overlordArray[$j])) {
                $tmp = $overlordArray[$i-1];
                $overlordArray[$i-1] = $overlordArray[$j];
                $overlordArray[$j] = $tmp;
            }
        }
    }

    print_r($overlordArray[count($overlordArray) - 1]);
}

generateAndMaxSum();

// 5 - Написать функцию, которая принимает один аргумент по ссылке - строку. Функция должна добавить в конец входящей строки строку functioned!. Возвращать функция ничего не должна.

function addToString(&$str) {
    $str .= " functioned!" . "\n";
}

$myString = "It is";

addToString($myString);

echo $myString;

// 6 -- Написать функцию, которая принимает один аргумент - натуральное число n. Функция должна вывести все числа от 1 до n через пробел. Циклы или функцию range использовать нельзя.

function recursiveToNum($n) {
    if ($n != 0) {
        recursiveToNum(--$n);
        echo $n + 1 . " ";
    }
}

recursiveToNum(10);