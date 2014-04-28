# 创建专用用户
#CREATE USER 'MicroClassUser'@'localhost' IDENTIFIED BY 'TeXk$u123';
# 创建数据库microclass
CREATE DATABASE microclass CHARACTER SET utf8;
# 只给用户执行的权力
#GRANT execute ON microclass.* TO MicroClassUser@localhost;

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
	`album_cover` longblob comment '使用longblob直接存储封面',
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
	`teacher_photo` longblob comment '照片',
	`teacher_introduction` text comment '教师简介'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 视频表
CREATE TABLE `video` (
	`video_id` int UNSIGNED not null primary key auto_increment comment '自动增长的视频ID',
	`video_title` varchar(50) not null comment '视频标题',
	`video_path` varchar(32) not null comment '视频的相对存储路径',
	`video_screenshot` longblob comment '视频截图(封面)，使用longblob直接存入mysql',
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
delimiter //
/*******************************************************************************
 * 添加分类
 * 接收：分类名，所属父分类名
 * 返回：错误代码
 * 错误代码：0成功，1分类名已存在，2父分类已不存在
 ******************************************************************************/
create procedure add_category (
	in name varchar(32),
	in parentname varchar(32),
	out errno int
)
add_category_main:begin
	declare parent_id int unsigned;
	if (category_existed (name)) then
		set errno = 1;
		leave add_category_main;
	end if;
	
	select `category_id` into parent_id 
		from `category` where `category_name` = parentname;
	if (parentname is not null and parent_id is null) then
		set errno = 2;
		leave add_category_main;
	end if;

	if (parent_id is null) then 
		set parent_id=0;
	end if;
	insert into `category` values
		(default,parent_id,name);
	set errno = 0;
end//##########################添加分类结束#####################################

-- 判断分类名是否存在
create function category_existed (categoryname varchar(32))
	returns boolean
	DETERMINISTIC
begin
	declare counter int;
	select count(`category_id`) into counter from `category` where 
`category_name`=categoryname;
	if (counter > 0) then
		return true;
	else
		return false;
	end if;
	return true;
end//
delimiter ;
############################################################################ 

 * 修改分类信息
 * 输入：分类id，新分类名，新父分类名
 * 输出：错误代码
 * 错误代码：0成功，1分类名不存在，2父分类名不存在
 ******************************************************************************/
delimiter //
create procedure change_category (
	in id int unsigned,
	in newname varchar(32),
	in parentname varchar(32),
	out errno int
)
change_category_main:begin
	declare eid int unsigned;
	declare pid int unsigned;

	# 分类名不存在
	select `category_id` into eid from `category` where `category_id`=id;
	if (eid is null) then
		set errno = 1;
		leave change_category_main;
	end if;

	# 父分类名不存在
	select `category_id` into pid from `category` where `category_name`=parentname;
	if (pid is null) then
		set errno = 2;
		leave change_category_main;
	end if;

	# 进行修改
	update `category`
		set `category_name` = newname, `parent_id` = pid 
		where `category_id` = id;

	set errno = 0;
end//
delimiter ;

delimiter //
/**********************************************************
 * 修改密码的存储过程，密码皆使用md5值传送
 * 接收：用户id，原密码，新密码
 * 输出：错误代码
 * 错误代码：0修改成功，1原密码错误，2用户id不存在，3新密码格式有误
 **********************************************************/
create procedure change_password(
	in userid varchar(20),
	in oldpassword char(32),
	in newpassword char(32),
	out errno int
)
change_password_main:begin
	declare id int unsigned;
	declare truepassword char(32);
	select `user_id`, `user_password`
		into id , truepassword 
		from user
		where `user_id` = userid;

	# 错误处理
	if (length(newpassword) != 32) then
		set errno = 3; -- 新密码不是md5加密的密码
		leave change_password_main;
	end if;

	if (id is null) then
		set errno = 2; -- 用户id不存在
		leave change_password_main;
	end if;

	if (oldpassword not like truepassword) then
		set errno = 1; -- 密码错误
		leave change_password_main;
	end if;
	#错误处理结束

	update `user` 
		set `user_password` = newpassword
		where `user_id` = id; 
	set errno = 0;
end//##########################修改密码结束#####################################
delimiter ; 
delimiter //
/*******************************************************************************
 * 修改用户信息，待完善
 * 接收：用户名，新邮箱，新手机号
 * 返回：错误代码
 * 错误代码：0成功，1
 ******************************************************************************/
create procedure `change_userinfo` (
	in name varchar(32),
	in email varchar(32),
	in phonenumber varchar(32),
	out errno int
)
begin

end//
delimiter ;

 
/*******************************************************************************
 * 删除单个分类,将删除所选分类的所有子分类
 * 输入：分类id
 * 输出：错误代码
 * 错误代码：0正确，1分类id不存在
 ******************************************************************************/
delimiter //
create procedure `delete_category` (
	in id int unsigned,
	out errno int
)
delete_category_main:begin
	declare eid int unsigned;

	select `category_id` into eid 
		from `category` where `category_id` = id;
	if (eid is null) then
		set errno=1;
		leave delete_category_main;
	end if;

	delete from `category` where `parent_id` = id;
	delete from `category` where `category_id` = id;
	set errno = 0;
end//
delimiter ;
/*******************************************************************************
 * 删除评论及其所有子评论
 * 输入：评论id
 * 输出：错误代码
 * 错误代码：0成功，1错误
 *******************************************************************************/
delimiter //
create procedure delete_comment (
	in id int unsigned,
	out errno int
)
delete_comment_main:begin
	declare eid int unsigned;

	select `id` into eid from `comment` where `comment_id`=id;
	if (eid is null) then
		set errno = 1;
		leave delete_comment_main;
	end if;
	delete from `comment` where `parent_id` = id;
	delete from `comment` where `comment_id` = id;
	set errno = 0;
end//
delimiter ;

/*******************************************************************************
 * 删除用户
 * 输入：用户id
 * 输出：错误代码，0成功，1id不存在
 ******************************************************************************/
delimiter //
create procedure `delete_user` (
	in id int unsigned,
	out errno int
)
delete_user_main:begin
	declare eid int unsigned;
	select `user_id` into eid from `user` where `user_id`=id;
	if (eid is null) then 
		set errno = 1;
		leave delete_user_main;
	end if;
	delete from `user` where `user_id` = eid;
	set errno = 0;
end//
delimiter ;

/*******************************************************************************
 * 返回用户详细信息
 * 输入：用户id
 * 输出：错误代码 0成功，1id不存在
 ******************************************************************************/
delimiter //
create procedure get_user_info (
	in id int unsigned,
	out errno int
)
get_user_info_main:begin
	declare eid int unsigned;

	select `user_id` into eid from `user` where `user_id` = id;
	if (eid is null) then
		set errno = 1;
		leave get_user_info_main;
	end if;
	select * from (
		select `user_id` as `id`,`user_name`,`user_email`,`user_phonenumber`
			,`user_lastlogin`,`user_status` 
			from `user` where `user_id` = id
	) s1 left join (
		select * from `user_extra` where `user_id` = id
	) s2 on s1.`id`=s2.`user_id`;
	set errno = 0;
end//
delimiter ;
delimiter //
/***************************************************************
 * 登录的存储过程
 * 接收: 邮箱或用户名，与md5加密的密码
 * 输出：id，身份，错误代码
 * 错误代码：0为验证成功，1为密码错误，2为无该用户
 ***************************************************************/
create procedure login (
	in username varchar(20),
	in password char(32), 
	out id int unsigned,
	out identity varchar(6), 
	out errno int
)
login_main: begin
	DECLARE true_password char(32); -- 提取真正的密码用于与接受的密码比较
	set id=0;

	if (select locate('@',username) > 0) then -- 若含有'@'字符则认定用户名为email
		select `user_password`,`user_identity`, `user_id`
			into true_password,identity,id 
			from user 
			where `user_email`=username;
	else				      -- 用户名登录
		select `user_password`,`user_identity`,`user_id`
			into true_password,identity,id 
			from user 
			where `user_name`=username;
	end if;

	if (length(id) is null) then -- 未找到该名字
		select 2 into errno; -- no this name
		leave login_main;
	else if (true_password like password) then
			update `user` set `user_lastlogin`=curdate()
				where `user_id`=id; -- 改变登录时间
			select 0 into errno; -- true password
			leave login_main;
		else
			select 1 into errno; -- wrong passworduseruser
			select NULL into identity; -- 不会泄露身份信息
			leave login_main;
		end if;
	end if;
end//##########################登录结束#####################################
delimiter ; 
delimiter //
/**********************************************************
 * 注册用的存储过程，密码使用md5值传送
 * 接收：用户名，密码，邮箱，手机，身份
 * 输出：错误代码
 * 错误代码：0注册成功，1用户名已存在，2邮箱已存在，3手机号已存在
 **********************************************************/
create procedure register (
	in name varchar(32), -- 用户名
	in password char(32),    -- 密码,固定为32个字符的MD5码
	in email varchar(32),    -- 邮箱
	in phone varchar(11),    -- 手机号，暂时用varchar
	in identity varchar(6),  -- 身份，若为admin则是添加管理员
	out errno int            -- 返回的错误代码
)
register_main: begin
	
	if (username_existed(name)) then
		set errno=1;
		leave register_main;
	else if (useremail_existed(email)) then
		set errno=2;
		leave register_main;
	else if (userphone_existed(phone)) then
		set errno=3;
		leave register_main;
	end if;
	end if;
	end if;
	if (identity not in ('admin','sadmin')) then
		set identity='user';
	end if;
	INSERT INTO `microclass`.`user` ( `user_name`, `user_password`, 
`user_email`
		, `user_phonenumber`, `user_identity`, `user_lastlogin`) 
	VALUES ( name, password, email, phone, identity, curdate());

	set errno=0;
end//##########################注册结束#######################################

-- 判断用户名是否存在的function
create function username_existed(username varchar(32))
	returns boolean
	DETERMINISTIC
begin
	declare counter int;
	select count(`user_id`) into counter from `user` where 
`user_name`=username;
	if (counter > 0) then
		return true;
	else
		return false;
	end if;
	return true;
end//
--
-- 判断邮箱
create function useremail_existed(useremail varchar(32))
	returns boolean
	DETERMINISTIC
begin
	declare counter int;
	select count(`user_id`) into counter from `user` where 
`user_email`=useremail;
	if (counter > 0) then
		return true;
	else
		return false;
	end if;
	return true;
end//
--
-- 判断电话号码
create function userphone_existed(userphone varchar(32))
	returns boolean
	DETERMINISTIC
begin
	declare counter int;
	select count(`user_id`) into counter from `user` where 
`user_phonenumber`=userphone;
	if (counter > 0) then
		return true;
	else
		return false;
	end if;
	return true;
end//
delimiter ;
#################################3判断函数结束###################################
/*******************************************************************************
 * 返回所有管理员的信息，超级管理员可以执行
 * 接收：页码，页大小
 * 返回：错误代码
 * 错误代码：0正确，1失败
 ******************************************************************************/
delimiter //
create procedure show_admins (
	in pagenum int,
	in pagesize int,
	out errno int
)
show_admins_main:begin
	declare position int;

	if (pagenum < 0 || pagesize <= 0) then
		set errno = 1;
		leave show_admins_main;
	end if;
	set position=(pagenum - 1) * pagesize;
	select * from `user` where `user_identity`='admin' or `user_identity`='sadmin'
       	limit position, pagesize;
	set errno=0;
end//
delimiter ;

DELIMITER //
CREATE PROCEDURE `show_categories` ()
begin 
	SELECT * FROM `category`;
end//
DELIMITER ;
/*******************************************************************************
 * 返回评论列表
 * 输入：页码，分页大小
 * 输出：错误代码
 * 错误代码：0成功，1错误
 *******************************************************************************/
delimiter //
create procedure `show_comments` (
	in pagenum int,
	in pagesize int,
	out errno int
)
show_comments_main:begin
	declare position int;
	if (pagenum < 0 || pagesize < 0) then 
		set errno = 1;
		leave show_comments_main;
	end if;
	set position=(pagenum - 1) * pagesize;
	select * from `comment` limit position, pagesize;
	set errno = 0;
end//
delimiter ;
delimiter //
/*******************************************************************************
 * 上传视频的存储过程
 * 接收：视频名称，视频相对路径，截图(二进制)，简介，分类名，所属专辑名字,上传者,
 * 返回：错误代码
 * 错误代码：0成功，1上传者名字不存在
 ******************************************************************************/
create procedure upload_video (
	in title varchar(32),
	in path varchar(32),
	in screenshot longblob,
	in info text,
	in category varchar(10),
	in album varchar(32),
	in uploader varchar(32),
	out errno int
)
upload_video_main:begin
	declare uploader_id int unsigned;
	declare category_id int unsigned;

	# 获取上传者id
	select `user_id` into uploader_id 
		from `user` where `user_name` = uploader;
	if (uploader_id is null) then -- 上传者不存在就报错
		set errno=1;
	end if;
	
	# 获取分类id
	select `category_id` into category_id
		from `category` where `category_name` = category;
	if (category_id is null) then -- 分类不存在则创建
		insert into `category` values (
			default, default, null);
		select `category_id` into category_id 
			from `category` where `category_name` = category;
	end if;

	# 插入到`video`
	INSERT INTO `microclass`.`video` (`video_title`, `video_path`, `video_screenshot`,
		`video_introduction`, `video_category_id`, `upload_videoer_id`, `video_album_id`)
	VALUES (
		title, path, screenshot,
		info, category_id, uploader_id, album
	);

end//##########################上传视频结束#####################################
delimiter ; 
