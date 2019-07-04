<?php

$port = 8080;

$server = new swoole_websocket_server("0.0.0.0", $port);

$server->on('start', function() use ($port) {
    echo 'Servidor iniciado porta '.$port . PHP_EOL;
});

$server->on('open', function($server, $req) {
    echo "Nova Conexão: {$req->fd}\n";
});

$server->on('request', function ($request, $response) use ($server) {
    $response->header("Content-Type", "text/plain");

    if ($request->server['request_uri'] == "/ws_message") {
        foreach($server->connections as $id) {
            //TODO: Checar o Header Upgrade e Só enviar para as Conexões que forem WebSocket
            $server->push($id, "Oi Denovo Abiguinho!");
        }
        $response->end("Mensagem enviada!");
    } else {
        $response->end("Oi!");
    }
});

$server->on('message', function($server, $frame) {
    echo "Mensagem WebSocket Recebida: {$frame->data}\n";
    echo "ID da Conexão: {$frame->fd}\n";

    $server->push($frame->fd, "Oi Abiguinho");
});

$server->on('close', function($server, $fd) {
    echo "Conexão fechada: {$fd}\n";
});

$server->start();

