<?php

$pi = 4; $top = 4; $bot = 3; $minus = TRUE;
$accuracy = 10000000;

for($i = 0; $i < $accuracy; $i++)
{
  $pi += ( $minus ? -($top/$bot) : ($top/$bot) );
  $minus = ( $minus ? FALSE : TRUE);
  $bot += 2;
}
print "Pi ~=: " . $pi;
