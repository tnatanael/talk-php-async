<?php

foreach(range(1, 2) as $i) {

    echo 'Execução '.$i;

    $fn = fopen('file', 'r');
    $fn2 = fopen('file'.$i, 'a');

    while(! feof($fn))  {
        $result = fgets($fn);
        fwrite($fn2, ((int) $result) * pi());
    }
    
    fclose($fn);
    fclose($fn2);
}
