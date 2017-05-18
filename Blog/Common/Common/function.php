<?php
//--自定义函数--
/**
 * 检验用户是否登录s
 * @access public
 * @param void
 * @return mixed
 */
function checkLogin() {
    if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
        $map = array(
            "username" => I("cookie.username"),
            "password" => I("cookie.password"),
        );
        $user = M("User")->where($map)->select();
        if (empty($user)) {
            return false;
        } else {
            return $user[0]["user_id"];
        }
    } else {
        return false;
    }
}
