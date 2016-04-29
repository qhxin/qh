<?php

if(isset($ajax) && $ajax){

    $send = param('send', '', false);
    $res = [];
    if(strlen($send)>0){
        $data = xn_json_decode($send);
        if(!is_null($data) && isset($data['name']) && isset($data['pass']) && isset($data['vcode'])){
            $res = [
                'flag'=> false,
            ];
            if($data['vcode'] == qh_util_sessions('get', 'login_vcode')){
                $origin_name = 'qhxin';
                $origin_pass = '123456';

                if($data['name'] == $origin_name  && $data['pass'] == md5($origin_name.$origin_pass.$data['vcode'])){
                    // record ad_user
                    qh_util_sessions('set', 'ad_user', [
                        'name' => $origin_name,
                    ]);
                    // destroy vcode
                    qh_util_sessions('des', 'login_vcode');
                    $res['flag'] = true;
                }
            }else{
                $res['code'] = 1;
            }
        }else{
            xn_log('admin login argument lose', 'adm_login_err');
        }
    }

    echo xn_json_encode($res);
}elseif($method == 'GET'){

    qh_util_template('header', [
        'title' => '后台登录',
        'css' => [
            '/css/adm/login.css',
        ],
    ]);

    qh_util_template('adm/login_body');

    qh_util_template('footer', [
        'scripts' => [
            '/js/adm/login.js',
        ],
    ]);
}

// end login