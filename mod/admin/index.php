<?php

qh_util_template('header', [
    'title' => '管理后台',
    'css' => [
        '/css/adm/index.css',
    ],
]);

qh_util_template('adm/index');

qh_util_template('footer', [
    'scripts' => [
        '/js/adm/index.js',
        '/ueditor/ueditor.config.js',
        '/ueditor/ueditor.all.min.js',
        '/ueditor/lang/zh-cn/zh-cn.js',
    ],
]);

// end admin index