<?php

defined('ROOT_DIR') OR die();

function qh_util_routes($mod, $act){
    $ma_path = ROOT_DIR.'mod/'.$mod.'/'.$act.'.php';
    if(is_file($ma_path)){
        $ad_user = null;
        if($mod == 'admin' && $act != 'login'){// check admin login
            $ad_user = qh_util_sessions('get', 'ad_user');
            if(is_null($ad_user)){
                header('Location:/admin-login.html');
                exit;
            }
        }
        include $ma_path;
    }else{
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        exit;
    }
}
// end qh_util_routes