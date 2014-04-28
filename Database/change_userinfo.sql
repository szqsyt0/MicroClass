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
