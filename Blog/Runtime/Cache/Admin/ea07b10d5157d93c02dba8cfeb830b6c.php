<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>添加</title>
        <style media="screen">
        .form {
            margin: 0 auto;
            width: 300px;
        }
        .form label {
            font-size: 20px;
        }
        .form input {
            width: 100%;
            height: 30px;
            padding: 0 10px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form button {
            padding: 8px 0;
            width: 100%;
            letter-spacing: 3px;
            cursor: pointer;
            background-color: #69c;
            border: 0;
            color: #fff;
            border-radius: 5px;
            margin-top: 10px;
        }
        .form button:hover {
            background-color: #359;
        }

        #message {
            color: #f00;
        }
        </style>
    </head>
    <body>
        <div class="form">
            <h2>添加用户</h2>
            <label for="username">用户名</label><input type="text" id="username">
            <label for="password">密码</label><input type="password" id="password">
            <label for="email">邮箱</label><input type="email" id="email">
            <button onclick="ajaxAdd()">添加</button>
            <span id="message"></span>
        </div>
    </body>
    <script type="text/javascript">
    function ajaxAdd() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var email    = document.getElementById("email").value;

        var data = "username=" + username + "&password=" + password + "&email=" + email;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/blog/index.php/Admin/User/userAddAction", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304)) {
                var response = JSON.parse(xhr.responseText);
                //console.log(response);
                if (response.flag) {
                    alert(response.message);
                    location.href = "/blog/index.php/Admin/User/userList";
                } else {
                    document.getElementById("message").innerHTML = response.message;
                }
            }
        }
    }
    </script>
</html>