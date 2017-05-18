<?php
namespace Admin\Model;
use Think\Model\RelationModel;

class CategoryModel extends RelationModel {
    //自动验证 cate_name
    protected $_validate = array(
        array('cate_name', 'require', '分类名不得为空'),
        array('cate_name', '1,20', '分类名不得超过20个字符', 2, 'length'),
        array('cate_name', '', '分类名已存在', 2, 'unique'),
    );
    //管理分类 多対多
    protected $_link = array(
        'article' => array(
            'mapping_type'   => self::MANY_TO_MANY,
            'mapping_name'   => 'article',
            'class_name'     => 'article',
            'foreign_key'    => 'cate_id',
            'relation_table' => 'art_cate',
            'relation_foreign_key' => 'art_id',
        ),
    );

}
