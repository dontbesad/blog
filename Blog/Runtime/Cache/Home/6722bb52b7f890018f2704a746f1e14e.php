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

<style media="screen">
.search-art {
    text-align: center;
}
.search-art input {
    margin: 0;
    padding: 0;
    border: 0;
    border-radius: 5px;
}
.search-art input[type='text'] {
    padding: 0px 10px;
    box-sizing: border-box;
    outline: 0;
    width: 260px;
    height: 30px;
    background-color: #ddd;
}
.search-art input[type='submit'] {
    padding: 0px 30px;
    height: 30px;
    margin-left: 10px;
    background-color: #c55;
    color: #fff;
    cursor: pointer;
}
.search-art input[type='submit']:hover {
    background-color: #a34;
}
</style>
<div class="search-art">
    <input type="text" placeholder="输入文章标题关键字(包含)" id="search_title"><input type="submit" value="搜 索" onclick="searchArt('/blog/index.php/Home/Index/searchArt/search_title/' + document.getElementById('search_title').value)">
</div>
<div id="search_result">

</div>
<div class="div-page" id="div_page">

</div>
<script type="text/javascript">
function searchArt(url) {
    //var search_title = document.getElementById("search_title").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.send();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 304)) {
            //console.log(xhr.responseText);
            var response = JSON.parse(xhr.responseText);
            document.getElementById("div_page").innerHTML = response['div_page'];
            insertArt(response['art_list']);
            ajaxPage();
        }
    }
}
//无刷新分页s
function ajaxPage() {
    var div_page = document.getElementById("div_page");
    var div_page_btn = div_page.getElementsByTagName("a");
    console.log(div_page_btn.length);
    for (var i = 0; i < div_page_btn.length; ++i) {
        div_page_btn[i].onclick = function() {
            searchArt(this.href);
            return false;
        }
    }
}
function insertArt(art_list) {
    //插入操作
    var search_result = document.getElementById("search_result");
    search_result.innerHTML = "<h4 style='color:red; text-align:center;'>搜索到"+ art_list.length +"条相关记录</h4>";
    for (var i = 0; i < art_list.length; ++i) {
        var div = document.createElement('div');
        div.setAttribute('class', 'article-list');

        var title = document.createElement('h2');
        var title_link = document.createElement('a');
        title_link.setAttribute('href', "/blog/index.php/Home/Index/article/artid/" + art_list[i].art_id);
        title_link.innerHTML = art_list[i].title;
        title.appendChild(title_link);

        var pubtime = document.createElement('h4');
        pubtime.innerHTML = art_list[i].pub_time;

        var preview_art = document.createElement('p');
        preview_art.setAttribute('class', 'preview-art');
        preview_art.innerHTML = art_list[i].short_content;
        preview_art.innerHTML += "<a href='/blog/index.php/Home/Index/article/artid/" + art_list[i].art_id + "'>阅读更多</a>";
        div.appendChild(title);
        div.appendChild(pubtime);
        div.appendChild(preview_art);
        search_result.appendChild(div);
    }
}

</script>

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
<script type="text/javascript" src="/blog/Public/JS/Home/returnTop.js"></script>
</html>