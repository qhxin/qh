<?php

if(isset($ajax) && $ajax){

    $send = param('send', '', false);
    $res = [];
    if(strlen($send)>0){
        $data = xn_json_decode($send);
        if(!is_null($data) && isset($data['name']) && isset($data['oldpass'])&& !empty($data['name']) && !empty($data['oldpass'])){
            $res = [
                'flag'=> false,
            ];

            $ad_user = qh_util_sessions('get', 'ad_user');

            $sqladd = cond_to_sqladd(array('adm_name'=> $ad_user['name'], 'adm_pass'=>$data['oldpass']));
            $arr = db_find_one('SELECT * FROM admins '.$sqladd);

            if(isset($arr['adm_id']) && $arr['adm_id']>0){

                $set_value = [
                    'adm_name'=>$data['name'],
                ];
                if(isset($data['newpass']) && !empty($data['newpass'])){
                    $set_value['adm_pass'] = $data['newpass'];
                }
                $sqlset = cond_to_sqladd($set_value);
                $sqlset = substr($sqlset, 6);

                $effcted = db_exec('UPDATE admins SET '.$sqlset.' '.$sqladd);
                if($effcted){
                    $res['flag'] = true;
                }
            }
        }else{
            xn_log('admin info set argument lose', 'adm_login_err');
        }
    }

    echo xn_json_encode($res);

}else{
    xn_log('invalid method, need ajax:'.$_SERVER['REQUEST_URI'], 'log_error');
    qh_util_status(404);
    exit;
}

// end login