<?php

defined('ROOT_DIR') OR die();

function qh_util_routes($mod, $act){
    global $conf;
    global $ajax;
    global $method;
    global $db;
    global $cache;
    $ma_path = ROOT_DIR.'mod/'.$mod.'/'.$act.'.php';
    if(is_file($ma_path)){
        $ad_user = null;
        if($mod == 'admin' && !in_array($act, ['login', 'vcode'])){// check admin login
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

function qh_util_template($file, $tpl = []){
    global $conf;
    $tpl['description'] = isset($tpl['description'])? $tpl['description'] : $conf['description'];
    $tpl['copyright'] = isset($tpl['copyright'])? $tpl['copyright'] : $conf['copyright'];
    $tpl['cdn_domain'] = $conf['cdn_domain'];
    $tpl['cdn_version'] = '?v='.$conf['cdn_version'];
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

function qh_util_status($status){
    ob_clean();
    if($status == 404){
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
    }
    ob_end_flush();
}
// end qh_util_status


function qh_util_sessions($act, $key, $value = null){
    /* get/set/has/des/sid */
    $_result = false;
    switch($act){
        case 'get':
            $_result = null;
            if (is_string($key)) {
                session_start();
                $_result = $_SESSION[$key];
                session_write_close();
            } else {
                xn_log('session key:'.var_export($key, true).'; need:string');
            }
            break;
        case 'set':
            if (is_string($key)) {
                session_start();
                $_SESSION[$key] = $value;
                session_write_close();
                $_result = true;
            } else {
                xn_log('session key:'.var_export($key, true).'; need:string');
            }
            break;
        case 'has':
            if (is_string($key)) {
                session_start();
                $_result = isset($_SESSION[$key]);
                session_write_close();
            } else {
                xn_log('session key:'.var_export($key, true).'; need:string');
            }
            break;
        case 'des':
            session_start();
            unset($_SESSION[$key]);
            session_write_close();
            $_result = true;
            break;
        case 'sid':
            session_start();
            $_result = session_id();
            session_write_close();
            break;
        default:
            xn_log('session act err:'.var_export($act, true));
            break;
    }
    return $_result;
}
// end qh_util_sessions


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