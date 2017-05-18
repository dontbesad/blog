<?php
namespace Common\Controller;
use Think\Controller;
use Think\Auth;

class AuthController extends Controller {
    public function _initialize() {
        $user_id = checkLogin();
        $currentPos = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        $auth = new Auth();
        if ($user_id === false) {
            $this->error("未登录或者登录过期");
        } else if (!$auth->check($currentPos, $user_id)) {
            $this->error("没有权限");
        }
    }
}
/*
#auth_rule
#文章相关
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/article",   "文章添加修改页");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/addArt",    "文章添加");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/updateArt", "文章修改");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/delArt",    "文章删除");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/listArt",   "文章列表页");

INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/listCategory",   "分类列表页");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/addCate",        "添加分类");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/updateCate",     "更改分类");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/delCate",        "删除分类");

INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Article/addTag",         "添加标签");

#友链相关
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Friendlink/listLink",  "友链列表页");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Friendlink/addLink",      "添加友链");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Friendlink/delLink",      "删除友链");

#用户相关...
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/User/userList", "用户列表页");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/User/userAdd", "用户添加页");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/User/userAddAction", "添加用户");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/User/userEdit", "用户修改页");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/User/userEditAction", "修改用户");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/User/userDelAction", "删除用户");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/User/userAuth", "用户权限设置页");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/User/userAuthAction", "用户权限设置");

#主页访问
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Index/index", "后台主页");
INSERT INTO auth_rule(`name`, `title`) VALUES("Admin/Index/serverInfo", "服务器信息页");

#auth_group
INSERT INTO auth_group(`title`, `rules`) VALUES("文章管理", "1,2,3,4,5,6,7,8,9,10");
INSERT INTO auth_group(`title`, `rules`) VALUES("友链管理", "11,12,13");
INSERT INTO auth_group(`title`, `rules`) VALUES("用户管理", "14,15,16,17,18,19,20,21");
INSERT INTO auth_group(`title`, `rules`) VALUES("主页访问", "22,");



*/
