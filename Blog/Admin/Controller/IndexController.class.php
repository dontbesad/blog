<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Controller;

class IndexController extends AuthController {
    //Admin主页
    public function index() {
        $this->assign("title", "admin");
        $this->display();
    }
    //服务器信息
    public function serverInfo() {
        $this->display();
    }
}
