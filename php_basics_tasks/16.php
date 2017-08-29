<?php

function maxOfTwo($a, $b) {
    if ($a === $b) {
        return 'equals values';
    }

    return $a >= $b ? $a : $b;
}

echo maxOfTwo(-33, -33);

?>