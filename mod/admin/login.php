<?php

qh_util_template('header', [
    'title' => '后台登录',
    'css' => [
        '/css/adm/login.css',
    ],
]);


qh_util_template('adm/login_body', [
]);

qh_util_template('footer', [
    'scripts' => [
        '/js/adm/login.js',
    ],
]);