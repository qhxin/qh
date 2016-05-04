<?php

function set_vcode(){
    $font_path = ROOT_DIR. 'public/fonts/PenthouseShadow-Medium.ttf';
//    $font_path = ROOT_DIR. 'public/fonts/BOOKOSB.TTF';
    $str = "23456789abcdefghijkmnpqrstuvwxyz";
    $str_la = strlen($str) - 1;
    $v_code = '';
    $num = 4;
    for($i = 0; $i < $num; $i++){
        $v_code .= $str{(mt_rand(0, $str_la))};
    }
    qh_util_sessions('set', 'login_vcode', $v_code);
    vCode($v_code, $num, 18, 90, 30, $font_path);
}

function vCode($code, $num = 4, $size = 20, $width = 0, $height = 0, $font_path =  '') {
    $x_sise = $size * 3 / 4;

    !$width && $width = (2+$num) * $x_sise ;
    !$height && $height = $size + 20;

    $im = imagecreatetruecolor($width, $height);

    $back_color = imagecolorallocate($im, 201, 226, 240);
    $boer_color = imagecolorallocate($im, 153, 193, 226);

    imagefilledrectangle($im, 0, 0, $width, $height, $back_color);

    for($i = 0;$i < $num; $i++){
        $step_x = ($i+1)*$x_sise ;
        $text_color = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
        @imagefttext($im, mt_rand($size - 2, $size+2) , mt_rand( -10, 10), $step_x, mt_rand($size+4, $size+6), $text_color, $font_path , $code{$i});
    }

    for($i = 0;$i < 5;$i++) {
        $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagearc($im, mt_rand(- $width, $width), mt_rand(- $height, $height), mt_rand(30, $width * 2), mt_rand(20, $height * 2), mt_rand(0, 360), mt_rand(0, 360), $font_color);
    }

    for($i = 0;$i < 150;$i++) {
        $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $font_color);
    }

    imagerectangle($im, 0, 0, $width-1, $height-1, $boer_color);

    imagepng($im);
    imagedestroy($im);
}

set_vcode();
// end vcode