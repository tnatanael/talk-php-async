<?php

use Amp\Artax\Response;
use Amp\Loop;
use function Amp\asyncCall;

require '../vendor/autoload.php';

Loop::run(function () use ($argv) {

    $client = new Amp\Artax\DefaultClient;

    $requestHandler = function () use ($client) {
        try {
            $promise = $client->request($argv[1] ?? 'https://httpbin.org/user-agent');
            $response = yield $promise;

            printf(
                "HTTP/%s %d %s\n\n",
                $response->getProtocolVersion(),
                $response->getStatus(),
                $response->getReason()
            );
            $body = yield $response->getBody();
            print $body . "\n";
        } catch (Amp\Artax\HttpException $error) {
            echo $error;
        }
    };

    for ($i = 0; $i < 10; $i++) {
        asyncCall($requestHandler);
    }
});
