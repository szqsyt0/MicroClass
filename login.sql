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
