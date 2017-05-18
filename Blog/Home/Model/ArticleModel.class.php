<?php
namespace Home\Model;
use Think\Model\RelationModel;

class ArticleModel extends RelationModel {
    //主页
    protected $_link = array(
        'user' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'user',
            'class_name'   => 'User',
            'foreign_key'  => 'user_id',
            'mapping_fields' => 'username',
        ),
        'category' => array(
            'mapping_type' => self::MANY_TO_MANY,
            'mapping_name' => 'category',
            'class_name'   => 'Category',
            'foreign_key'  => 'art_id',
            'relation_table' => 'art_cate',
            'relation_foreign_key' => 'cate_id',
        )
    );
}
