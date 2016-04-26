<?php

if(!defined('ROOT_DIR')){
    return NULL;
}

return array(
    // -------------> xn 依赖的配置
    'db' => array(
        'type'=>'pdo_mysql',
        'pdo_mysql' => array (
            'master' => array (
                'host' => 'localhost',
                'user' => 'root',
                'password' => 'root',
                'name' => 'test',
                'charset' => 'utf8',
                'engine'=>'myisam', // innodb
            ),
            'slaves' => array()
        )
    ),
    'tmp_path' => ROOT_DIR.'store/tmps/', // 可以配置为 linux 下的 /dev/shm ，通过内存缓存临时文件
    'log_path' => ROOT_DIR.'store/logs/'
);

