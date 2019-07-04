<?php

// Referência:
// https://medium.com/async-php/co-operative-php-multitasking-ce4ef52858a0

require '../vendor/autoload.php';

function resolve($domain, $resolver)
{
    $resolver
    ->resolve($domain)
    ->then(
        function($ip) use ($domain) {
            print "domain: " . $domain . "\n";
            print "ip: " . $ip . "\n";
        },
        function($error) {
            print $error . "\n";
        }
    )->done(function ($result) use ($domain) {
        echo $domain . " resolved!\n";
    });
}

function run()
{
    $loop = React\EventLoop\Factory::create();

    $factory = new React\Dns\Resolver\Factory();

    $resolver = $factory->create("8.8.8.8", $loop);

    resolve("silverstripe.org", $resolver);
    resolve("wordpress.org", $resolver);
    resolve("wardrobecms.com", $resolver);
    resolve("pagekit.com", $resolver);

    $loop->run();
}

run();
