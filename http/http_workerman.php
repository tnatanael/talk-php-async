<?php

require '../vendor/autoload.php';

use Workerman\Worker;

$http_worker = new Worker("http://0.0.0.0:8080");

$http_worker->count = 2;

// Emitted when data received
$http_worker->onMessage = function($connection, $data)
{
    $return = '';

    // $_GET, $_POST, $_COOKIE, $_SESSION, $_SERVER, $_FILES estão disponíveis
    switch ($_SERVER['REQUEST_URI']) {
        case "/":
            $return = "Esta é a home!";
            break;
        case "/page1":
            $return = "Esta é a página 1!";
            break;
        case "/page2":
            $return = "Esta é a página 2!";
            break;
    }

    $connection->send($return);

};

Worker::runAll();
