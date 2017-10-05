<?php

error_reporting(-1);
ini_set('display_errors', 1);

// 1 - Дана строка. Найти количество слов, начинающихся с буквы b.
function bWordsCounter($str) {
    $counter = 0;

    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] == ' ' && $str[$i + 1] == 'b' || $str[$i + 1] == 'B') {
            $counter++;
        }
    }
    echo $counter . "\n";
}

bWordsCounter("We play ball at the beach.");

// 2 - Дана строка. Подсчитать, сколько в ней букв r, k, t. Вывести результат в виде массива.
function rktLettersInWords($str) {
    $result = array( 'r' => 0, 'k' => 0, 't' => 0 );

    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] == 'r') {
            $result['r']++;
        } else if ($str[$i] == 'k') {
            $result['k']++;
        } else if ($str[$i] == 't') {
            $result['t']++;
        }
    }
    return $result;
}

$arr = rktLettersInWords("roll-playing skateboard");

print_r($arr);

// 3 - Дана строка. Найти длину самого короткого слова и самого длинного слова.
function mostLongAndShortWord($str) {
    // также можно и на точку проверить и сделать после trim строки
    $str = str_replace(',', '', $str);
    $arr = mb_split(' ', $str);

    for ($i = 1; $i < count($arr); $i++) {
        for ($j = $i; $j < count($arr); $j++) {
            if (strlen($arr[$j]) < strlen($arr[$i - 1])) {
                $tmp = $arr[$i - 1];
                $arr[$i - 1] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }

    echo "длина самого короткого слова: " . strlen($arr[0]) . ". длина самого длинного слова: " . strlen($arr[count($arr) - 1]) . "\n";
}

mostLongAndShortWord("float wind jellyfish wildest");

// 4 - Дана строка символов, среди которых есть одно двоеточие :. Определить, сколько символов ему предшествует.
function countSymbolsBefore($str) {
    $counter = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] != ' ') {
            $counter++;
        }

        if ($str[$i] == ':') {
            echo $counter - 1 . "\n";
            break;
        }
    }
}

countSymbolsBefore("Lete s like: something");

// 5 - Дана строка. Определить, сколько раз в нее входит подстрока abc.
function subAbc($str) {
    $counter = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        if ($i + 1 < strlen($str)) {
            if ($str[$i] == 'a' && $str[$i+1] == 'b' && $str[$i+2] == 'c') {
                $counter++;
            }
        }
    }

    echo $counter . "\n";
}

subAbc("Sbc Bab Sabc abc sabcWd cba ba abc");

// 6 - Дана строка. Подсчитать, сколько уникальных символов встречается в ней. Вывести их на экран в виде массива.
function countUniqueSymbols($str) {
    $arr = array();

    for ($i = 0; $i < strlen($str); $i++) {
        if (strpos($str, $str[$i]) == strrpos($str, $str[$i])) {
            array_push($arr, $str[$i]);
        }
    }
    return $arr;
}

print_r(countUniqueSymbols("austria"));

// 7 - Дана строка. Найти в ней те слова, которые начинаются и оканчиваются одной и той же буквой.
function startEndSameLetter($str) {
    $str = str_replace(',', '', $str);
    $arr = mb_split(' ', $str);

    for ($i = 0; $i < count($arr); $i++) {
        $tmp = strlen((string)$arr[$i]);

        if ($arr[$i][0] == $arr[$i][$tmp - 1]) {
            echo $arr[$i] . "\n";
        }
    }
}

startEndSameLetter("same wow, sos, sun");

// 8 - Дана строка. В строке заменить все двоеточия : точкой с запятой ;. Подсчитать количество замен.
function replaceSymbols($str) {
    $count = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        str_replace(':', ';', $str, $count);
    }
    echo $count . "\n";
}

replaceSymbols("Bla: bla:: bla");

// 9 - Дана строка, содержащая буквы, целые неотрицательные числа и иные символы. Требуется все числа, которые встречаются в строке, поместить в отдельный целочисленный массив. Например, если дана строка bear 48 tail9 read13 bl0b, то в массиве должны оказаться числа 48, 9, 13 и 0.
function numbersInString($str) {
    $arr = array();
    $tmp = "";

    for ($i = 1; $i <= strlen($str); $i++) {
        if (is_numeric($str[$i - 1])) {
            $tmp = $tmp . $str[$i - 1];

            if (!is_numeric($str[$i])) {
                array_push($arr, $tmp);
                $tmp = "";
            }
        }
    }
    return $arr;
}

print_r(numbersInString("D0dw467RD9 dwa3 21 dwd4024221- - R2D2"));

// 10 - Дана строка. Определите, каких букв (строчных или прописных) в ней больше, и преобразуйте следующим образом: если больше прописных(больших) букв, чем строчных(маленьких), то все буквы преобразуются в прописные; если больше строчных, то все буквы преобразуются в строчные; если поровну и тех и других — текст остается без изменения.

function countUpperLower($str) {
    $upperCounter = 0;
    $lowerCounter = 0;

    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] >= 'A' && $str[$i] <= 'Z') {
            $upperCounter++;
        }
        if ($str[$i] >= 'a' && $str[$i] <= 'z') {
            $lowerCounter++;
        }
    }

    if ($upperCounter > $lowerCounter) {
        $str = mb_strtoupper($str);
    } else if ($lowerCounter > $upperCounter) {
        $str = mb_strtolower($str);
    }

    return $str . "\n";
}

echo countUpperLower("RaDwIFdCdddxPfew");

// 11 - Строка содержит одно слово. Проверить, будет ли оно читаться одинаково справа налево и слева направо (т.е. является ли оно палиндромом).
function palWord($str) {
    $tmp = "";
    for ($i = strlen($str) - 1; $i >= 0; $i--) {
        $tmp .= $str[$i];
    }

    if ($str == $tmp) {
        echo "Слово является палиндромом. " . "\n";
    } else {
        echo "Слово не является палиндромом." . "\n";
    }
}

palWord("wow");

// 12 - Дана строка, в которой слова зашифрованы — каждое из них записано наоборот. Расшифровать строку и вывести на экран
function reverseWords($str) {
    $arr = mb_split(' ', $str);
    $str = "";

    for ($i = 0; $i < count($arr); $i++) {
        $k = strlen($arr[$i]) - 1;

        for ($j = 0; $j < strlen($arr[$i]) / 2; $j++) {
            $tmp = $arr[$i][$k - $j];
            $arr[$i][$k - $j] = $arr[$i][$j];
            $arr[$i][$j] = $tmp;
        }
        $str .= $arr[$i] . " ";
    }

    echo $str . "\n";
}

reverseWords("eert ni eht krap");

// 13 - Дана строка, определить, каких букв в ней больше - гласных или согласных.
function vowanAccordant($str) {
    $vowanCounter = 0;
    $accordantCounter = 0;

    $vowan = array('a', 'e', 'i', 'o', 'u', 'y');
    $accordant = array('b', 'c', 'd', 'f', 'g', 'j', 'k', 'l', 'm', 'n', 'p', 'r', 's', 't', 'w', 'x', 'z');

    for ($i = 0; $i < strlen($str); $i++) {
        if (in_array($str[$i], $vowan)) {
            $vowanCounter++;
        }
        if (in_array($str[$i], $accordant)) {
            $accordantCounter++;
        }
    }

    if ($vowanCounter > $accordantCounter) {
        echo "гласных больше" . "\n";
    } else if ($accordantCounter > $vowanCounter) {
        echo "согласных больше" . "\n";
    } else {
        echo "равное кол-во гласных и согласных" . "\n";
    }
}

vowanAccordant("There's a tree");

// 14 - Дан массив строк, в котором хранятся фамилии и инициалы учеников класса (формат: Иванов И.И.). Требуется вывести массив в котором для каждого ученика указано количества его однофамильцев.
function sameLastNamesPerPerson($arr) {
    $resultArr = array();
    for ($i = 1; $i <= count($arr); $i++) {
        $resultArr[$arr[$i - 1]] = 0;
        $tmp = substr($arr[$i - 1], 0, strpos($arr[$i - 1], ' '));

        for ($j = 0; $j < count($arr); $j++) {
            if ($tmp == substr($arr[$j], 0, strpos($arr[$j], ' '))) {
                $resultArr[$arr[$i - 1]]++;
            }
        }
        $resultArr[$arr[$i - 1]]--;
    }

    return $resultArr;
}

$arr = array(
    "Иванов И.И.",
    "Петров С.Д.",
    "Сидоров А.Ф.",
    "Петров В.В.",
    "Иванов Ф.А.",
    "Петров Л.О.",
    "Комаров С.С.",
    "Комаров С.E."
);

print_r(sameLastNamesPerPerson($arr));