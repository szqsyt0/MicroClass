delimiter //
/*******************************************************************************
 * 上传视频的存储过程
 * 接收：视频名称，视频相对路径，截图(二进制)，简介，分类名，所属专辑名字,上传者,
 * 返回：错误代码
 * 错误代码：0成功，1上传者名字不存在
 ******************************************************************************/
create procedure video_upload (
	in title varchar(32),
	in path varchar(32),
	in screenshot longblob,
	in info text,
	in category varchar(10),
	in album varchar(32),
	in uploader varchar(32),
	out errno int
)
video_upload_main:begin
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

	INSERT INTO `microclass`.`video` (
		`video_id`,
		`video_title`,
		`video_path`,
		`video_screenshot`,
		`video_playcount`,
		`video_rating`,
		`video_rating_count`,
		`video_introduction`,
		`video_category_id`,
		`video_uploader_id`,
		`video_album_id`,
		`video_teacher_id`
		) VALUES (
		default,
		title,
		path,
		screenshot,
		default,
		default,
		default,
		info,
		category_id,
		uploader_id,
		album,
		null);

end//##########################上传视频结束#####################################
delimiter ; 
