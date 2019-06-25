<?php

while (true) {
    if ( '' != file_get_contents( 'log' ) )
    {
        echo "Saiu\n";
        exit;
    } else {
        echo "Ocioso\n";
    }

    sleep(1);
}