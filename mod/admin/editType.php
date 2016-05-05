<?php

if(isset($ajax) && $ajax){

    $logined = qh_util_sessions('has', 'ad_user') && ($ad_user = qh_util_sessions('get', 'ad_user'));
    $res = [
        'flag'=>false,
    ];

    if($logined && isset($ad_user['name'])){

        $send = param('send', '', false);
        $res = [];
        if(strlen($send)>0){
            $data = xn_json_decode($send);
            if(!is_null($data) && isset($data['name']) && isset($data['tid'])){
                $res = [
                    'flag'=> false,
                ];
                $sqladd = cond_to_sqladd(array('type_name'=> $data['name']));
                $arr = db_find_one('SELECT * FROM types '.$sqladd);
                if($arr===FALSE){
                    $efid = db_exec('UPDATE types SET '.array_to_sqladd(['type_name'=> $data['name']]).cond_to_sqladd(['type_id'=> $data['tid']]));
                    if($efid !== FALSE){
                        $res['flag'] = true;
                    }
                }else{// 重复命名的
                    $res['code'] = 1;
                }
            }else{
                xn_log('admin editType argument lose, need name,tid.', 'adm_login_err');
            }
        }
    }else{
        xn_log('editType without login.', 'adm_login_err');
    }
    echo xn_json_encode($res);
}else{
    xn_log('invalid method, need ajax:'.$_SERVER['REQUEST_URI'], 'log_error');
    qh_util_status(404);
    exit;
}

// end login