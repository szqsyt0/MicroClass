/*******************************************************************************
 * 删除单个分类,将删除所选分类的所有子分类
 * 输入：分类名
 * 输出：错误代码
 * 错误代码：0正确，1名字不存在
 ******************************************************************************/
delimiter //
create procedure `delete_category` (
	in name varchar(32),
	out errno int
)
delete_category_main:begin
	declare id int unsigned;

	select `category_id` into id 
		from `category` where `category_name` = name;
	if (id is null) then
		set errno=1;
		leave delete_category_main;
	end if;

	delete from `category` where `parent_id` = id;
	delete from `category` where `category_id` = id;
	set errno = 0;
end//
delimiter ;
