<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>管理分类</title>
        <link rel="stylesheet" href="/blog/Public/Css/Admin/table.css">
        <link rel="stylesheet" href="/blog/Public/Css/Admin/listCategory.css">
    </head>
    <body>
        <div class="add-category">
            <input type="text" placeholder="分类名" id="cate_name"><input type="submit" value="添加分类" onclick="ajaxAddCate()">
            <br>
            <span id="message"></span>
        </div>
        <table cellspacing="0">
            <caption><h2>文章分类</h2></caption>
            <tr>
                <td>分类</td>
                <td>文章数</td>
                <td>操作</td>
            </tr>

            <?php if(is_array($cate_list)): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($cate["cate_name"]); ?></td>
                    <td><?php echo (count($cate["article"])); ?></td>
                    <td><a href="">查看具体文章(开发ing)</a> / <a href="javascript:;" onclick="ajaxUpdateCate(<?php echo ($cate["cate_id"]); ?>)">编辑</a> / <a href="javascript:;" onclick="ajaxDelCate(<?php echo ($cate["cate_id"]); ?>)">删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr>
                <td>[未分类]</td>
                <td><?php echo ($uncate[0]["count"]); ?></td>
                <td><a href="">查看具体文章(开发ing)</a></td>
            </tr>
        </table>
        <div class="div-page">
            <?php echo ($div_page); ?>
        </div>

    </body>
</html>
<script type="text/javascript" src="/blog/Public/Js/Admin/listCategory.js"></script>