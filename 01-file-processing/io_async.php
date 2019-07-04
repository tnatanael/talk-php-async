<?php

require '../vendor/autoload.php';

use Spatie\Async\Pool;

$pool = Pool::create();

foreach (range(1, 2) as $i) {
    $pool[] = async(function () use ($i) {

        $result = 'Execução '.$i;

        $fn = fopen('file', 'r');
        $fn2 = fopen('file'.$i, 'a');

        while(! feof($fn))  {
            $line = fgets($fn);
            fwrite($fn2, ((int) $line) * pi());
        }

        fclose($fn);
        fclose($fn2);

        return $result;

    })->then(function (string $output) {
        echo $output;
    });
}

await($pool);
