<?php

error_reporting(-1);
ini_set('display_errors', 1);

// 1 - Дан массив элементов 'one', 'two', 'three', 'four', 'five', 'six', при помощи функции usort и анонимной функции для сортировки нужно отсортировать этот массив таким образом, чтобы в итоге его элементы выстроились в таком порядке: 'two', 'one', 'four', 'three', 'six', 'five'.

$arr = array('one', 'two', 'three', 'four', 'five', 'six');

usort($arr, function ($a, $b) {
    static $k = 0;

    if ($k == 0) {
        $k = 1;
        return 1;
    } else if ($k == 1) {
        $k = 0;
    } else if ($k == -1) {
        $k = 0;
    }
});

print_r($arr);

// 2 - /При помощи функции range создать массив целых чисел произвольной длины. При помощи функции array_filter и анонимной функции отфильтровать элементы массива таким образом, чтобы в нем остались только те элементы, которые делятся одновременно на 3, 2, 5 без остатка.

$arr = range(1, 100);

$arr = array_filter($arr, function ($a) {
    if ($a%3 == 0 && $a%2 == 0 && $a%5 == 0) {
        return true;
    }
});

print_r($arr);

// 3 - Дана строка - Walks Straight walked numbly through the destruction. Nothing left, no one alive.. Разбить строку на массив слов (так, чтобы не осталось спец.символов - , .). При помощи функции usort и анонимной функции для сортировки отсортировать массив таким образом, чтобы его элементы выстроились от самого короткого слова к самому длинному.

$str = "Walks Straight walked numbly through the destruction. Nothing left, no one alive..";
$str = str_replace(".", "", $str);
$str = str_replace(",", "", $str);

$arr = explode(" ", $str);

usort($arr, function ($a, $b) {
    if (strlen($a) > strlen($b)) {
        return 1;
    }
});

print_r($arr);

// 4 - Создать функцию с именем sayHello, которая принимает один аргумент - строку $name(указать тип аргумента). Функция должна выводить сначала строку Привет, $name. А затем строку, в которой будет сказанно, сколько раз функция была вызвана в формате Всего поздоровались $n раз. Вызвать функцию несколько раз с разным значением параметра.

function sayHello(string $name) {
    static $n = 0;

    echo "Привет, " . $name . "\n";
    echo "Всего поздоровались " . ++$n . " раз." . "\n";
}

sayHello("Peter");
sayHello("Vasiliy");
sayHello("Mick");

// 5 - Написать функцию, которая принимает один(!) аргумент - натуральное число. При каждом вызове функция должна возвращать среднее арифметическое значение переданных в нее чисел с учетом всех предыдущих вызовов. Пример:
//    echo func(1);  // 1/1 = 1
//    echo func(5);  // (1+5)/2 = 3
//    echo func(3);  // (1+5+3)/3 = 3
//    echo func(31); // (1+5+3+31)/4 = 10

function averageArithmetic(int $number): int {
    static $n = 0;
    static $count = 0;

    $n += $number;

    return $n / (++$count);
}

echo averageArithmetic(30) . "\n";
echo averageArithmetic(4) . "\n";
echo averageArithmetic(8) . "\n";

//*6. Дано слово, состоящее только из строчных латинских букв. Напишите функцию, которая проверит, является ли это слово палиндромом. Выведите да или нет. При решении этой задачи нельзя использовать циклы, массивы и функции разворота строки. Рекурсия разрешена :)

function palindroRecursive(string $str) {
    static $innerStr = "";
    static $n = 0;

    if($n < strlen($str)) {
        $innerStr = $innerStr . $str[strlen($str) - 1 - $n];
        $n++;
        palindroRecursive($str);
    } else {
        if ($innerStr == $str) {
            echo "yes" . "\n";
        } else {
            echo "no" . "\n";
        }
    }
}

palindroRecursive("DADAD");

//*7. Дано число n, десятичная запись которого не содержит нулей. Получите число, записанное теми же цифрами, но в противоположном порядке. При решении этой задачи нельзя использовать циклы, строки, массивы, разрешается только рекурсия и целочисленная арифметика. Функция должна возвращать целое число, являющееся результатом работы программы, выводить число по одной цифре нельзя. Можно использовать дополнительные аргументы для передачи данных между рекурсивными вызовами. Пример:

//    echo func(235); // 532

function palindroNumberRecursive(int $n) {
    static $innerNum = null;

    if($n != 0) {
        $innerNum = ($innerNum * 10) + $n % 10;
        $n = $n / 10;
        palindroNumberRecursive($n);
    }
    return $innerNum;
}

echo palindroNumberRecursive(452) . "\n";