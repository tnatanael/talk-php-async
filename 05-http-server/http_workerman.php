<?php

require '../vendor/autoload.php';

use Workerman\Worker;

$http_worker = new Worker("http://0.0.0.0:8080");

$http_worker->count = 2;

$http_worker->onMessage = function($connection, $data)
{
    $ret = '';

    // $_GET, $_POST, $_COOKIE, $_SESSION, $_SERVER, $_FILES estão disponíveis
    switch ($_SERVER['REQUEST_URI']) {
        case "/":
            $ret = "Esta é a <strong>home</strong>!";
            break;
        case "/page1":
            $ret = "Página <strong>1</strong>!";
            break;
        case "/page2":
            $ret = "Página <strong>2</strong>!";
            break;
    }

    $connection->send($ret);

};

Worker::runAll();
