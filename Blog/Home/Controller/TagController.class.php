<?php
namespace Home\Controller;
use Think\Controller;

class TagController extends Controller {
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

    public function index() {
        layout("Include/layout");
        if (!empty(I("get.tagid"))) {
            $tag_id = intval(I("get.tagid"));
            $map = array(
                "tag_id" => $tag_id,
            );
            $art_tag = M("Art_tag");
            $article = M("article");

            $page = new \Think\Page($art_tag->where($map)->count(), 8);
            $page->lastSuffix = false;
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('first', '首页');
            $page->setConfig('last', '尾页');
            $page->rollPage = 4; //每页显示的分页按钮
            $div_page = $page->show();

            $subQuery = $art_tag->where($map)->field("art_id")->buildSql();
            $art_list = $article->where("art_id in ".$subQuery)->limit($page->firstRow, $page->listRows)->select();

            $user_db = M("User");
            for ($i = 0; $i < count($art_list); ++$i) {
                $user = $user_db->find($art_list[$i]['user_id']);
                $art_list[$i]["username"] = $user['username'];
                $art_list[$i]["short_content"] = mb_substr(strip_tags(htmlspecialchars_decode($art_list[$i]["content"])), 0, 100).'......';
            }
            $this->assign("art_list", $art_list);
            $this->assign("tag_name", M("tag")->find($tag_id)["tag_name"]);
            $this->assign("div_page", $div_page);
        }
        $this->display();
    }
}
