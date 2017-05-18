<?php
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Controller;
//用户管理
class UserController extends AuthController {
    //用户列表
    public function userList() {
        $user_list = D("User")->relation("auth_group")->select();
        $this->assign("user_list", $user_list);
        $this->display();
    }
    //添加用户
    public function userAdd() {
        $userlist_url = U('userList');
        echo "<a href='{$userlist_url}'><<返回</a>";
        $this->display();
    }
    public function userAddAction() {
        if (IS_POST) {
            $data = array(
                "username" => I("post.username"),
                "password" => I("post.password"),
                "email"    => I("post.email"),
            );
            $validate = array(
                array("username", "require", "用户名不能为空"),
                array("username", "", "用户名已存在",0, "unique", 3),
                array("username", "1,20", "用户名不能超过20位", 0, "length", 3),
                array("password", "require", "密码不能为空"),
                array("password", "6,20", "密码不得小于6位,大于20位", 0, length, 3),
                array("email", "require", "邮箱不得为空"),
                array("email", "email", "邮箱格式错误"),
            );
            $User = M("User");
            if ($User->validate($validate)->create($data)) {
                $User->password = md5($User->password);
                if ($User->add() === false) {
                    $this->ajaxReturn(array("flag" => false, "message" => "添加失败"));
                } else {
                    $this->ajaxReturn(array("flag" => true, "message" => "添加成功"));
                }
            } else {
                $this->ajaxReturn(array("flag" => false, "message" => $User->getError()));
            }
        }
    }
    //编辑用户
    public function userEdit() {
        $userlist_url = U('userList');
        echo "<a href='{$userlist_url}'><<返回</a>";
        $user = array();
        if (I("get.user_id") != NULL) {
            $user = M("User")->find(intval(I("get.user_id")));
        }
        $this->assign("user", $user);
        $this->display();
    }
    public function userEditAction() {
        if (IS_POST) {
            $data = array(
                "user_id"  => I("post.user_id"),
                "username" => I("post.username"),
                "password" => I("post.password"),
                "email"    => I("post.email"),
            );
            $User = M("User");
            $rule = array(
                array("username", "require", "用户名不能为空"),
                array("username", "", "用户名已存在", 0, "unique", 2),
                array("username", "1,20", "用户名不能超过20位", 0, "length", 3),
                array("password", "require", "密码不能为空"),
                array("password", "6,20", "密码不能小于6位,超过20位", 0, "length", 3),
                array("email", "require", "邮箱不能为空"),
                array("email", "email", "邮箱格式错误"),
            );
            if ($User->validate($rule)->create($data)) {
                $data["password"] = md5($data["password"]);
                $User->create($data);
                if ($User->save() === false) {
                    $this->ajaxReturn(array("flag" => false, "message" => "更改失败"));
                } else {
                    $this->ajaxReturn(array("flag" => true,  "message" => "更改成功"));
                }
            } else {
                $this->ajaxReturn(array("flag" => false, "message" => $User->getError()));
            }

        }
    }
    //删除用户
    public function userDelAction() {
        if (IS_POST) {
            $user_id = intval(I("post.user_id"));
            if (M("User")->delete($user_id) === false) {
                $this->ajaxReturn(array("flag" => false, "message" => "删除失败"));
            } else {
                $this->ajaxReturn(array("flag" => true, "message" => "删除成功"));
            }
        }
    }
    //用户权限页面
    public function userAuth() {
        $this->assign("auth_group", M("Auth_group")->select());
        $this->display();
    }
    //授予权限
    public function userAuthAction() {
        if (IS_POST) {
            $username = I("post.username");
            $auth_arr = json_decode(htmlspecialchars_decode(I("post.auth_arr")));
            $user = M("User")->where(array("username" => $username))->field("user_id")->select();
            if (empty($user)) {
                $this->ajaxReturn(array("message" => "未找到此用户"));
            } else {
                $user_id = $user[0]["user_id"];
                //$this->ajaxReturn(array("message" => $user[0]["user_id"]));
                $auth_group_access = M("Auth_group_access");
                $auth_group_access->where(array("uid" => $user_id))->delete();
                for($i = 0; $i < count($auth_arr); ++$i) {
                    if (M("Auth_group")->find($auth_arr[$i])) {
                        $auth_group_access->uid = $user_id;
                        $auth_group_access->group_id = $auth_arr[$i];
                        $auth_group_access->add();
                    }
                }
                $this->ajaxReturn(array("message" => "修改权限成功"));
            }
        }
    }

}
