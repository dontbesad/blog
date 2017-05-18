<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>修改</title>
        <link rel="stylesheet" href="/blog/Public/Css/Admin/article.css">
    </head>
    <body>
        <div class="add-art">
                <label for="title"><i>标 题</i></label>
                <input type="text" class="art-title" id="title" value="<?php echo ($art["title"]); ?>">
                <label for="editor"><i>内 容</i></label>
                <textarea id="editor"><?php echo ($art["content"]); ?></textarea>
                <hr>
                <dl>
                    <dt><i>分 类</i></dt>
                    <dd>
                        <?php if(is_array($cate_list)): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><label for="cate<?php echo ($cate["cate_id"]); ?>"><?php echo ($cate["cate_name"]); ?></label><input type="checkbox" name="<?php echo ($cate["cate_id"]); ?>" id="cate<?php echo ($cate["cate_id"]); ?>" class="checkbox-cate" <?php if(isset($cate["checked"])): ?>checked<?php endif; ?> ><?php endforeach; endif; else: echo "" ;endif; ?>
                    </dd>
                </dl>
                <dl>
                    <dt><i>标 签</i></dt>
                    <dd id="tag_list">
                        <?php if(is_array($tag_list)): $i = 0; $__LIST__ = $tag_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><label for="tag<?php echo ($tag["tag_id"]); ?>"><?php echo ($tag["tag_name"]); ?></label><input type="checkbox" name="<?php echo ($tag["tag_id"]); ?>" id="tag<?php echo ($tag["tag_id"]); ?>" class="checkbox-tag" <?php if(isset($tag["checked"])): ?>checked<?php endif; ?> ><?php endforeach; endif; else: echo "" ;endif; ?>
                    </dd>

                </dl>
                <div class="add-tag">
                    <input type="text" placeholder="添加标签" id="tag_name"><input type="submit" value="添加标签" id="add_tag"><span id="message_tag"></span>
                </div>
                <hr>
                <input type="submit" class="add-art-btn" value="文章添加" onclick="editArt('<?php echo ($_GET['opt']); ?>','<?php echo ($_GET['artid']); ?>')"><span id="message_art"></span>
        </div>
    </body>
</html>
<script type="text/javascript" src="/blog/Public/Js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/blog/Public/Js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="/blog/Public/Js/Admin/article.js"></script>