<?php

defined('ROOT_DIR') OR die();

function qh_util_status($status){
    ob_clean();
    if($status == 404){
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
    }
    ob_end_flush();
}
// end qh_util_status