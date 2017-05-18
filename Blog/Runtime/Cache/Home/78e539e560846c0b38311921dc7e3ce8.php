<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
        <meta charset="utf-8">
        <title>Recoder Blog</title>
        <link rel="stylesheet" href="/blog/Public/Css/index.css">
    </head>
    <body>
        <div class="header">
            <h1><a href="<?php echo U('Home/Index/index');?>">Recoder</a></h1>
            <i>简约不简单</i>
            <ul>
                <li><a href="<?php echo U('Home/Index/index');?>">首 页</a></li>
                <li><a href="<?php echo U('Home/Index/aboutme');?>">关 于 我</a></li>
                <li><a href="<?php echo U('Home/Index/search');?>">搜索</a></li>
                <li>
                    <?php if(isset($_COOKIE['username'])): ?><a href=""><?php echo (cookie('username')); ?></a>
                            <ul>
                                <li><a href="<?php echo U('Home/User/Personal');?>">编辑</a></li>
                                <li><a href="<?php echo U('Admin/Index/index');?>">管理员页面</a></li>
                                <li><a href="<?php echo U('Home/User/logout');?>">logout</a></li>
                            </ul>
                    <?php else: ?>
                        <a href="<?php echo U('Home/User/login');?>">登录</a><?php endif; ?>
                </li>
            </ul>
        </div>
        <div class="br"></div>
        <div class="main">
            <div class="left-area">

<style media="screen">
.cate-intro {
    background: url(/blog/Public/Images/bg.jpg) no-repeat center;
    background-size: 100% auto;
    width: 100%;
    text-align: center;
    height: 160px;
    line-height: 160px;
    color: #fff;
    font-size: 50px;
    letter-spacing: 8px;
}
</style>
<div>
    <div class="cate-intro">
        <?php echo ($category_name); ?>
    </div>

    <?php if(is_array($art_list)): $i = 0; $__LIST__ = $art_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><div class="article-list">
            <h2><a href="/blog/index.php/Home/Index/article/artid/<?php echo ($art["art_id"]); ?>"><?php echo ($art["title"]); ?></a></h2>
            <h4>由<a href="#"><?php echo ($art["username"]); ?></a>发表于 <?php echo ($art["pub_time"]); ?></h4>
            <p class="preview-art"><?php echo ($art["short_content"]); ?>
                <a href="/blog/index.php/Home/Index/article/artid/<?php echo ($art["art_id"]); ?>">阅读全文</a>
            </p>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    <br>
    <div class="div-page">
        <?php echo ($div_page); ?>
    </div>
</div>

</div>
<div class="right-area">
    <div class="area" id="category">
        <div class="area-title">分类</div>
        <div class="area-content">
            <ul>
                <?php if(is_array($cate_list)): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/category');?>?cateid=<?php echo ($cate["cate_id"]); ?>"><?php echo ($cate["cate_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="area" id="tag">
        <div class="area-title">标签</div>
        <div class="area-content">
            <?php if(is_array($tag_list)): $i = 0; $__LIST__ = $tag_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="area-tag"><a href="<?php echo U('Home/Tag/index');?>?tagid=<?php echo ($tag["tag_id"]); ?>"><?php echo ($tag["tag_name"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="area" id="comment">
        <div class="area-title">评论最多</div>
        <div class="area-content"></div>
    </div>
</div>
 <!-- 右边 -->
</div>
<div class="br2"></div>
<div class="footer">
    <div class="friend-link">友链:
        <?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><a href="<?php echo ($link["link_addr"]); ?>" target="_blank"><?php echo ($link["link_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <p>2017 Recoder 版权所有</p>
</div>
</body>
</html>