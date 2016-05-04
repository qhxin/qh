$(document).ready(function(){

    var mainLayoutContainer = $('#mainLayoutContainer'),
        mainLayoutTopTitle = $('#mainLayoutTopTitle'),
        mainLayoutTopMethod = $('#mainLayoutTopMethod'),
        alwaysKeepAlive = true;

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
            };
            var html = '<div class="mainBox">';
            for(var i in list){
                if(list.hasOwnProperty(i)){
                    html += '<div class="li" data-id="'+i+'">';
                    if(i==0){
                        html += '<input class="fll" type="text" value="'+list[i]+'" disabled="disabled"/><a class="flr">管理文章</a><a class="flr" style="text-decoration: line-through;color: #ccc;">【删除】</a><a class="flr" style="text-decoration: line-through;color: #ccc;">【修改】</a><div class="clb"></div>';
                    }else{
                        html += '<input class="fll" type="text" value="'+list[i]+'"/><a class="flr">管理文章</a><a class="flr">【删除】</a><a class="flr">【修改】</a><div class="clb"></div>';
                    }
                    html += '</div>';
                }
            }
            html += '</div>';


            loading.callback(html, '<a>新增分类</a>');
        },
        'manage_admins' : function(){
            $.ajax({
                'url': '/admin-getUsInfo.html?ajax=1',
                'type': 'POST',
                'dataType': 'JSON'
            }).error(function(){
                alert('网络错误');
                loading.callback('', '');
            }).success(function(data){
                var html = '';
                if(data.flag === 1){
                    html = '<div class="mainBox"><div class="adminForm">' +
                    '<div class="adminFormItem"><div class="adminFormName fll">*账户修改</div><input class="flr adminEditName" type="text" value="'+data.name+'"/><div class="clb"></div></div>' +
                    '<div class="adminFormItem"><div class="adminFormName fll">*当前密码</div><input class="flr adminEditPass" type="password" value=""/><div class="clb"></div></div>' +
                    '<div class="adminFormItem"><div class="adminFormName fll">新的密码</div><input class="flr adminNewPass" type="password" value=""/><div class="clb"></div></div>' +
                    '<div class="adminFormItem"><div class="adminFormName fll">重复输入</div><input class="flr adminConPass" type="password" value=""/><div class="clb"></div></div>' +
                    '<div class="adminFormItem"><a class="adminFormEdit">修改</a></div><a class="adminFormLogout">【退出登录】</a></div></div>';
                }else{
                    alert('获取信息失败');
                }
                loading.callback(html, '');
                var logout = function(){
                    alwaysKeepAlive = false;
                    $.ajax({
                        'url': '/admin-logout.html?ajax=1',
                        'type': 'POST',
                        'dataType': 'JSON'
                    }).success(function(){
                        window.location.href = '/admin-login.html';
                    });
                };
                mainLayoutContainer.find('.mainBox').on('click.adminFormEdit','.adminFormEdit', function(){
                    var $this = $(this),
                        adminForm = $this.closest('.adminForm'),
                        name = adminForm.find('.adminEditName').val()||'',
                        oldpass = adminForm.find('.adminEditPass').val()||'',
                        newpass = adminForm.find('.adminNewPass').val()||'',
                        conpass = adminForm.find('.adminConPass').val()||'';
                    if(name == '' || oldpass==''){
                        alert('请将信息填写完整');
                        return;
                    }
                    if(newpass!='' && newpass != conpass){
                        alert('重复输入的密码和新的密码不符合');
                        return;
                    }
                    var send = {
                        'name': name,
                        'oldpass': hex_md5(oldpass)
                    };
                    if(newpass!=''){
                        send['newpass'] = hex_md5(newpass);
                    }
                    $.ajax({
                        'url': '/admin-setUsInfo.html?ajax=1',
                        'type': 'POST',
                        'data': {
                            "send": JSON.stringify(send)
                        },
                        'dataType': 'JSON'
                    }).error(function(){
                        alert('网络错误');
                    }).success(function(data){
                        if(data.flag){
                            alert('修改成功，请重新登录');
                            logout();
                        }else{
                            alert('修改失败');
                        }
                    });
                }).on('click.adminFormLogout','.adminFormLogout', function(){
                    if(confirm('确定退出登录吗？')){
                        logout();
                    }
                });
            });
        }
    };

    var loading = {
        'currentTab' : null,
        'callback': function(html, method_html){
            if(loading.currentTab !== $('.sysTabs .selected').data('type')){
                return ;
            }

            if(html != ''){
                mainLayoutContainer.html(html);
            }
            mainLayoutTopMethod.html(method_html);
        },
        'click_type' : function($pTabBtn){
            if($pTabBtn.length < 1) {
                return;
            }
            switch ($pTabBtn.data('type')){
                case 'type':
                    action.manage_type();
                    break;
                case 'article':
                    //method_html = '<a>新增文章</a>';
                    break;
                case 'files':
                    break;
                case 'orders':
                    break;
                case 'admins':
                    action.manage_admins();
                    break;
                default :
                    break;
            }
        }
    };

    $('.sysTabs').off('click').on('click', 'a',function(){
        var $this = $(this);
        var tab_type = $this.data('type');
        if(loading.currentTab === tab_type){
            return;
        }
        loading.currentTab = tab_type;

        $this.siblings('a').removeClass('selected');
        $this.removeClass('selected').addClass('selected');

        mainLayoutTopTitle.html($this.html());
        mainLayoutContainer.html('<div class="loading"></div>');

        loading.click_type($this);
    });
    $('.sysTabs a:first').trigger('click');



    window.setInterval(function(){
        if(!alwaysKeepAlive){
            return;
        }
        $.ajax({
            'dataType': 'json',
            'type': 'POST',
            'url': '/admin-alwaysKeepAlive.html?ajax=1'
        });
    }, 600000);

});