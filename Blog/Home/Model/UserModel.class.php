<?php
namespace Home\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel {
    protected $_validate = array(
        array("username", "require", "用户名不能为空"),
        array("username", "", "用户名已存在", 0, "unique", 3),
        array("username", "1,20", "用户名不能超过20位", 0, "length", 3),
        array("password", "require", "密码不能为空"),
        array("password", "6,20", "密码不能小于6位,超过20位", 0, "length", 3),
        array("repassword", "password", "两次输入的密码不同", 0, "confirm", 3),
        array("email", "require", "邮箱不能为空"),
        array("email", "email", "邮箱格式错误"),
        array("verify_code", "require", "验证码不能为空"),
        array("verify_code", "checkVerify", "验证码错误", 0, "function"), //检验验证码
    );
}
