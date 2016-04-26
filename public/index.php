<?php

define('ROOT_DIR', str_replace('\\', '/', dirname(__DIR__)).'/');

$conf = include ROOT_DIR.'conf/conf.php';
include ROOT_DIR.'xn/xiunophp.php';


$mod = param(0);
$act = param(1);
$uid = param('uid', 0);

echo $mod, '_', $act, '_', $uid;

print_r($_REQUEST);
print_r($_SERVER);