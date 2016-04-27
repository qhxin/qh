<?php

ob_start('qh_util_obgzip');

define('ROOT_DIR', str_replace('\\', '/', dirname(__DIR__)).'/');

$conf = include ROOT_DIR.'conf/conf.php';
include ROOT_DIR.'xn/xiunophp.php';
include ROOT_DIR.'util/obgzip.php';
include ROOT_DIR.'util/status.php';
include ROOT_DIR.'util/routes.php';
include ROOT_DIR.'util/sessions.php';
include ROOT_DIR.'util/template.php';

$mod = str_replace('.', '', param(0));
$act = str_replace('.', '', param(1));

qh_util_routes($mod, $act);

ob_end_flush();
// end index