/* 创建新的数据库名为blog */
CREATE DATABASE blog DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `art_cate`;
CREATE TABLE `art_cate` (
  `art_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
DROP TABLE IF EXISTS `art_tag`;
CREATE TABLE `art_tag` (
  `art_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `pub_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`art_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `auth_group` VALUES (1,'文章管理',1,'1,2,3,4,5,6,7,8,9,10'),(2,'友链管理',1,'11,12,13'),(3,'用户管理',1,'14,15,16,17,18,19,20,21'),(4,'主页访问',1,'22,23');

DROP TABLE IF EXISTS `auth_group_access`;
CREATE TABLE `auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO `auth_rule` VALUES (1,'Admin/Article/article','文章添加修改页',1,1,''),(2,'Admin/Article/addArt','文章添加',1,1,''),(3,'Admin/Article/updateArt','文章修改',1,1,''),(4,'Admin/Article/delArt','文章删除',1,1,''),(5,'Admin/Article/listArt','文章列表页',1,1,''),(6,'Admin/Article/listCategory','分类列表页',1,1,''),(7,'Admin/Article/addCate','添加分类',1,1,''),(8,'Admin/Article/updateCate','更改分类',1,1,''),(9,'Admin/Article/delCate','删除分类',1,1,''),(10,'Admin/Article/addTag','添加标签',1,1,''),(11,'Admin/Friendlink/listLink','友链列表页',1,1,''),(12,'Admin/Friendlink/addLink','添加友链',1,1,''),(13,'Admin/Friendlink/delLink','删除友链',1,1,''),(14,'Admin/User/userList','用户列表页',1,1,''),(15,'Admin/User/userAdd','用户添加页',1,1,''),(16,'Admin/User/userAddAction','添加用户',1,1,''),(17,'Admin/User/userEdit','用户修改页',1,1,''),(18,'Admin/User/userEditAction','修改用户',1,1,''),(19,'Admin/User/userDelAction','删除用户',1,1,''),(20,'Admin/User/userAuth','用户权限设置页',1,1,''),(21,'Admin/User/userAuthAction','用户权限设置',1,1,''),(22,'Admin/Index/index','后台主页',1,1,''),(23,'Admin/Index/serverInfo','服务器信息页',1,1,'');


DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(20) NOT NULL,
  PRIMARY KEY (`cate_id`),
  UNIQUE KEY `cate_name` (`cate_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `com_id` int(11) NOT NULL,
  `com_content` varchar(100) NOT NULL,
  `com_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `friend_link`;
CREATE TABLE `friend_link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(30) NOT NULL,
  `link_addr` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(20) NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `tag_name` (`tag_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(30) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

