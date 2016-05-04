$(document).ready(function(){

    $('#vcodeImg').click(function(){
        var $this = $(this);
        $this.attr('src', ($this.attr('src')+'1'));
    });

    (function(){
        var checking = false,
            loginBtn = $('#loginBtn');
        loginBtn.click(function(){
            if(checking){
                return;
            }
            checking = true;
            var name = $('#loginName').val(),
                pass = $('#loginPass').val(),
                vcode = $('#vCode').val();

            if(name == '' || pass == '' || vcode==''){
                alert('请将验证信息填写完整');
                checking = false;
                return;
            }
            $.ajax({
                'url': '/admin-login.html?ajax=1',
                'type': 'POST',
                'data': {
                    "send": JSON.stringify({
                        'name': name,
                        'pass': hex_md5(pass),
                        'vcode': vcode
                    })
                },
                'dataType': 'JSON'
            }).error(function(){
                alert('网络错误');
                checking = false;
            }).success(function(data){
                if(data.flag === 1){
                    loginBtn.html('登录成功');
                    setTimeout(function(){
                        window.location.href = '/admin.html';
                    }, 500);
                }else
                if(data.flag === 0){
                    if(data.code === 1){
                        $('#vcodeImg').trigger('click');
                        alert('验证码错误');
                    }else{
                        alert('登录失败');
                    }
                    checking = false;
                }else{
                    alert('未知错误');
                    checking = false;
                }
            });
        });
    })();
});