<?php

function task1() {

    $pi = 4; $top = 4; $bot = 3; $minus = TRUE;
    $accuracy = 10000000;

    $max_threshold = 1000;
    $threshold = 0;
    
    for($i = 0; $i < $accuracy; $i++)
    {
        $pi += ( $minus ? -($top/$bot) : ($top/$bot) );
        $minus = ( $minus ? FALSE : TRUE);
        $bot += 2;
        if ($threshold < $max_threshold) {
            $threshold++;
            yield true;
        }
    }

    print "Pi ~=: " . $pi;
}

function runner(array $steps) {
    while (true) {
        foreach ($steps as $key => $step) {
             $step->next();
             if (!$step->valid()) {
                 unset($steps[$key]);
             }
        }
        if (empty($steps)) return;
    }
}

runner([task1()]);