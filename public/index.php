<?php

ob_start('qh_util_obgzip');

define('ROOT_DIR', str_replace('\\', '/', dirname(__DIR__)).'/');

global $conf;
$conf = include ROOT_DIR.'conf/conf.php';

include ROOT_DIR.'xn/xiunophp.php';
include ROOT_DIR.'util/util.php';

$mod = str_replace('.', '', param(0));
$act = str_replace('.', '', param(1));

$mod = ($mod==''? 'index': $mod);
$act = ($act==''? 'index': $act);

qh_util_routes($mod, $act);

ob_end_flush();
// end index