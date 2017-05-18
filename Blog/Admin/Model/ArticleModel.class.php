<?php
namespace Admin\Model;
use Think\Model\RelationModel;

class ArticleModel extends RelationModel {
    protected $_link = array(
        //文章表和分类表的关联
        'category' => array(
            'mapping_type' => self::MANY_TO_MANY,
            'mapping_name' => 'category',
            'class_name'   => 'Category',
            'foreign_key'  => 'art_id', //对应当前模型的art_id
            'relation_table' => 'art_cate',
            'relation_foreign_key' => 'cate_id',  //对应当前关联的category表
        ),
        //文章表和标签表的关联
        'tag'      => array(
            'mapping_type' => self::MANY_TO_MANY,
            'mapping_name' => 'tag',
            'class_name'   => 'Tag',
            'foreign_key'  => 'art_id',
            'relation_table' => 'art_tag',
            'relation_foreign_key' => 'tag_id',
        ),
        //一対多
        'art_cate' => array(
            'mapping_type'   => self::HAS_MANY,
            'class_name'     => 'art_cate',
            'foreign_key'    => 'art_id',
            'mapping_name'   => 'art_cate',
        ),
    );

    protected $_auto = array(
        //array('title', 'addslashes', self::MODEL_BOTH, 'function'),
    );
    protected $_validate = array(
        array('title', 'require', '标题不能为空'),
        array('title', '1,50', '标题长度不能超过50个字符', self::MUST_VALIDATE, 'length'),
        array('content', 'require', '内容不能为空'),
    );
}
