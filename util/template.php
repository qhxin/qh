<?php

defined('ROOT_DIR') OR die();

function qh_util_template($file, $tpl = []){
    $ma_path = ROOT_DIR.'tpl/'.$file.'.php';
    if(is_file($ma_path)){
        include $ma_path;
    }else{
        xn_log('not found tpl:'.$ma_path, 'log_error');
        qh_util_status(404);
        exit;
    }
}
// end qh_util_template