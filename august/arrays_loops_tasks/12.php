<?php

$n = 1000;
$num = 0;

for ($i = 0; $i < $n; $i++) {
    $num = $i;

    if ($n < 50) {
        echo $n . " | " . $num . "\n";
        return;
    }
    $n /= 2;
}

$n = 1000;
$num = 0;

while ($n >= 50) {
    $num++;
    $n /= 2;
}

echo $n . " | " . $num . "\n";
