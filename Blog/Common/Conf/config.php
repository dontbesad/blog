<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'     => 'mysql',
    'DB_HOST'     => '127.0.0.1',
    'DB_NAME'     => 'blog',
    'DB_USER'     => 'root',   //数据库用户名
    'DB_PWD'      => 'yangye', //数据库密码
    'DB_PORT'     => '3306',
    'DB_CHARSET'  => 'utf8',

    'MODULE_DENY_LIST'   => array('Runtime', 'Common'),
    'SHOW_PAGE_TRACE'    => true,

);
/*

#用户表
CREATE TABLE user (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL UNIQUE KEY,  #用户名
    password VARCHAR(32) NOT NULL,      #密码
    email    VARCHAR(30) NOT NULL,      #邮箱
    reg_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP  #注册时间
);

#博文表
CREATE TABLE article (
    art_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(30) NOT NULL, #标题
    content TEXT NOT NULL, #内容
    pub_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, #发布时间
    user_id INT NOT NULL DEFAULT 0     #关联的发表者
);

#类别表
CREATE TABLE category (
    cate_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cate_name VARCHAR(20) NOT NULL   #分类名
);

#标签表
CREATE TABLE tag (
    tag_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(20) NOT NULL,  #标签名
    tag_intro VARCHAR(50) NOT NULL DEFAULT ''
);

#文章和分类互相对应表
CREATE TABLE art_cate (
    art_id INT NOT NULL,
    cate_id INT NOT NULL
);

#文章和标签互相对应表
CREATE TABLE art_tag (
    art_id INT NOT NULL,
    tag_id INT NOT NULL
);

#文章评论表
CREATE TABLE comment (
    com_id INT NOT NULL,
    com_content VARCHAR(100) NOT NULL,
    com_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    art_id INT NOT NULL
);

#用户信息

#友情链接
CREATE TABLE friend_link (
    link_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    link_name VARCHAR(30) NOT NULL,
    link_addr VARCHAR(500) NOT NULL DEFAULT ''
);
*/
