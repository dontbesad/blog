<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>管理页面</title>
        <link rel="stylesheet" href="/blog/Public/Css/Admin/admin.css">
    </head>
    <body>
        <div class="header">
            <h1><i><a href="/blog/index.php/Admin/Index">后台页面</a></i></h1>
            <ul>
                <li><a href="/blog/index.php/Home/Index">回到首页</a></li>
            </ul>
        </div>
        <div class="main">
            <ul class="left">
                <li>
                    <div class="admin-info" style="">
                        <img src="/blog/Public/Images/bg.jpg" alt="">
                        <h3>欢迎您 <i><?php echo (cookie('username')); ?></i></h3>
                        <a href="<?php echo U('Home/User/logout');?>">logout</a>
                    </div>
                </li>
                <li>
                    <a href="javascript:;" class="list-title">文章管理<span></span></a>
                    <ul class="bar-list">
                        <li><a href="/blog/index.php/Admin/Article/article" target="show">新增文章</a></li>
                        <li><a href="/blog/index.php/Admin/Article/listArt" target="show">管理文章</a></li>
                        <li><a href="/blog/index.php/Admin/Article/listCategory" target="show">文章分类</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="list-title">评论管理<span></span></a>
                    <ul class="bar-list">
                        <li><a href="javascript:;">管理评论(开发ing)</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="list-title">用户管理<span></span></a>
                    <ul class="bar-list">
                        <li><a href="/blog/index.php/Admin/User/userList" target="show">用户列表</a></li>
                        <li><a href="/blog/index.php/Admin/User/userAuth" target="show">权限授予</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="list-title">友链管理<span></span></a>
                    <ul class="bar-list">
                        <li><a href="/blog/index.php/Admin/Friendlink/listLink" target="show">友链列表</a></li>
                    </ul>
                </li>
            </ul>
            <div class="right">
                <iframe src="/blog/index.php/Admin/Index/serverInfo" id="myiframe" width="100%" name="show" frameborder="0">

                </iframe>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="/blog/Public/Js/Admin/admin.js"></script>
</html>