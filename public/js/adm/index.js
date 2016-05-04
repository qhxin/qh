$(document).ready(function(){

    var mainLayoutContainer = $('#mainLayoutContainer'),
        mainLayoutTopTitle = $('#mainLayoutTopTitle'),
        mainLayoutTopMethod = $('#mainLayoutTopMethod');

    //mainLayoutContainer.html('<script id="UEditor" type="text/plain" style="width:700px;height:500px;margin:30px auto;"></script>');
    //var ue = UE.getEditor('UEditor', {
    //    toolbars: [[
    //        'fullscreen', 'source',  'undo', 'redo',
    //        'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', 'formatmatch', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor',
    //        'fontfamily', 'fontsize', 'indent', '|',
    //        'rowspacingtop', 'rowspacingbottom', 'lineheight',  'insertorderedlist', 'insertunorderedlist',
    //        'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
    //        'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
    //        'simpleupload', 'insertimage', 'emotion', 'insertvideo', 'attachment', 'map', 'insertframe', 'background', '|',
    //        'horizontal', 'date', 'time', 'spechars',  '|',
    //        'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols',  '|',
    //        'print', 'preview', 'searchreplace', 'help'
    //    ]]
    //    ,elementPathEnabled : false
    //});



    var action = {
        'manage_type' : function(){
            var list = {
                '1': '分类1',
                '2': '分类2',
                '5': '分类3',
                '0': '回收站'
            };console.log(list)
            var html = '<div class="mainBox">';
            for(var i in list){
                if(list.hasOwnProperty(i)){
                    html += '<div class="li" data-id="'+i+'">';
                    if(i==0){
                        html += '<input class="fll" type="text" value="'+list[i]+'" disabled="disabled"/><a class="flr">管理文章</a><a class="flr" style="text-decoration: line-through;">【删除】</a><a class="flr" style="text-decoration: line-through;">【修改】</a><div class="clb"></div>';
                    }else{
                        html += '<input class="fll" type="text" value="'+list[i]+'"/><a class="flr">管理文章</a><a class="flr">【删除】</a><a class="flr">【修改】</a><div class="clb"></div>';
                    }
                    html += '</div>';
                }
            }
            html += '</div>';
            return html;
        }
    };

    var loading = {
        'click_type' : function($pTabBtn){
            if($pTabBtn.length < 1) {
                return;
            }
            var html = '', method_html = '';
            switch ($pTabBtn.data('type')){
                case 'type':
                    method_html = '<a>新增分类</a>';
                    html = action.manage_type();
                    break;
                case 'article':
                    method_html = '<a>新增文章</a>';
                    break;
                case 'files':
                    break;
                case 'orders':
                    break;
                case 'admins':
                    break;
                default :
                    break;
            }
            if(html != ''){
                mainLayoutContainer.html(html);
            }
            mainLayoutTopMethod.html(method_html);
        }
    };


    $('.sysTabs').off('click').on('click', 'a',function(){
        var $this = $(this);

        $this.siblings('a').removeClass('selected');
        $this.removeClass('selected').addClass('selected');

        mainLayoutTopTitle.html($this.html());
        mainLayoutContainer.html('<div class="loading"></div>');

        loading.click_type($this);
    });

    $('.sysTabs a:first').trigger('click');
});