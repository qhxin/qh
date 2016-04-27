<?php

defined('ROOT_DIR') OR die();

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