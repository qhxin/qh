<?php

defined('ROOT_DIR') OR die();

function qh_util_routes($mod, $act){
    $ma_path = ROOT_DIR.'mod/'.$mod.'/'.$act.'.php';
    if(is_file($ma_path)){
        $ad_user = null;
        if($mod == 'admin' && $act != 'login'){// check admin login
            if(qh_util_sessions('has', 'ad_user')){
                $ad_user = qh_util_sessions('get', 'ad_user');
            }
            if(is_null($ad_user)){
                header('Location:/admin-login.html');
                exit;
            }
        }
        include $ma_path;
    }else{
        xn_log('not found route:'.$_SERVER['REQUEST_URI'], 'log_error');
        qh_util_status(404);
        exit;
    }
}
// end qh_util_routes