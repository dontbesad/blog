<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
        <meta charset="utf-8">
        <title>Recoder Blog</title>
        <link rel="stylesheet" href="/blog/Public/Css/index.css">
        <link rel="stylesheet" href="/blog/Public/Css/returnTop.css">
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

<link rel="stylesheet" href="/blog/Public/Css/article.css">
<?php if(isset($art)): ?><div class="art">
        <h1 class="art-title"><?php echo ($art["title"]); ?></h1>
        <div class="art-content">
            <?php echo ($art["content"]); ?>
        </div>
        <div class="art-info">
            <div class="fl">
                <ul>
                    <li>所属分类:</li>
                    <?php if(is_array($art['category'])): $i = 0; $__LIST__ = $art['category'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><li><a href="/blog/index.php/Home/Index/category/cateid/<?php echo ($cate["cate_id"]); ?>"><?php echo ($cate["cate_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="fr">
                posted <time><?php echo ($art["pub_time"]); ?></time>
                <i><a href="#"><?php echo ($art['user']["username"]); ?></a></i>
            </div>
        </div>
        <!-- JiaThis Button BEGIN -->
        <div class="jiathis_style">
        	<span class="jiathis_txt">分享到：</span>
        	<a class="jiathis_button_tools_1"></a>
        	<a class="jiathis_button_tools_2"></a>
        	<a class="jiathis_button_tools_3"></a>
        	<a class="jiathis_button_tools_4"></a>
        	<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
        	<a class="jiathis_counter_style"></a>
        </div>
        <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
        <!-- JiaThis Button END -->
        <br>
        <div class="skip-adj-art">
            <?php if(isset($pre_art)): ?><a href="/blog/index.php/Home/Index/article/artid/<?php echo ($pre_art["art_id"]); ?>" class="fl">上一篇[<?php echo ($pre_art["title"]); ?>]</a><?php endif; ?>
            <?php if(isset($next_art)): ?><a href="/blog/index.php/Home/Index/article/artid/<?php echo ($next_art["art_id"]); ?>" class="fr">[<?php echo ($next_art["title"]); ?>]下一篇</a><?php endif; ?>
        </div>
        <div class="art-comment">
            <!-- 这是无言的js插件代码 -->
            <script type="text/javascript" id="wumiiComments">
                var wumiiPermaLink = ""; //请用代码生成文章永久的链接
                var wumiiTitle = ""; //请用代码生成文章标题
                //下面修改成你的网址
                var wumiiSitePrefix = "http://120.25.162.49/"; //安装无觅评论插件的网站的域>名，如果是放在子域名上，请提供子域名，如"http://blog.wumii.com"。如果这里填写的>域名不对，请自行改正。
                var wumiiCommentParams = "&pf=JAVASCRIPT";
            </script>
            <script type="text/javascript" src="http://widget.wumii.cn/ext/cw/widget"></script>
        </div>
    </div>

<?php else: ?>
文章不存在<?php endif; ?>

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
    <!--div class="area" id="comment">
        <div class="area-title">评论最多</div>
        <div class="area-content"></div>
    </div-->
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
<a href="javascript:;" id="return_top_btn"></a>
</body>
<script type="text/javascript" src="/blog/Public/Js/Home/returnTop.js"></script>
</html>