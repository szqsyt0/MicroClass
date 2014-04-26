delimiter //
/*******************************************************************************
 * 修改用户信息
 * 接收：用户id，新邮箱，新手机号，新身份
 * 返回：错误代码
 * 错误代码：0成功，1用户id不存在，2邮箱被占用，3手机号被占用，4身份不正确
 ******************************************************************************/
create procedure `change_userinfo` (
	in id int unsigned,
	in email varchar(32),
	in phonenumber varchar(11),
	in identity varchar(6),
	out errno int
)
change_userinfo_main:begin
	declare eid int unsigned;

	select `user_id` into eid from `user` where `user_id` = id;
	if (eid is null) then -- id不存在
		set errno = 1;
		leave change_userinfo_main;
	end if;

	if (useremail_existed(email) || -- 新邮箱被占用
		select locate('@',email) < 0 -- 邮箱格式不太对
		) then
		set errno = 2;
		leave change_userinfo_main;
	end if;

	if (userphone_existed(phonenumber) || -- 手机号已存在
		select length(phonenumber) != 11 -- 长度不为11
		) then
		set errno = 3;
		leave change_userinfo_main;
	end if;

	if (identity not in ('admin','sadmin','user') then -- 身份输入错误
		set errno = 4;
		leave change_userinfo_main;
	end if;

	update `user` set `user_email`=email, `user_phonenumber`=phonenumber, `user_identity`=iden
		where `user_id` = eid;
end//
delimiter ;
