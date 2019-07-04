<?php

function xrange($start, $end, $step = 1) {
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}

$num = 0;

foreach (xrange(1, 1000000) as $num) {
    $num += $num * pi();
}

echo $num;