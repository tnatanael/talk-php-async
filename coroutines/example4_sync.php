<?php

function step1() {
    $f = fopen("file1.txt", 'r');
    while ($line = fgets($f)) {
        echo $line;
    }
}

function step2() {
    $f = fopen("file2.txt", 'r');
    while ($line = fgets($f)) {
        echo $line;
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
    }
    echo $body;
}

for ($i = 1; $i < 50; $i++) {
    step1();
    step2();
    step3();
}
