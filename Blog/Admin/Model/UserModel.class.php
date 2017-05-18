<?php
namespace Admin\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel {
    protected $_link = array(
        "auth_group" => array(
            "mapping_type"   => self::MANY_TO_MANY,
            "class_name"     => "Auth_group",
            "mapping_name"   => "auth_group",
            "foreign_key"    => "uid",
            "relation_table" => "auth_group_access",
            "relation_foreign_key" => "group_id",
        ),
    );
}
