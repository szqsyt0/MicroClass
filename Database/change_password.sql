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
