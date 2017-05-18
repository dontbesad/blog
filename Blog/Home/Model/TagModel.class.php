<?php
namespace Home\Model;
use Think\Model\RelationModel;

class TagModel extends RelationModel {
    protected $_link = array(
        'article' => array(
            'mapping_type' => self::MANY_TO_MANY,
            'class_name'   => 'Article',
            'mapping_name' => 'article',
            'foreign_key'  => 'art_id',
            'relation_table' => 'art_tag',
            'relation_foreign_key' => 'tag_id',
        ),
    );
}
