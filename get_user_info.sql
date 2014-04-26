/*******************************************************************************
 * 返回用户详细信息
 * 输入：用户id
 * 输出：错误代码 0成功，1id不存在
 ******************************************************************************/
delimiter //
create procedure get_user_info (
	in id int unsigned,
	out @err int
)
get_user_info_main:begin
	declare eid int unsigned;

	select `user_id`, `user_name`, `user_email`, `user_phonenunber`, `user_lastlogin`
		, `user_status`
		from `user` where 
end//
delmiiter ;
