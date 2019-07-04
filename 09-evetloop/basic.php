<?php

while (true) {
    if ( '' == file_get_contents( 'log' ) )
    {
        echo "Ocioso\n";
    } else {
        echo "Saiu\n";
        exit;
    }

    sleep(1);
}
