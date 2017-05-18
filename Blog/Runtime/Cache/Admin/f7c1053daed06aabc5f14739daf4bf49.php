<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>用户列表</title>
        <link rel="stylesheet" href="/blog/Public/Css/Admin/table.css">
        <style media="screen">
        .add-user {
            border: 0;
            background-color: #69d;
            padding: 8px 25px;
            color: #fff;
            border-radius: 5px;
            letter-spacing: 5px;
            cursor: pointer;
            display: inline-block;
        }
        .add-user:hover {
            background-color: #359;
        }
        </style>
    </head>
    <body>
        <a href="/blog/index.php/Admin/User/userAdd" class="add-user">添加用户</a>
        <table cellspacing="0">
            <caption><h2>用户列表</h2></caption>
            <tr>
                <td>用户名</td>
                <td>邮箱</td>
                <td>注册时间</td>
                <td>权限</td>
                <td>操作</td>
            </tr>
            <?php if(is_array($user_list)): $i = 0; $__LIST__ = $user_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($user["username"]); ?></td>
                    <td><?php echo ($user["email"]); ?></td>
                    <td><?php echo ($user["reg_time"]); ?></td>
                    <td>
                        <?php if(empty($user['auth_group'])): ?>普通用户
                        <?php else: ?>
                            <?php if(is_array($user['auth_group'])): $i = 0; $__LIST__ = $user['auth_group'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$auth): $mod = ($i % 2 );++$i; echo ($auth["title"]); ?> /<?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </td>
                    <td><a href="/blog/index.php/Admin/User/userEdit/user_id/<?php echo ($user["user_id"]); ?>">修改</a> / <a href="javascript:;" onclick="ajaxDel(<?php echo ($user["user_id"]); ?>)">删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </body>
</html>
<script type="text/javascript">
function ajaxDel(user_id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/blog/index.php/Admin/User/userDelAction", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("user_id=" + user_id);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 304)) {
            var response = JSON.parse(xhr.responseText);
            alert(response.message);
            if (response.flag) {
                location.reload();
            }
        }
    }
}
</script>