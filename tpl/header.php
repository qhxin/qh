<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="mobileoptimized" content="0" />
    <meta content="telephone=no" name="format-detection">
    <title><?php echo isset($tpl['title']) ? $tpl['title']: '管理后台';  ?></title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <meta name="description" content="<?php echo $tpl['description']; ?>"/>
    <meta name="copyright" content="<?php echo $tpl['copyright']; ?>" />

    <!--
　　　　　　　　┏┓　　　┏┓+ +
　　　　　　　┏┛┻━━━┛┻┓ + +
　　　　　　　┃　　　　　　　┃ 　
　　　　　　　┃　　　━　　　┃ ++ + + +
　　　　　　 ████━████ ┃+
　　　　　　　┃　　　　　　　┃ +
　　　　　　　┃　　　┻　　　┃
　　　　　　　┃　　　　　　　┃ + +
　　　　　　　┗━┓　　　┏━┛
　　　　　　　　　┃　　　┃　　　　　　　　　　　
　　　　　　　　　┃　　　┃ + + + +
　　　　　　　　　┃　　　┃　　　　Code is far away from bug with the animal protecting　　　　　　　
　　　　　　　　　┃　　　┃ + 　　　　神兽保佑,代码无bug　　Russell　　20160427
　　　　　　　　　┃　　　┃
　　　　　　　　　┃　　　┃　　+　　　　　　　　　
　　　　　　　　　┃　 　　┗━━━┓ + +
　　　　　　　　　┃ 　　　　　　　┣┓
　　　　　　　　　┃ 　　　　　　　┏┛
　　　　　　　　　┗┓┓┏━┳┓┏┛ + + + +
　　　　　　　　　　┃┫┫　┃┫┫
　　　　　　　　　　┗┻┛　┗┻┛+ + + +
    -->
    <link rel="stylesheet" href="<?php echo ($tpl['cdn_domain'] ? $tpl['cdn_domain']: ''), '/css/global.css', $tpl['cdn_version'];  ?>"/>
    <?php

    if(isset($tpl['css']) && is_array($tpl['css'])){
        foreach($tpl['css'] as $k=>$v){
            ?>
            <link rel="stylesheet" href="<?php echo ($tpl['cdn_domain'] ? $tpl['cdn_domain']: ''), $v, $tpl['cdn_version'];  ?>"/>
        <?php
        }
    }

    ?>
</head>
<body>