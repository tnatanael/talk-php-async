<?php

//Enviando e recebendo dados da coroutine

function gen() {
    $ret = (yield 'yield1');
    var_dump($ret);
    $ret = (yield 'yield2');
    var_dump($ret);
}

$gen = gen();
var_dump($gen->current());
var_dump($gen->send('ret1'));
var_dump($gen->send('ret2'));
