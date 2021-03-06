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
