<?php

// 1 - Выведите на экран $n раз фразу "Silence is golden". (for)

$n = 3;

for ($i = 0; $i < $n; $i++) {
    echo "Silence is golden \n";
}

// 2 - Найти сумму чисел в диапазоне от 1 до 150 (включительно). (for, while)

$sum = 0;

for ($i = 1; $i <= 150; $i++) {
    $sum += $i;
}
echo $sum . "\n";

$sum = 0;
$n = 1;

while ($n <= 150) {
    $sum += $n;
    $n++;
}
echo $sum . "\n";

// 3 - Вывести список натуральных чисел в диапазоне от 1 до 200 (включительно).
for ($i = 1; $i <= 200; $i++) {
    if ($i <= 20) {
        echo $i . "\n";
    } else if ($i <= 100 && $i % 10 == 0) {
        echo $i . "\n";
    } else if ($i <= 1000 && $i % 100 == 0) {
        echo $i . "\n";
    }
}

// 4 - Вывести числа в следущей последовательности: от 200 до 1. (for, while, foreach)
for ($i = 200; $i >= 1; $i--) {
    echo $i . "\n";
}

$n = 200;
while ($n >= 1) {
    echo $n . "\n";
    $n--;
}

$arr = array();
for ($i = 200; $i >= 1; $i--) {
    $arr[$i] = $i;
}

foreach ($arr as $value) {
    echo $value . "\n";
}

// 5 - С помощью цикла вывести произведение чисел от 1 до 50 (for, foreach)
$sum = 1;
for ($i = 1; $i <= 50; $i++) {
    $sum *= $i;
    echo $sum . "\n";
}

$arr = array();
$sum = 1;
for ($i = 1; $i <= 50; $i++) {
    $sum *= $i;
    $arr[$i] = $sum;
}

foreach ($arr as $value) {
    echo $value . "\n";
}

// 6 - Вывести все числа, меньшие 1000, которые делятся без остатка одновременно на 3 и на 5. (for, while)
for ($i = 1; $i < 1000; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo $i . "\n";
    }
}

// 7. Вывести на экран все шестизначные счастливые билеты. Билет называется счастливым, если сумма первых трех цифр в номере билета равна сумме последних трех цифр. Найдите количество счастливых билетов и процент от общего числа билетов.

$arr = array();
$total = 0;

for ($i = 100000; $i <= 999999; $i++) {
    $arr[$i] = $i;
}

foreach ($arr as $value) {
    $firstHalf = 0;
    $secondHalf = 0;

    $tmpNum = $value;

    for ($i = 0; $i < 3; $i++) {
        $firstHalf += substr($tmpNum, 0, 1);
        $tmpNum = substr($tmpNum, 1, strlen((string)$tmpNum));
    }

    for ($i = 0; $i < 3; $i++) {
        $secondHalf += substr($tmpNum, 0, 1);
        if (strlen((string)$tmpNum) != 1) {
            $tmpNum = substr($tmpNum, 1, strlen((string)$tmpNum));
        }
    }

    if ($firstHalf == $secondHalf) {
        echo $value . "\n";
        $total++;
    }
}

echo "Всего счастливых билетов: " . $total . "\n";
echo "Процент общего числа: " . ($total / count($arr)) * 100 . "\n";

// 8 - Заполнить массив длины $n нулями и единицами, при этом данные значения чередуются начиная с нуля. (for, while)

$n = 5;
$arr = array();
$switchNum = 0;

for ($i = 0; $i < $n; $i++) {
    $arr[$i] = $switchNum;

    if ($switchNum == 0) {
        $switchNum = 1;
    } else {
        $switchNum = 0;
    }
}

print_r($arr);

$n = 5;
$arr = array();
$switchNum = 0;

while ($n > 0) {
    //  $arr[count($arr)] - наверняка неэкономное и странное решение - но применил, чтобы не использовать дополнительную переменную
    $arr[count($arr)] = $switchNum;

    if ($switchNum == 0) {
        $switchNum = 1;
    } else {
        $switchNum = 0;
    }
    $n--;
}

print_r($arr);

// 9 - Cоздать массив из $n чисел, каждый элемент которого равен квадрату своего индекса. (for)

$n = 5;
$arr = array();

for ($i = 0; $i < $n; $i++) {
    $arr[$i] = $i * $i;
}
print_r($arr);

// 10 - Даны два упорядоченных по возрастанию массива. Образовать из этих двух массивов единый упорядоченный по возрастанию массив.

// слил, удалил дубликаты значений с помощью splice для равномерного распределения ключей

$arr1 = array();
$arr2 = array();
$arr = array();

for ($i = 0; $i < 10; $i++) {
    $arr1[$i] = $i * 2;
    $arr2[$i] = $i * 3;
}

print_r($arr1);
print_r($arr2);

$size = count($arr1) >= count($arr2) ? count($arr1) : count($arr2);
for ($i = 0; $i < $size; $i++) {
    if ($arr1[$i] < $arr2[$i]) {
        array_push($arr, $arr1[$i]);
        array_push($arr, $arr2[$i]);
    } else {
        array_push($arr, $arr1[$i]);
    }
}
print_r($arr);
for ($i = 1; $i < count($arr); $i++) {
    for ($j = $i; $j < count($arr); $j++) {
        if ($arr[$i - 1] == $arr[$j]) {
            echo $arr[$i - 1] . "\n";
            array_splice($arr, $arr[$i - 2], 1);
        }
    }
}

print_r($arr);

// 11 - Дана переменная $n - число, которое не превосходит 100000 (сто тысяч). Вывести прописью число, которое она хранит (например, 2134 - две тысячи сто тридцать четыре). Массив использовать необязательно.

$arrHundreds = array(
    1 => "сто",
    2 => "двести",
    3 => "триста",
    4 => "четыреста",
    5 => "пятьсот",
    6 => "шестьсот",
    7 => "семьсот",
    8 => "восемьсот",
    9 => "девятьсот"
);

$arrThousands = array(
    1 => "одна тысяча",
    2 => "две тысячи",
    3 => "три тысячи",
    4 => "четыре тысячи",
    5 => "пять тысячь",
    6 => "шесть тысячь",
    7 => "семь тысячь",
    8 => "восемь тысячь",
    9 => "девять тысячь"
);

$arrDecimals = array(
    0 => "ноль",
    1 => "один",
    2 => "два",
    3 => "три",
    4 => "четыре",
    5 => "пять",
    6 => "шесть",
    7 => "семь",
    8 => "восемь",
    9 => "девять",
    10 => "десять",
    11 => "одиннадцать",
    12 => "двенадцать",
    13 => "тринадцать",
    14 => "четырнадцать",
    15 => "пятнадцать",
    16 => "шестнадцать",
    17 => "семнадцать",
    18 => "восемнадцать",
    19 => "девятнадцать"
);

$arrTens = array(
    1 => "десять",
    2 => "двадцать",
    3 => "тридцать",
    4 => "сорок",
    5 => "пятьдесят",
    6 => "шестьдесят",
    7 => "семьдесят",
    8 => "восемьдесят",
    9 => "девяносто"
);

$n = 19323;

if ($n < 100) {
    if ($n < 20) {
        echo $arrDecimals[$n] . "\n";
    } else {
        echo $arrTens[$n / 10] . " " . $arrDecimals[$n % 10] . "\n";
    }
} else if ($n >= 100 && $n < 1000) {
    if ($n % 10 == 0 && $n % 100 == 0) {
        echo $arrHundreds[$n / 100] . "\n";
    } else if ($n % 10 == 0 && $n % 100 != 0 && $n % 100 >= 20) {
        echo $arrHundreds[$n / 100] . " " . $arrTens[($n % 100) / 10] . "\n";
    } else if ($n % 100 < 20) {
        echo $arrHundreds[$n / 100] . " " . $arrDecimals[$n % 100] . "\n";
    } else {
        echo $arrHundreds[$n / 100] . " " . $arrTens[($n % 100) / 10] . " " . $arrDecimals[$n % 10] . "\n";
    }
} else if ($n >= 1000 && $n < 100000) {
    if ($n < 10000) {
        if ($n % 1000 == 0) {
            echo $arrThousands[($n % 10000) / 1000] . "\n";
        } else if ($n % 100 == 0) {
            echo $arrThousands[($n % 10000) / 1000] . " " . $arrHundreds[(($n % 10000) / 100) % 10] . "\n";
        } else if ($n % 10 != 0 && $n % 100 != 0 && $n % 100 < 20 && ($n % 10000) / 100 % 10 == 0) {
            echo $arrThousands[($n % 10000) / 1000] . " " . $arrDecimals[$n % 100] . "\n";
        } else if ($n % 10 == 0 && $n % 100 != 0 && ($n % 10000) / 100 % 10 == 0) {
            echo $arrThousands[($n % 10000) / 1000] . " " . $arrTens[($n % 100) / 10] . "\n";
        } else if ($n % 10 != 0 && $n % 100 != 0 && $n % 100 >= 20 && ($n % 10000) / 100 % 10 == 0) {
            echo $arrThousands[($n % 10000) / 1000] . " " . $arrTens[($n % 100) / 10] . " " . $arrDecimals[$n % 10] . "\n";
        } else if ($n % 100 < 20) {
            echo $arrThousands[($n % 10000) / 1000] . " " . $arrHundreds[(($n % 10000) / 100) % 10] . " " . $arrDecimals[$n % 100] . "\n";
        } else if ($n % 10 == 0) {
            echo $arrThousands[($n % 10000) / 1000] . " " . $arrHundreds[(($n % 10000) / 100) % 10] . " " . $arrTens[($n % 100) / 10] . "\n";
        } else {
            echo $arrThousands[($n % 10000) / 1000] . " " . $arrHundreds[(($n % 10000) / 100) % 10] . " " . $arrTens[($n % 100) / 10] . " " . $arrDecimals[$n % 10] . "\n";
        }
    } else {
        echo $n % 100;
        if ($n % 10000 == 0) {
            echo $arrTens[($n % 100000) / 10000] . " тысячь" . "\n";
        } else if ($n % 1000 == 0 && $n % 100000 / 1000 < 20) {
            echo $arrDecimals[$n % 100000 / 1000] . " тысячь" . "\n";
        } else if ($n % 1000 == 0 && $n % 100000 / 1000 >= 20) {
            echo $arrTens[($n % 100000) / 10000 % 10] . " " . $arrThousands[($n % 100000) / 1000 % 10] . "\n";
        } else if ($n % 100 == 0 && $n % 100000 / 1000 < 20) {
            echo $arrDecimals[$n % 100000 / 1000] . " тысячь " . $arrHundreds[$n % 1000 / 100] . "\n";
        } else if ($n % 100 == 0 && $n % 100000 / 1000 < 20) {
            echo $arrDecimals[$n % 100000 / 1000] . " тысячь " . $arrHundreds[$n % 1000 / 100] . "\n";
        } else if ($n % 100 == 0 && $n % 100000 / 1000 >= 20) {
            echo $arrTens[($n % 100000) / 10000 % 10] . " " . $arrThousands[($n % 100000) / 1000 % 10] . " " . $arrHundreds[$n % 1000 / 100] . "\n";
        } else if ($n % 10 == 0 && $n % 100000 / 1000 < 20) {
            echo $arrDecimals[$n % 100000 / 1000] . " тысячь " . $arrHundreds[$n % 1000 / 100] . " " . $arrTens[$n % 100 / 10] . "\n";
        } else if ($n % 10 == 0 && $n % 100000 / 1000 >= 20) {
            echo $arrTens[($n % 100000) / 10000 % 10] . " " . $arrThousands[($n % 100000) / 1000 % 10] . " " . $arrHundreds[$n % 1000 / 100] . " " . $arrTens[$n % 100 / 10] . "\n";
        } else if ($n % 100000 / 1000 < 20 && $n % 100 < 20) {
            echo $arrDecimals[$n % 100000 / 1000] . " тысячь " . $arrHundreds[$n % 1000 / 100] . " " . $arrDecimals[$n % 100] . "\n";
        } else if ($n % 100000 / 1000 < 20 && $n % 100 > 20) {
            echo $arrDecimals[$n % 100000 / 1000] . " тысячь " . $arrHundreds[$n % 1000 / 100] . " " . $arrTens[$n % 100 / 10] . " " . $arrDecimals[$n % 10]  . "\n";
        } else if ($n % 100000 / 1000 >= 20 && $n % 100 >= 20) {
            echo $arrTens[($n % 100000) / 10000 % 10] . " " . $arrThousands[($n % 100000) / 1000 % 10] . " " . $arrHundreds[$n % 1000 / 100] . " " . $arrTens[$n % 100 / 10] . " " . $arrDecimals[$n % 10] . "\n";
        } else if ($n % 100000 / 1000 >= 20 && $n % 100 < 20) {
            echo $arrTens[($n % 100000) / 10000 % 10] . " " . $arrThousands[($n % 100000) / 1000 % 10] . " " . $arrHundreds[$n % 1000 / 100] . " " . $arrDecimals[$n % 100] . "\n";
        }
    }
} else if ($n == 100000) {
    echo "Сто тысячь =) Фух";
}

// 12 - Создать массив который содержит полный список букв латинского алфавита. Вывести каждую вторую букву алфавита с новой строки. (foreach)
$arr = array();
$tmp = 1;
for ($i = 65; $i < 91; $i++) {
    $arr[$i] = chr($i);
}

foreach ($arr as $value) {
    if ($tmp % 2 == 0) {
        echo $value . "\n";
    }
    $tmp++;
}