<?php

if(isset($ajax) && $ajax){
    $res = [
        'flag'=> true,
    ];

    qh_util_sessions('des', 'ad_user');

    echo xn_json_encode($res);
}else{
    xn_log('invalid method, need ajax:'.$_SERVER['REQUEST_URI'], 'log_error');
    qh_util_status(404);
    exit;
}

// end login