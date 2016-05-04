<?php

if(isset($ajax) && $ajax){
    $res = [
        'flag'=> false,
    ];

    $ad_user = qh_util_sessions('get', 'ad_user');
    if(isset($ad_user['name'])){
        $res = [
            'flag'=> true,
            'name'=> $ad_user['name'],
        ];
    }

    echo xn_json_encode($res);
}else{
    xn_log('invalid method, need ajax:'.$_SERVER['REQUEST_URI'], 'log_error');
    qh_util_status(404);
    exit;
}

// end login