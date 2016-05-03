$(document).ready(function(){

    $('#mainLayoutContainer').html('<script id="UEditor" type="text/plain" style="width:700px;height:500px;margin:30px auto;"></script>');


    var ue = UE.getEditor('UEditor', {
        toolbars: [[
            'fullscreen', 'source',  'undo', 'redo',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', 'formatmatch', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor',
            'fontfamily', 'fontsize', 'indent', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight',  'insertorderedlist', 'insertunorderedlist',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'insertvideo', 'attachment', 'map', 'insertframe', 'background', '|',
            'horizontal', 'date', 'time', 'spechars',  '|',
            'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols',  '|',
            'print', 'preview', 'searchreplace', 'help'
        ]]
        ,elementPathEnabled : false
    });

});