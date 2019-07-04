<?php

$num = 0;

foreach (range(1, 1000000) as $num) {
    $num += $num * pi();
}

echo $num;