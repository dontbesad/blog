<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller {
    //登录页面
    public function login() {
        $this->display();
    }
    //注册页面
    public function register() {
        $this->display();
    }
    //个人信息页
    public function personal() {
        echo "个人页面";
    }
    //显示注册验证码
    public function showVerify() {
        $config = array(
            'fontSize'  => 20, //字体默认为25px
            'imageW'    => 160, //宽高设置为0,则自动计算
            'imageH'    => 36,
            //'useZh'     => true,
            //'fonttts'   => '5.ttf', //在指定目录下 指定5.ttf
            //'useImgBg'  => true, //在指定目录下 随机使用背景图
            'length'    => 4, //字体个数
            'bg'        => array(250,250,250), //设置背景颜色
            'useNoise'  => false, //消除杂点
        );
        $verify = new \Think\Verify($config);
        $verify->entry();
    }
    //登录操作
    public function loginAction() {
        if (IS_POST) {
            $user = D("User");
            $username = addslashes(I("post.username"));
            $password = md5(addslashes(I("post.password")));
            $map = array(
                "username" => array("eq", $username),
                "password" => array("eq", $password),
            );
            if ($user->where($map)->select()) {
                //账号密码记住一个星期
                if (I("post.remember") == true) {
                    setcookie("username", $username, time() + 7*24*60, '/');
                    setcookie("password", $password, time() + 7*24*60, '/');
                } else {
                    setcookie("username", $map["username"], time() + 30*60, '/');
                    setcookie("password", $map["password"], time() + 30*60, '/');
                }
                $this->ajaxReturn(array("flag" => true, "message" => "登录成功"));
            } else {
                $this->ajaxReturn(array("flag" => false, "message" => "登录失败"));
            }
        }
    }
    //注册操作
    public function registerAction() {
        if (IS_POST) {
            $post_data = array(
                "username" => I("post.username"),
                "password" => I("post.password"),
                "repassword" => I("post.repassword"),
                "email"    => I("post.email"),
                "verify_code" => I("post.verifycode"),
            );
            $auto = array(
                array("password", "md5", 3, "function"), //对密码进行md5加密
            );
            $user = D("User");
            if ($user->create($post_data)) {
                $user->password = md5($user->password);
                if ($user->add() !== false) {
                    $this->ajaxReturn(array("flag" => true, "message" => "注册成功"));
                } else {
                    $this->ajaxReturn(array("flag" => false, "message" => "注册失败"));
                }
            } else {
                $this->ajaxReturn(array("flag" => false, "message" => $user->getError()));
            }
        }
    }
    //检查是都登录
    public function checkLogin() {
        if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
            return true;
        } else {
            return false;
        }
    }
    //注销操作
    public function logout() {
        if ($this->checkLogin()) {
            setcookie("username", '', time() - 1, '/');
            setcookie("password", '', time() - 1, '/');
            $this->success("注销成功", U("Home/Index/index"), 3);
        } else {
            $this->error("注销失败,可能是身份已过期.", U("Home/Index/index"), 3);
        }
    }
    // public function test() {
    //     echo md5("yangye");
    // }
    public function _empty() {
        echo '404';
    }
}
