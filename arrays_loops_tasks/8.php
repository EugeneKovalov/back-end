<?php

$arr = array(
    1, 2, 3, 4, 5, 6, 7, 8, 9
);
$resultStr = "";

foreach ($arr as $value) {
    $resultStr = $resultStr . $value;
}

echo $resultStr . "\n";
echo is_string($resultStr);