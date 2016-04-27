<?php

if(!defined('ROOT_DIR')){
    return NULL;
}

return [
    // -------------> xn 依赖的配置
    'db' => [
        'type'=>'pdo_mysql',
        'pdo_mysql' => [
            'master' => [
                'host' => 'localhost',
                'user' => 'root',
                'password' => 'root',
                'name' => 'test',
                'charset' => 'utf8',
                'engine'=>'myisam', // innodb
            ],
            'slaves' => []
        ]
    ],
    'tmp_path' => ROOT_DIR.'store/tmps/', // 可以配置为 linux 下的 /dev/shm ，通过内存缓存临时文件
    'log_path' => ROOT_DIR.'store/logs/',
    'cdn_domain' => false, // 默认false  格式： //qh.test.com
    'cdn_version' => 20160427, // cdn 版本号，用于更新
];