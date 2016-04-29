

<script src="<?php echo ($tpl['cdn_domain'] ? $tpl['cdn_domain']: ''), '/js/jquery-1.8.2.min.js', $tpl['cdn_version'];  ?>" type="text/javascript"></script>
<script src="<?php echo ($tpl['cdn_domain'] ? $tpl['cdn_domain']: ''), '/js/jquery.nicescroll.min.js', $tpl['cdn_version'];  ?>" type="text/javascript"></script>
<script src="<?php echo ($tpl['cdn_domain'] ? $tpl['cdn_domain']: ''), '/js/md5.js', $tpl['cdn_version'];  ?>" type="text/javascript"></script>
<script src="<?php echo ($tpl['cdn_domain'] ? $tpl['cdn_domain']: ''), '/js/global.js', $tpl['cdn_version'];  ?>" type="text/javascript"></script>
<!--[if lte IE 8]>
<script src="<?php echo ($tpl['cdn_domain'] ? $tpl['cdn_domain']: ''), '/js/respond.min.js', $tpl['cdn_version'];  ?>" type="text/javascript"></script>
<![endif]-->
<?php

if(isset($tpl['scripts']) && is_array($tpl['scripts'])){
    foreach($tpl['scripts'] as $k=>$v){
    ?>
<script src="<?php echo ($tpl['cdn_domain'] ? $tpl['cdn_domain']: ''), $v, $tpl['cdn_version'];  ?>"></script>
<?php
    }
}

?>
</body>
</html>