<?php
namespace Home\Model;
use Think\Model\RelationModel;

class CategoryModel extends RelationModel {
    protected $_link = array(
        'article' => array(
            'mapping_type' => self::MANY_TO_MANY,
            'mapping_name' => 'article',
            'class_name'   => 'Article',
            'foreign_key'  => 'cate_id',
            'relation_table' => 'art_cate',
            'relation_foreign_key' => 'art_id',
        ),
    );
}
