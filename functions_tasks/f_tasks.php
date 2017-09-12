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

echo sumOfElementsArray([2, 3, 5]);

// 4 - Сгенерировать десять массивов из случайных чисел. Найти среди них один с максимальной суммой элементов и вывести его на экран. При решении задачи использовать две функции из двух задач выше.

function generateAndMaxSum() {
    // Тут я очень грубо пошел( Потом сделаю универсально и кратче.

    $arr1 = randArr(2, 10, 5);
    $arr2 = randArr(0, 8, 5);
    $arr3 = randArr(2, 20, 3);
    $arr4 = randArr(2, 10, 9);
    $arr5 = randArr(5, 15, 12);
    $arr6 = randArr(0, 2, 23);
    $arr7 = randArr(0, 6, 6);
    $arr8 = randArr(4, 12, 3);
    $arr9 = randArr(1, 8, 7);
    $arr10 = randArr(0, 6, 9);

    function myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10) {
        return max(sumOfElementsArray($arr1), sumOfElementsArray($arr2), sumOfElementsArray($arr3),
            sumOfElementsArray($arr4), sumOfElementsArray($arr5), sumOfElementsArray($arr6),
            sumOfElementsArray($arr7), sumOfElementsArray($arr8), sumOfElementsArray($arr9),
            sumOfElementsArray($arr10));
    }

    if (sumOfElementsArray($arr1) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr1);
    } else if (sumOfElementsArray($arr2) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr2);
    } else if (sumOfElementsArray($arr3) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr3);
    } else if (sumOfElementsArray($arr4) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr4);
    } else if (sumOfElementsArray($arr5) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr5);
    } else if (sumOfElementsArray($arr6) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr6);
    } else if (sumOfElementsArray($arr7) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr7);
    } else if (sumOfElementsArray($arr8) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr8);
    } else if (sumOfElementsArray($arr9) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr9);
    } else if (sumOfElementsArray($arr10) == myMax($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10)) {
        print_r($arr10);
    }
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
    echo $n . " ";
    if ($n != 1)
    recursiveToNum(--$n);
}

recursiveToNum(10);