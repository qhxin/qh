<div class="main">
    <div class="loginForm">
        <div class="loginBox">
            <div class="formTitle">登录青花CMS后台</div>
            <div class="formItem">
                <div class="itemTitle fll">账号</div>
                <input class="item flr" id="loginName" type="text" value=""/>
                <div class="clb"></div>
            </div>
            <div class="formItem">
                <div class="itemTitle fll">密码</div>
                <input class="item flr" id="loginPass" type="password" value=""/>
                <div class="clb"></div>
            </div>
            <div class="formItem">
                <div class="itemTitle fll">验证码</div>
                <input class="item vcode flr" id="vCode" type="text" value=""/>
                <img class="vcodeImg flr" id="vcodeImg" title="点击刷新验证码" src="/admin-vcode.html?v=<?php echo time(); ?>"/>
                <div class="clb"></div>
            </div>
            <div class="formItem">
                <a class="loginBtn" id="loginBtn"/>登录</a>
            </div>
            <a href="/" class="gotoIndex">首页</a>
        </div>
    </div>
</div>