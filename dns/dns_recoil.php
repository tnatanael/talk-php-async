<?php

require '../vendor/autoload.php';

use Recoil\React\ReactKernel;
use Recoil\Recoil;

function resolve($name, React\Dns\Resolver\Resolver $resolver)
{
    try {
        $ip = yield $resolver->resolve($name);
        echo 'Resolved "' . $name . '" to ' . $ip . PHP_EOL;
    } catch (Exception $e) {
        echo 'Failed to resolve "' . $name . '" - ' . $e->getMessage() . PHP_EOL;
    }
}

ReactKernel::start(function () {
    $resolver = (new React\Dns\Resolver\Factory)->create(
        '8.8.8.8',
        yield Recoil::eventLoop()
    );

    yield [
        resolve("silverstripe.org", $resolver),
        resolve("wordpress.org", $resolver),
        resolve("wardrobecms.com", $resolver),
        resolve("pagekit.com", $resolver),
    ];

    echo 'Done.' . PHP_EOL;
});
