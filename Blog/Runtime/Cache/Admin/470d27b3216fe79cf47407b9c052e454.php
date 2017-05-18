<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>列表</title>
        <link rel="stylesheet" href="/blog/Public/Css/Admin/table.css">
        <link rel="stylesheet" href="/blog/Public/Css/Admin/listArt.css">
    </head>
    <body>
        
        <table cellspacing="0">
            <caption><h2>文章管理</h2></caption>
            <tr>
                <td>编号</td>
                <td>标题</td>
                <td>发布时间</td>
                <td>操作</td>
            </tr>
            <?php if(is_array($art_list)): $i = 0; $__LIST__ = $art_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($art["art_id"]); ?></td>
                    <td><a href="/blog/index.php/Home/Index/article/artid/<?php echo ($art["art_id"]); ?>" target="_blank"><?php echo ($art["title"]); ?></a></td>
                    <td><?php echo ($art["pub_time"]); ?></td>
                    <td><a href="/blog/index.php/Admin/Article/article/opt/update/artid/<?php echo ($art["art_id"]); ?>">编辑</a>|<a href="javascript:;" onclick="ajaxDelArt(<?php echo ($art["art_id"]); ?>)">删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <!-- 分页 -->
        <div class="div-page">
            <?php echo ($div_page); ?>
        <div>
    </body>
</html>
<script type="text/javascript">
//删除文章
function ajaxDelArt(artid) {
    if (!confirm("确定要删除吗")) {
        return ;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/blog/index.php/Admin/Article/delArt", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var data = "artid=" + artid;
    xhr.send(data);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 304)) {
            var response = JSON.parse(xhr.responseText);
            alert(response.message);
            if (response.flag) { //刷新当前页面
                window.location.reload();
            }
        }
    }
}
</script>