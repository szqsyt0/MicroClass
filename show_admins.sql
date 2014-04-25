#############################查询管理员#########################################
delimiter //
/*******************************************************************************
 * 返回所有管理员的信息，超级管理员可以执行
 * 接收：页码，页大小
 * 返回：错误代码
 * 错误代码：0正确，1失败
 ******************************************************************************/
create procedure show_admins (
	in pagenum int,
	in pagesize int,
	out errno int
)
begin
	declare position int;
	set position=(pagenum - 1) * pagesize;
	select * from `user` where `user_identity`='admin' or `user_identity`='sadmin'
       	limit position, pagesize;
	set errno=0;
end//
delimiter ;


