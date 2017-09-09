<?php
$rows = 0;
$cols = 0;

$arr = array('red', 'yellow', 'blue', 'gray', 'maroon', 'brown', 'green');

function createTable($rows, $cols, $arr) {
    echo "<table>";
    for ($i = 0; $i < $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $randNum = rand(0, count($arr) - 1);
            echo "<td style='background-color: $arr[$randNum]'>" . rand(0, 200) . "</td>";
        }
        echo "</tr>";
    }
    echo "<table>";
}

createTable(2, 3, $arr);