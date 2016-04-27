<?php

defined('ROOT_DIR') OR die();

function qh_util_obgzip($content){
    if( !headers_sent() &&
        extension_loaded('zlib') &&
        strstr($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip'))
    {
        $content = gzencode($content." \n",9);

        header('Content-Encoding: gzip');
        header('Vary: Accept-Encoding');
        header('Content-Length: '.strlen($content));
    }
    return $content;
}
// end qh_util_obgzip