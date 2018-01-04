<?php

$str = 'user.name@domain.com';
//$result = preg_match('/^\w+\.+\w+\.\w$/', $str);
$result = preg_match('/^[a-z0-9.]+@[a-z0-9]+\.[a-z]{2,5}$/i', $str);

var_dump($result);

// Дана строка содержащая HTML.
// Получите все ссылки в этой строке в виде массива (значение атрибутов href="" и src="").
// Учтите, что названия атрибутов может быть в разных регистрах, так же может быть пробел между названием и символом =.

$str =
    '<img src= "images/image11.jpg" />
    <img src="images/image22.jpg" />
    <img sr="images/image2.jpg" />
    <img srC="images/image23.jpg" />
    <img srC="images/image23.jpg" />
    <img SRC= "images/image23.jpg" />
    <a href= "image3.jpg" />
    <a href="images/image3.jpg" />';

$result = [];
preg_match_all('#src=[^>]*|href=[^>]*#i', $str, $result);
preg_match_all('/"([^"]+)"/', $str, $result);
array_shift($result);

var_dump($result);

//Дана строка содержащая переменные PHP. Оберните все переменные в HTML тег <b>

//текст $var текст > текст <b>$var</b> текст
//текст $data["key"] текст > текст <b>$data["key"]</b> текст

$str = 'Text $var ddd , Text $datA["kd"] dcscs Text $data["key"] deeedd';

$result = preg_replace('/(\$[a-zA-Z[\]"]+)([\s])/',
    "<b>$1</b>$2",
    $str);

var_dump($result);

//Дана строка - ссылка на сайт, получить из нее домен.

//https://site.com > site.com
//http://sub.some-site.com.ua/some/page.html > sub.some-site.com.ua

$str = 'https://sub.some-site.ua/so.html';
preg_match('/([a-z0-9.-]+)\//', $str, $result);
array_shift($result);

var_dump($result);

//Замените в строке двойную звездочку на !, не трогая одиночные звездочки и те, которые состоят в группе больше двух

//** some ** message * > ! some ! message *
//another *** message * > another *** message *

$str = '** some ** message * another *** message *';

$result = preg_replace('/(([^*])|(^[.]*))[*]{2,2}([^*])/', '!', $str);

var_dump($result);

//Удалить идущие подряд (через пробел, 1 или больше) два и более одинаковых слова, причем так, чтобы не осталось лишних (двойных) пробелов. Считайте все слова состоящими из маленьких латинских букв.

//we we are the the champions > we are the champions
//hello hello world > hello world
$str = 'we we  we are the  the champions champions ';
$result = preg_replace('/\b(\w+)+(\s+\1\b)+/', '$1', $str);

var_dump($result);
