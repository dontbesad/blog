<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>用户权限管理</title>
        <style media="screen">
        .form {
            width: 240px;
            margin: 0 auto;
            text-align: center;
        }
        .form input[type='text'] {
            width: 100%;
            height: 32px;
            padding: 0 10px;
            box-sizing: border-box;
            font-size: 18px;
            border; 1px solid #ccc;
            outline: 0;
        }
        .form button {
            width: 100%;
            border: 0;
            color: #eee;
            background-color: #59c;
            height: 30px;
        }
        .form button:hover {
            cursor: pointer;
            background-color: #25a;
            color: #fff;
        }
        .form #message {
            color: #f00;
        }
        </style>
    </head>
    <body>
        <div class="form">
            <h2>权限管理</h2>
            <input type="text" placeholder="用户名" id="username">
            <?php if(is_array($auth_group)): $i = 0; $__LIST__ = $auth_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$auth): $mod = ($i % 2 );++$i;?><label for="<?php echo ($auth["title"]); ?>"><?php echo ($auth["title"]); ?></label><input type="checkbox" id="<?php echo ($auth["title"]); ?>" name="<?php echo ($auth["id"]); ?>" class="box">
                <br><?php endforeach; endif; else: echo "" ;endif; ?>
            <button onclick="ajaxAuth()">确 认</button>
            <span id="message"></span>
        </div>
    </body>
</html>
<script type="text/javascript">
function ajaxAuth() {
    var boxs = document.getElementsByClassName("box");
    var checkboxs = Array();
    for (var i = 0; i < boxs.length; ++i) {
        if (boxs[i].checked) {
            checkboxs.push(boxs[i].name);
        }
    }
    var username = document.getElementById("username").value;
    var data = "username=" + username + "&auth_arr=" + JSON.stringify(checkboxs);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/blog/index.php/Admin/User/userAuthAction", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(data);
    //console.log(JSON.stringify(checkboxs));
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 304)) {
            var response = JSON.parse(xhr.responseText);
            console.log(response.message);
            document.getElementById("message").innerHTML = response.message;
        }
    }
}
</script>