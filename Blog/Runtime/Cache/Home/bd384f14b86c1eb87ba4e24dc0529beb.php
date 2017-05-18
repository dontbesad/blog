<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>注册</title>
        <link rel="stylesheet" href="/blog/Public/Css/login_register.css">
    </head>
    <body>
        <div class="form">
            <h1>注　册</h1>
            <input type="text" class="input username" placeholder="用户名" id="username">
            <input type="password" class="input password" placeholder="密码" id="password">
            <input type="password" class="input password" placeholder="重复密码" id="repassword">
            <input type="email" class="input email" placeholder="邮箱" id="email">
            <div class="verify">
                <img src="/blog/index.php/Home/Account/showVerify" alt="验证码" onclick="this.src='/blog/index.php/Home/Account/showVerify?'+Math.floor(Math.random()*1000);">
                <input type="text" placeholder="验证码(刷新请点击图片)" id="verify_code">
            </div>
            <span id="message"></span><input type="submit" value="注　册" id="submit_btn">
            <div class="br"><hr></div>
            <a href="/blog/index.php/Home/Account/login">已有帐号?去登录</a><a href="/blog/index.php/Home" style="float:right">[返回首页]</a>
        </div>
    </body>
</html>
<script type="text/javascript">
document.getElementById("submit_btn").onclick = function() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var repassword = document.getElementById("repassword").value;
    var email = document.getElementById("email").value;
    var verify_code = document.getElementById("verify_code").value;
    var data = "username=" + username + "&password=" + password + "&repassword=" + repassword + "&email=" + email + "&verifycode=" + verify_code;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/blog/index.php/Home/Account/registerAction", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(data);
    console.log(data);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 304)) {
            var response = JSON.parse(xhr.responseText);
            if (response.flag) {
                document.write(response.message + ",3秒之后跳转到登录页面。" + "<a href='/blog/index.php/Home/Account/login'>[立即跳转]</a>");
                setTimeout(function(){
                    location.href = "/blog/index.php/Home/Account/login";
                },3000);
            } else {
                document.getElementById("message").innerHTML = response.message;
            }
        }
    }
}
</script>