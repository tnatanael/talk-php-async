<?php

require '../vendor/autoload.php';

use React\MySQL\Factory;
use React\MySQL\QueryResult;

$loop = React\EventLoop\Factory::create();
$factory = new Factory($loop);

$uri = 'talk:talk@localhost/talk';
$connection = $factory->createLazyConnection($uri);

$connection->query('SELECT * FROM talk')->then(
    function (QueryResult $command) {
        print_r($command->resultFields);
        print_r($command->resultRows);
        echo count($command->resultRows) . ' row(s) in set' . PHP_EOL;
    },
    function (Exception $error) {
        echo 'Error: ' . $error->getMessage() . PHP_EOL;
    }
);

$connection->quit();

$loop->run();
