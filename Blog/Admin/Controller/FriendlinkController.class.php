<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Controller;

class FriendlinkController extends AuthController {
    public function index() {

    }
    public function listLink() {
        $friend_link = M('Friend_link');
        $page = new \Think\Page($friend_link->count(), 8);
        $div_page = $page->show();

        $links = $friend_link->limit($page->firstRow, $page->listRows)->select();
        $this->assign('links', $links);
        $this->assign('div_page', $div_page);
        $this->display();
    }
    //添加友链
    public function addLink() {
        if (IS_POST) {
            $link = array(
                'link_name' => I("post.link_name"),
                'link_addr' => I("post.link_addr"),
            );
            $validate = array(
                array("link_name", "require", "名称不能为空!"),
                array("link_addr", "require", "地址不能为空!"),
                array("link_addr", "url", "地址必须是一个合法网址!(比如:http://www.xxx.com)"), //检测地址是否是一个合法的网址
            );
            $friend_link = M("Friend_link");
            if ($friend_link->validate($validate)->create($link)) {
                if ($friend_link->add() == false) {
                    $this->ajaxReturn(array("flag" => false, "message" => "添加失败"));
                } else {
                    $this->ajaxReturn(array("flag" => true, "message" => "添加成功"));
                }
            } else {
                $this->ajaxReturn(array("flag" => false, "message" => $friend_link->getError()));
            }
        }
    }
    //编辑友链 //此功能暂时不写
    public function updateLink() {
    }
    //删除友链
    public function delLink() {
        if (IS_POST) {
            $link = intval(I("post.link_id"));
            $friend_link = M("Friend_link");
            if ($friend_link->delete($link) === false) {
                $this->ajaxReturn(array("flag" => false, "message" => "删除失败"));
            } else {
                $this->ajaxReturn(array("flag" => true, "message" => "删除成功"));
            }
        }
    }

}
