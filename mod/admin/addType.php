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
            if(!is_null($data) && isset($data['name'])){
                $res = [
                    'flag'=> false,
                ];
                $sqladd = cond_to_sqladd(array('type_name'=> $data['name']));
                $arr = db_find_one('SELECT * FROM types '.$sqladd);
                if($arr===FALSE){
                    $sqlarr = array_to_sqladd(array('type_name'=> $data['name'], 'type_isvalid'=> 1));
                    $new_id = db_exec('INSERT INTO types SET '.$sqlarr);
                    if($new_id !== FALSE){
                        $res['tid'] = $new_id;
                        $res['name'] = $data['name'];
                        $res['flag'] = true;
                    }
                }else{// 重复命名的
                    $res['code'] = 1;
                }
            }else{
                xn_log('admin addType argument lose, need name.', 'adm_login_err');
            }
        }
    }else{
        xn_log('addType without login.', 'adm_login_err');
    }
    echo xn_json_encode($res);
}else{
    xn_log('invalid method, need ajax:'.$_SERVER['REQUEST_URI'], 'log_error');
    qh_util_status(404);
    exit;
}

// end login