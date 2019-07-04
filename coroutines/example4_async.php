<?php

function step1() {
    $f = fopen("file1.txt", 'r');
    while ($line = fgets($f)) {
        echo $line;
        yield true;
    }
}

function step2() {
    $f = fopen("file2.txt", 'r');
    while ($line = fgets($f)) {
        echo $line;
        yield true;
    }
}

function step3() {
    $f = fsockopen("www.example.com", 80);
    stream_set_blocking($f, false);
    $headers = "GET / HTTP/1.1\r\n";
    $headers .= "Host: www.example.com\r\n";
    $headers .= "Connection: Close\r\n\r\n";
    fwrite($f, $headers);
    $body = '';
    while (!feof($f)) {
        $body .= fread($f, 8192);
        yield true;
    }
    echo $body;
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

$tasks = [];

for ($i = 1; $i < 10; $i++) {
    $tasks[] = step1();
    $tasks[] = step2();
    $tasks[] = step3();
}

runner($tasks);
