# 创建专用用户
CREATE USER 'MicroClassUser'@'localhost' IDENTIFIED BY 'TeXk$u123';
# 创建数据库microclass
CREATE DATABASE microclass CHARACTER SET utf8;
# 只给用户执行的权力
GRANT execute ON microclass.* TO MicroClassUser@localhost;

# 创建表开始
USE microclass;
-- 用户表
CREATE TABLE `user` (
	`user_id` INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 
'自动增长的用户ID',
	`user_name` VARCHAR(32) NOT NULL UNIQUE COMMENT '唯一的，可用于登录的用户名',  
	`user_password` CHAR(32) NOT NULL COMMENT '密码',
	`user_email` VARCHAR(32) NOT NULL UNIQUE COMMENT '邮箱，必须有的',
	`user_phonenumber` CHAR(11) UNIQUE COMMENT '手机号，可以为空，可用来找回密码',
	`user_identity` VARCHAR(6) not null DEFAULT 'user' COMMENT 
'身份，若为admin则是管理员,sadmin为超级管理员',
	`user_lastlogin` DATE COMMENT '最后登录的日期',
	# `user_nickname` VARCHAR(60) COMMENT '昵称，可以为空',
	`user_status` TINYINT DEFAULT 0 NOT NULL COMMENT '用户状态，0为正常，1为被禁止评论'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 扩展的用户表
create table `user_extra` (
	`user_id` int unsigned not null primary key comment '依赖user表中的id',
	CONSTRAINT `user_extra_id_must_exist` FOREIGN KEY 
(`user_id`) REFERENCES `user` (`user_id`),
	`user_sex` char comment '性别，0男1女'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 添加默认管理员账户
INSERT INTO `microclass`.`user` 
( `user_id`, `user_name`, `user_password`, `user_email`, `user_phonenumber`,
       	`user_identity`, `user_lastlogin`, `user_status`)
VALUES ( default, 'admin', md5('admin'), 'admin@admin.com', null, 
	'sadmin', curdate(), default);

-- 专辑表
create table `album` (
	`album_id` int unsigned not null primary key auto_increment comment 
'专辑id',
	`album_name` varchar(32) not null unique comment '专辑名，不可重复',
	`album_cover` varchar(32) comment '使用图片路径存储封面',
	`album_playcount` int UNSIGNED not null default 0 comment '播放数',
	`album_introduction` text comment '专辑简介'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 分类表
create table `category` (
	`category_id` int UNSIGNED not null primary key auto_increment comment 
'分类的id',
	`parent_id` int UNSIGNED not null default 0 comment '父类别id',
	`category_name` varchar(32) not null unique comment '该分类的名字,,不可重复'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 授课教师表，前期不使用
create table `teacher` (
	`teacher_id` int UNSIGNED not null primary key AUTO_INCREMENT comment 
'授课教师id',
	`teacher_name` varchar(32) not null comment '教师名字',
	`teacher_photo` varchar(32) comment '使用路径存储照片',
	`teacher_introduction` text comment '教师简介'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 视频表
CREATE TABLE `video` (
	`video_id` int UNSIGNED not null primary key auto_increment comment '自动增长的视频ID',
	`video_title` varchar(50) not null comment '视频标题',
	`video_path` varchar(32) not null comment '视频的相对存储路径',
	`video_screenshot` varchar(32) comment '视频截图(封面)，使用路径存储',
	`video_playcount` int UNSIGNED not null default 0 comment '播放次数统计',
	`video_rating` tinyint not null default 0 comment '平均评分',
	`video_rating_count` int UNSIGNED not null default 0 comment '评分次数',
	`video_introduction` text comment '视频简介',
	`video_category_id` int UNSIGNED not null comment '分类的id',
	CONSTRAINT `video_category_id_must_exist` FOREIGN KEY 
(`video_category_id`) REFERENCES `category` (`category_id`),
	`video_uploader_id` int UNSIGNED not null comment '上传者id',
	CONSTRAINT `video_user_id_must_exist` FOREIGN KEY (`video_uploader_id`) 
REFERENCES `user` (`user_id`),
	`video_album_id` int UNSIGNED not null comment '所属专辑id',
	CONSTRAINT `video_album_id_must_exist` FOREIGN KEY (`video_album_id`) 
REFERENCES `album` (`album_id`),
	`video_teacher_id` int UNSIGNED comment '授课教师id',
	CONSTRAINT `video_teacher_id_must_exist` FOREIGN KEY 
(`video_teacher_id`) REFERENCES `teacher` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 评论表
create table `comment` (
	`comment_id` int UNSIGNED not null primary key AUTO_INCREMENT comment 
'评论的id',
	`parent_id` int UNSIGNED comment '父评论的id，即评论中的评论需要此项',
	CONSTRAINT `comment_parent_id_must_exist` FOREIGN KEY (`parent_id`) 
REFERENCES `comment` (`comment_id`),
	`video_id` int UNSIGNED not null comment '所评论的视频id',
	-- 若评论的视频被删除，所属的评论也全部删除
	CONSTRAINT `comment_video_id_must_exist` FOREIGN KEY (`video_id`) 
REFERENCES `video` (`video_id`) on delete cascade on update cascade,
	`commentator_id` int UNSIGNED not null comment '评论者的id',
	-- 若评论者的信息被删除，所属评论全部删除
	CONSTRAINT `comment_commentator_id_must_exist` FOREIGN KEY 
(`commentator_id`) REFERENCES `user` (`user_id`) on delete cascade on update 
cascade,
	`comment_text` text not null comment '评论内容，不准为空',
	`comment_time` datetime not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 收藏的视频表
create table `favorite_video` (
	`user_id` int UNSIGNED not null comment '收藏者id',
	CONSTRAINT `favorite_video_user_id_must_exist` FOREIGN KEY (`user_id`) 
REFERENCES `user` (`user_id`) on delete cascade on update cascade,
	`video_id` int UNSIGNED not null comment '收藏的视频id',
	constraint `favorite_video_primary_key` primary key (user_id, video_id),
	`favorite_time` date not null comment '收藏时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 收藏的专辑表
create table `favorite_album` (
	`user_id` int UNSIGNED not null comment '收藏者id',
	CONSTRAINT `favorite_album_user_id_must_exist` FOREIGN KEY (`user_id`) 
REFERENCES `user` (`user_id`) on delete cascade on update cascade,
	`album_id` int UNSIGNED not null comment '收藏的专辑id',
	constraint `favorite_album_primary_key` primary key (`user_id`, 
`album_id`),
	`favorite_time` date not null comment '收藏时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 观看记录
create table `watch_record` (
	`user_id` int UNSIGNED not null comment '用户id',
	-- 用户消失则观看记录消失
	CONSTRAINT `record_user_id_must_exist` FOREIGN KEY (`user_id`) 
REFERENCES `user` (`user_id`) on delete cascade on update cascade,
	`video_id` int UNSIGNED not null comment '视频id',
	-- 视频被删除则观看记录也删除(?)
	CONSTRAINT `record_video_id_must_exist` FOREIGN KEY (`video_id`) 
REFERENCES `video` (`video_id`) on delete cascade on update cascade,
	constraint `watch_record_primary_key` primary key (`user_id`, 
`video_id`),
	`last_time` datetime not null comment '最后观看时间，包括时分秒',
	`watch_point` int default 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

#################################创建表结束#####################################
 
