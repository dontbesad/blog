<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Controller;

class ArticleController extends AuthController {
    //添加和修改文章页面
    public function article() {
        $cate_list = M('Category')->select();
        $tag_list  = M('Tag')->select();
        //显示分类和标签

        if (I('get.artid') && I('get.opt') == 'update') {  //修改文章
            $article = D('Article');
            $art = $article->find(I('get.artid'));
            //插入之前的cate和tag
            $cate_arr = $article->relation('category')->find(I('get.artid'));
            $tag_arr = $article->relation('tag')->find(I('get.artid'));
            $in_cate = array();
            $in_tag  = array();
            foreach ($cate_arr['category'] as $cate) {
                $in_cate[] = $cate['cate_id'];
            }
            foreach ($tag_arr['tag'] as $tag) {
                $in_tag[] = $tag['tag_id'];
            }
            for ($i = 0; $i < count($cate_list); ++$i) {
                if (in_array($cate_list[$i]['cate_id'], $in_cate)) {
                    $cate_list[$i]['checked'] = 1;
                }
            }
            for ($i = 0; $i < count($tag_list); ++$i) {
                if (in_array($tag_list[$i]['tag_id'], $in_tag)) {
                    $tag_list[$i]['checked'] = 1;
                }
            }
            $this->assign("art", $art);
            $this->assign("cate_list", $cate_list);
            $this->assign("tag_list", $tag_list);
            $this->display();
        } else {  //新增文章
            $this->assign("cate_list", $cate_list);
            $this->assign("tag_list", $tag_list);
            $this->display();
        }
    }
    //添加文章
    public function addArt() {
        if (IS_POST) {
            $article = D("Article"); //这里先要进行过滤操作
            //这里还要处理tag 和 cate -------------------------------------
            $data['title'] = I('post.title');
            $data['content'] = I('post.content');
            $data['user_id'] = checkLogin();
            //data方法不会进行自动验证和过滤操作
            if (!$article->create($data)) {
                $this->ajaxReturn(array("flag" => false, "message" => $article->getError()));
            } else {
                $art_id = $article->add(); //获取主表插入返回的id
                if ($art_id === false) {
                    $this->ajaxReturn(array("flag" => false, "message" => "添加失败"));
                    return ;
                }

                $cates = json_decode($_POST['cates']);
                $tags = json_decode($_POST['tags']);
                $art_cate = M("Art_cate");
                $art_tag  = M("Art_tag");
                $category = M("Category");
                $tag      = M("Tag");
                for ($i = 0; $i < count($cates); ++$i) {
                    //检测post过来的cate_id是否存在
                    if ( !empty( $category->find($cates[$i]) ) ) {
                        $art_cate->art_id = $art_id;
                        $art_cate->cate_id = $cates[$i];
                        $art_cate->add();
                    }
                }
                for ($i = 0; $i < count($tags); ++$i) {
                    if ( !empty( $tag->find($tags[$i]) ) ) {
                        $art_tag->art_id = $art_id;
                        $art_tag->tag_id = $tags[$i];
                        $art_tag->add();
                    }
                }
                $this->ajaxReturn(array("flag" => true, "message" => "添加成功"));
            }
        }
    }
    //更改文章
    public function updateArt() {
        if (IS_POST) {
            $article = D("Article"); //这里先要进行过滤操作
            $data['art_id'] = I('post.art_id');
            $data['title'] = I('post.title');
            $data['content'] = I('post.content');
            //data方法不会进行自动验证和过滤操作
            if (!$article->create($data)) {
                $this->ajaxReturn(array("flag" => false, "message" => $article->getError()));
            } else {
                if ($article->save() === false) {
                    $this->ajaxReturn(array("flag" => false, "message" => "更改失败"));
                    exit;
                }
                $cates = json_decode($_POST['cates']);
                $tags = json_decode($_POST['tags']);
                $art_cate = M("Art_cate");
                $art_tag  = M("Art_tag");
                $category = M("Category");
                $tag      = M("Tag");
                $map = array("art_id" => $data['art_id']);
                $art_cate->where($map)->delete();
                $art_tag->where($map)->delete();
                for ($i = 0; $i < count($cates); ++$i) {
                    //检测post过来的cate_id是否存在
                    if ( !empty( $category->find($cates[$i]) ) ) {
                        $art_cate->art_id = $data['art_id'];
                        $art_cate->cate_id = $cates[$i];
                        $art_cate->add();
                    }
                }
                for ($i = 0; $i < count($tags); ++$i) {
                    if ( !empty( $tag->find($tags[$i]) ) ) {
                        $art_tag->art_id = $data['art_id'];
                        $art_tag->tag_id = $tags[$i];
                        $art_tag->add();
                    }
                }
                $this->ajaxReturn(array("flag" => true, "message" => "更改成功"));
            }
        }
    }
    //在编辑文章页面中增加tag操作
    public function addTag() {
        if (IS_POST) {
            $data = array(
                "tag_name" => I("post.tag_name"),
            );
            $tag = M("Tag");
            //动态验证
            $validate = array(
                array("tag_name", "require", "标签名不能为空"),
                array("tag_name", "1,20", "标签名长度不能超过20个字符", 2, "length"),
                array("tag_name", "", "标签名不能重复", 2, "unique"),
            );
            if ($tag->validate($validate)->create($data)) {
                $tag_id = $tag->add();
                if ($tag_id === false) {
                    $this->ajaxReturn(array("flag" => false, "message" => "标签添加失败"));
                } else {
                    $this->ajaxReturn(array("flag" => true, "message" => "标签添加成功", "tag" => array("tag_id" => $tag_id, "tag_name" => $data['tag_name'])));
                }
            } else {
                $this->ajaxReturn(array("flag" => false, "message" => $tag->getError()));
            }
        }
    }
    //文章管理列表
    public function listArt() {
        $article = M("article");
        $count = $article->count();
        $page = new \Think\Page($count, 8);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('first', '首页');
        $page->setConfig('last', '尾页');
        $div_page = $page->show();

        $art_list = $article->field("art_id,title,pub_time")->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign("art_list", $art_list);
        $this->assign("div_page", $div_page);
        $this->display();
    }
    //删除文章 post方式传参数
    public function delArt() {
        if (IS_POST) {
            $artid = I('post.artid');
            $map = array('art_id' => $artid);
            M('Art_cate')->where($map)->delete();
            M('Art_tag')->where($map)->delete();
            M('Comment')->where($map)->delete();
            if ( M('Article')->where($map)->delete() !== false) {
                $this->ajaxReturn(array('flag' => true, 'message' => '删除成功'));
            } else {
                $this->ajaxReturn(array('flag' => false, 'message' => '删除失败'));
            }
        }
    }
    //分类管理列表
    public function listCategory() {
        $category = D('Category');
        $page = new \Think\Page($category->count(), 8);
        $div_page = $page->show();

        $cate_list = $category->relation('article')->limit($page->firstRow, $page->listRows)->select();
        //未分类文章数目
        $in_cate_sql = M('art_cate')->field('art_id')->group('art_id')->buildSql();
        $uncate = M('article')->field('count(*) AS count')->where('art_id not in'.$in_cate_sql)->select();
        $this->assign("cate_list", $cate_list);
        $this->assign("uncate", $uncate);
        $this->assign("div_page", $div_page);
        $this->display();
    }
    //添加分类
    public function addCate() {
        if (IS_POST) {
            $data = array(
                "cate_name" => I("post.cate_name"),
            );
            $category = D("Category");
            if ($category->create($data)) {
                if ($category->add() === false) {
                    $this->ajaxReturn(array("flag" => false, "message" => "分类添加失败"));
                } else {
                    $this->ajaxReturn(array("flag" => true, "message" => "分类添加成功"));
                }
            } else {
                $this->ajaxReturn(array("flag" => false, "message" => $category->getError()));
            }
        }
    }
    //更改分类名
    public function updateCate() {
        if (IS_POST) {
            $data = array(
                "cate_id" => I("post.cate_id"),
                "cate_name" => I("post.cate_name"),
            );
            $category = D("Category");
            if ($category->create($data)) {
                if ($category->save() !== false) {
                    $this->ajaxReturn(array("flag" => true, "message" => "修改成功"));
                } else {
                    $this->ajaxReturn(array("flag" => false, "message" => "修改失败"));
                }
            } else {
                $this->ajaxReturn(array("flag" => false, "message" => $category->getError()));
            }
        }
    }
    //删除分类,并将一些只有此分类的文章归属到未分类中
    public function delCate() {
        if (IS_POST) {
            $cateid = I('post.cate_id');
            $map = array('cate_id' => $cateid);
            if ( M('Category')->where($map)->delete() !== false && M('Art_cate')->where($map)->delete() !== false) {
                $this->ajaxReturn(array('flag' => true, 'message' => '删除成功'));
            } else {
                $this->ajaxReturn(array('flag' => false, 'message' => '删除失败'));
            }
        }
    }
}
