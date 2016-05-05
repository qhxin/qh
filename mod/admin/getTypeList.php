<?php

if(isset($ajax) && $ajax){

    $logined = qh_util_sessions('has', 'ad_user') && ($ad_user = qh_util_sessions('get', 'ad_user'));
    $res = [
        'flag'=>false,
    ];

    if($logined && isset($ad_user['name'])){

        $arr = db_find('SELECT * FROM types '.cond_to_sqladd(array('type_isvalid'=> 1)).orderby_to_sqladd(array('type_id'=> 1)));
        if($arr !== FALSE){
            $res['data'] = [
                '0'=> '回收站',
            ];
            foreach($arr as $each){
                $res['data'][$each['type_id']] = $each['type_name'];
            }
            $res['flag'] = true;
        }
    }else{
        xn_log('getTypeList without login.', 'adm_login_err');
    }

    echo xn_json_encode($res);

}else{
    xn_log('invalid method, need ajax:'.$_SERVER['REQUEST_URI'], 'log_error');
    qh_util_status(404);
    exit;
}

// end login