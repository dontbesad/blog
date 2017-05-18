<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    protected $cate_list;
    protected $tag_list;
    public function _initialize() {
        $cate_list = M('Category')->field('cate_id,cate_name')->select();
        $tag_list  = M('Tag')->field('tag_id,tag_name')->select();
        $links = M('friend_link')->select();
        $this->assign("cate_list", $cate_list);
        $this->assign("tag_list",  $tag_list);
        $this->assign("links", $links);
    }
    //blog主页
    public function index() {
        layout('Include/layout');

        $article = D('Article');
        $page = new \Think\Page($article->count(), 5);
        $page->lastSuffix = false;
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('first', '首页');
        $page->setConfig('last', '尾页');
        $page->rollPage = 4; //每页显示的分页按钮
        $div_page = $page->show();

        $art_list = $article->relation('user')->order("pub_time desc")->limit($page->firstRow, $page->listRows)->select();
        //提取文章的前100个字符作为简介 (strip_tags:去除html xml php代码)
        for ($i = 0; $i < count($art_list); ++$i) {
            $art_list[$i]['short_content'] = mb_substr(strip_tags(htmlspecialchars_decode($art_list[$i]['content'])), 0, 100).'......';
        }
        $this->assign('art_list', $art_list);
        $this->assign('div_page', $div_page);
        $this->display();
    }
    //分类页
    public function category() {
        layout('Include/layout');
        if (!empty(I('get.cateid'))) {

            $cateid   = intval(I('get.cateid')); //种类id
            $art_cate = M('Art_cate');
            $article  = M('Article');

            $map = array("cate_id" => $cateid);
            $page = new \Think\Page($art_cate->where($map)->count(), 6);
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('first', '首页');
            $page->setConfig('last', '尾页');
            $div_page = $page->show();

            $subQuery = $art_cate->where($map)->field('art_id')->buildSql();
            $art_list = $article->where("art_id in ".$subQuery)->limit($page->firstRow, $page->listRows)->select();

            $user_db = M('User');
            for ($i = 0; $i < count($art_list); ++$i) {
                $user = $user_db->find($art_list[$i]['user_id']);
                $art_list[$i]['username'] = $user['username'];
                $art_list[$i]['short_content'] = mb_substr(strip_tags(htmlspecialchars_decode($art_list[$i]['content'])), 0, 100).'......';
            }
            $this->assign('category_name', M('Category')->find($cateid)['cate_name']);
            $this->assign('art_list', $art_list);
            $this->assign('div_page', $div_page);
        }
        $this->display();
    }
    //文章详情页
    public function article() {
        layout('Include/layout');
        $artid = I('get.artid');
        $pre_art = M('Article')->field('art_id,title')->find($artid - 1);
        $next_art = M('Article')->field('art_id,title')->find($artid + 1);
        $art_db = D('Article');
        $art = $art_db->relation('user')->find($artid);
        $cate = $art_db->relation('category')->field('art_id')->find($artid); //文章相关的分类
        $art['category'] = $cate['category'];
        $this->assign('pre_art', $pre_art);
        $this->assign('next_art', $next_art);
        $art['content'] = htmlspecialchars_decode($art['content']);
        $this->assign('art', $art);
        $this->display();
    }
    //关于我页面
    public function aboutme() {
        $this->display();
    }
    //搜索页
    public function search() {
        layout('Include/layout');
        $this->display();
    }
    //查找文章
    public function searchArt() {
        if (!empty(I("get.search_title"))) {
            $search_title = I('get.search_title');
            $map = array('title' => array('like', "%{$search_title}%"));
            $article = M('article');
            $page = new \Think\Page($article->where($map)->count(), 8);
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('first', '首页');
            $page->setConfig('last', '尾页');
            $div_page = $page->show();
            $art_list = $article->where($map)->limit($page->firstRow, $page->listRows)->select();
            for ($i = 0; $i < count($art_list); ++$i) {
                $art_list[$i]['short_content'] = mb_substr(strip_tags(htmlspecialchars_decode($art_list[$i]['content'])), 0, 100).'......';
            }
            $this->ajaxReturn(array('art_list' => $art_list, 'div_page' => $div_page));
        } else {
            $this->ajaxReturn(array('art_list' => array(), 'div_page' => array()));
        }
    }

    public function test() {
        $category = D("Category");
        echo '<pre>';
        $res = $category->relation("article")->buildSql();
        var_dump($res);
        echo '</pre>';
    }
    public function _empty() {
        echo '无法找到此页';
    }
}
