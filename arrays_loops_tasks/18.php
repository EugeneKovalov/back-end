<?php

$arr = array('понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье');

foreach ($arr as $value) {
    if ($value == 'суббота' || $value == 'воскресенье') {
        echo "<b>" . $value . "</b>" . "\n";
    } else {
        echo $value . "\n";
    }
}
