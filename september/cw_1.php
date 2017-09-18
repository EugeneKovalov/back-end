<?php

//function blabla($num) {
//    return $num * $num;
//}

//function sumOfElem(int $a, int $b): int {
//    return $a + $b;
//}
//
//echo sumOfElem(4, 5);

//function counter() {
//    static $count = 0;
//    return ++$count;
//}
//
//$c = 5;
//while ($c != 0) {
//    $c--;
//    echo counter() . "\n";
//}

//explode(‘.’, $string);
//array_reverse($array);
//implode

//12. Написать функцию, которая в качестве аргумента принимает строку, и форматирует ее таким образом, что предложения идут в обратном порядке.
//Пример:

//Входная строка: 'А Васька слушает да ест. А воз и ныне там. А вы друзья как ни садитесь, все в музыканты не годитесь. А король-то — голый. А ларчик просто открывался. А там хоть трава не расти.';

//Строка, возвращенная функцией : 'А там хоть трава не расти. А ларчик просто открывался. А король-то — голый. А вы друзья как ни садитесь, все в музыканты не годитесь. А воз и ныне там.А Васька слушает да ест.'

//function task($str) {
//    return implode('.', array_reverse(explode('.', $str)));
//}
//
//echo task("my mam told me. that's not real.");


//1. Создать форму с двумя элементами textarea. При отправке формы скрипт должен выдавать только те слова, которые есть и в первом и во втором поле ввода. Реализацию это логики необходимо поместить в функцию getCommonWords($a, $b), которая будет возвращать массив с общими словами.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $str1 = $_POST['string1'];
    $str2 = $_POST['string2'];

    print_r(getCommonWords($str1, $str2));
}

function getCommonWords($a, $b) {
    $arr1 = explode(' ', $a);
    $arr2 = explode(' ', $b);
    $resultArr = array_intersect($arr1, $arr2);

    return $resultArr;
}
?>

<form method="post">
    <textarea name="string1"></textarea>
    <textarea name="string2"></textarea>
    <input type="submit" value="send">
</form>
