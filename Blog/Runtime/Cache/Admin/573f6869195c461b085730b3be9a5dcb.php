<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="/blog/Public/Css/Admin/table.css">
        <style media="screen">
        .update-friend-link{
            float: left;
            position: relative;
        }
        .add-friend-link {
            margin-top: 10px;
            text-align: center;
        }
        .add-friend-link input[type='text'] {
            width: 200px;
            padding: 4px 10px;
            border: 2px solid rgb(34, 148, 73);
        }
        .add-friend-link input[type='submit'] {
            margin-left: 10px;
            padding: 5px 20px;
            background-color: rgb(34, 148, 73);
            color: #fff;
            cursor: pointer;
        }
        .add-friend-link input[type='submit']:hover {
            background-color: rgb(30, 120, 50);
        }

        </style>
    </head>
    <body>
        <table cellspacing="0">
            <caption><h2>友链管理</h2></caption>
            <tr>
                <td>名称</td><td>网址</td><td>操作</td>
            </tr>
            <?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($link["link_name"]); ?></td><td><?php echo ($link["link_addr"]); ?></td>
                    <td><a href="javascript:;" onclick="delLink(<?php echo ($link["link_id"]); ?>)">删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="div-page">
            <?php echo ($div_page); ?>
        </div>
        <div class="add-friend-link">
            <label for="link_name">名称:</label><input type="text" id="link_name" placeholder="友链名称">
            <label for="link_addr">网址:</label><input type="text" id="link_addr" placeholder="友链链接(比如http://www.xxx.com)">
            <input type="submit" id="add_link" onclick="addLink()" value="添 加 友 链">
        </div>
    </body>
</html>
<script type="text/javascript">
function ajaxPost(url, data) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");
    xhr.send(data);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 304)) {
            var response = JSON.parse(xhr.responseText);
            msg(response);
        }
    }
}
function msg(obj) {
    if (obj.flag) {
        alert(obj.message);
        window.location.reload();
    } else {
        alert(obj.message);
    }
}
function addLink() {
    var link_name = document.getElementById("link_name").value;
    var link_addr = document.getElementById("link_addr").value;
    ajaxPost("/blog/index.php/Admin/Friendlink/addLink", "link_name=" + link_name + "&link_addr=" + encodeURIComponent(link_addr));
}
function delLink(link_id) {
    ajaxPost("/blog/index.php/Admin/Friendlink/delLink", "link_id=" + link_id);
}
</script>