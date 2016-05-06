<?php

if(isset($ajax) && $ajax){

    $logined = qh_util_sessions('has', 'ad_user') && ($ad_user = qh_util_sessions('get', 'ad_user'));
    $res = [
        'flag'=>false,
    ];

    if($logined && isset($ad_user['name'])){

        $send = param('send', '', false);
        $res = [];
        if(strlen($send)>0) {
            $data = xn_json_decode($send);
            if (!is_null($data) && isset($data['fid'])) {

            }else{
                xn_log('admin info set argument lose', 'adm_login_err');
            }
        }
        // TODO SQL
        $arr = db_find('SELECT * FROM types '.cond_to_sqladd(array('type_isvalid'=> 1)).orderby_to_sqladd(array('type_id'=> 1)));
        if($arr !== FALSE){
            $res['data'] = [
                '0id'=> '回收站',
            ];
            foreach($arr as $each){
                $res['data'][$each['type_id'].'id'] = $each['type_name'];
            }
            $res['flag'] = true;
        }
    }else{
        xn_log('getArticleList without login.', 'adm_login_err');
    }

    echo json_encode($res);

}else{
    xn_log('invalid method, need ajax:'.$_SERVER['REQUEST_URI'], 'log_error');
    qh_util_status(404);
    exit;
}

// end login