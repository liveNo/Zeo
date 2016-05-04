CREATE TABLE `zeo_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户登录名',
  `email` varchar(100) DEFAULT NULL COMMENT '用户邮箱',
  `mobile` char(11) DEFAULT NULL COMMENT '手机',
  `password` varchar(60) NOT NULL COMMENT '用户密码',
  `nickname` varchar(20) NOT NULL COMMENT '用户屏显昵称，可以不同用户登录名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态：1正常 2禁用 3删除',
  `user_type` tinyint(1) DEFAULT '1' COMMENT '用户类型 (1自主注册2系统注册)',
  `create_date` int(11) NOT NULL COMMENT '入库日期',
  `create_ip` int(11) unsigned DEFAULT NULL COMMENT '注册ip',
  `update_date` int(11) NOT NULL COMMENT '修改日期',
  `last_date` int(11) NOT NULL COMMENT '最后登录日期',
  `last_ip` int(11) unsigned DEFAULT NULL COMMENT '最后登录ip',
  `mobile_token` varchar(100) NOT NULL COMMENT '移动端用户登录检测token',
  PRIMARY KEY (`id`),
  KEY `mobile` (`mobile`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

CREATE TABLE `zeo_article_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '分类名称',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态： 0、停用 1、正常 2、删除',
  `created_date` int(10) NOT NULL COMMENT '创建时间',
  `updated_date` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_categories_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类';

CREATE TABLE `zeo_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '作者ID',
  `category_id` int(10) unsigned NOT NULL COMMENT '文章分类ID',
  `comments_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `slug` varchar(255) NOT NULL COMMENT '文章缩略名',
  `content` text NOT NULL COMMENT '内容',
  `content_format` varchar(255) NOT NULL DEFAULT 'markdown' COMMENT '内容格式，为后期加入非 markdown 编辑器做准备',
  `meta_title` varchar(255) DEFAULT NULL COMMENT 'SEO 页面标题',
  `meta_description` varchar(255) DEFAULT NULL COMMENT 'SEO 页面描述',
  `meta_keywords` varchar(255) DEFAULT NULL COMMENT 'SEO 页面关键词',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态： 0、停用 1、正常 2、删除',
  `created_date` int(10) NOT NULL COMMENT '创建时间',
  `updated_date` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_title_unique` (`title`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_user_id_index` (`user_id`),
  KEY `articles_category_id_index` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='文章';


CREATE TABLE `zeo_articles_archives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '文章分类ID',
  `articles_id` int(10) unsigned NOT NULL COMMENT '文章ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `slug` varchar(255) NOT NULL COMMENT '文章缩略名',
  `content` text NOT NULL COMMENT '内容',
  `content_format` varchar(255) NOT NULL DEFAULT 'markdown' COMMENT '内容格式，为后期加入非 markdown 编辑器做准备',
  `created_date` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_title_unique` (`title`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_category_id_index` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章存档';


CREATE TABLE `zeo_article_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '作者ID',
  `reply_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复评论id',
  `article_id` int(10) unsigned NOT NULL COMMENT '归属文章ID',
  `content` text NOT NULL COMMENT '内容',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态： 0、停用 1、正常 2、删除',
  `created_date` int(10) NOT NULL COMMENT '创建时间',
  `updated_date` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `article_comments_user_id_index` (`user_id`),
  KEY `article_comments_article_id_index` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章的评论';


CREATE TABLE `zeo_active_calendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '作者ID',
  `active_date` int(10) unsigned NOT NULL COMMENT '活跃日期',
  `active_count` int(10) NOT NULL COMMENT '活跃次数',
  `created_date` int(10) NOT NULL COMMENT '创建时间',
  `updated_date` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `article_comments_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='活跃日历';


CREATE TABLE `zeo_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '主办用户id',
  `action` varchar(100) DEFAULT '' COMMENT '执行动作',
  `url` varchar(200) DEFAULT '-' COMMENT '操作发起的url',
  `info` varchar(500) DEFAULT '' COMMENT '操作行为',
  `remote_ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '操作IP',
  `create_date` int(11) NOT NULL COMMENT '入库日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作日志';

/* Task list */







