<?php

require '../db_connect.php';
require '../model/category.php';

class CategoryControl{
    
    /**
     * 获取所有分类的ID，上层分类ID，名称
     * @return array
     */
    function getCategoryList(){
    $conn = DbConnect();
    $sql = "call show_categories();";
    $result = $conn->query($sql);
    $return_values = array();
    while($row = mysqli_fetch_array($result)){
        $category = new Category();
        $category->set_category_id($row['category_id']);
        $category->set_parent_id($row['parent_id']);
        $category->set_category_name($row['category_name']);
        array_push($return_values, serialize($category));
    }
    $conn->close();
    return $return_values;
    }
    
    /**
     * 根据分类ID获取分类名
     * @param type $category_id
     */
    function getCategoryNameByID($category_id){
        $conn = DbConnect();
        $sql = "select category_name from category where category_id=".$category_id;
        $result = $conn->query($sql);
        $result = mysqli_fetch_array($result);
        $conn->close();
        return $result['category_name'];
    }
    
    /**
     * 通过id删除分类
     * @param type $category_id
     */
    function deleteCategoryByID($category_id){
        $conn = DbConnect();
        //初始化变量
        $conn->query("set @id=".$category_id);
        //调用删除分类的存储过程
        $sql = "call delete_category(@id,@err);";
        $result = $conn->query($sql);
        $result = $conn->query("select @err as error");      
        $result = mysqli_fetch_array($result);
        $conn->close();
        return $result['error'];
    }
    
    /**
     * 检查分类是否存在
     * @param type $category_name
     * @return type
     */
    function isCategoryExist($category_name)
    {
        $conn = DbConnect();
        $sql = "select category_existed('".$category_name."');";
        $result = $conn->query($sql);
        $result = mysqli_fetch_array($result);
        $conn->close();
        return $result;
    }
    
    /**
     * 添加分类
     * @param type $category_name
     * @param type $parent_id
     * @return type
     */
    function addCategory($category_name,$parent_id)
    {
        $conn = DbConnect();
        //初始化变量
        $conn->query("set @name='".$category_name."'");
        $conn->query("set @id=".$parent_id);
        $sql = "call add_category(@name,@id,@err);";
        $result = $conn->query($sql);
        $result = $conn->query("select @err as error");
        $result = mysqli_fetch_array($result);
        $conn->close();
        return $result;
    }
    
    function changeCategory($category_id,$category_name,$parent_id)
    {
        $conn = DbConnect();
         //初始化变量
        $conn->query("set @id=".$category_id);
        $conn->query("set @parent_id=".$parent_id);
        $conn->query("set @name='".$category_name."'");
        $sql = "call change_category(@id,@name,@parent_id,@err)";
        $result = $conn->query($sql);
        $result = $conn->query("select @err as error");
        $result = mysqli_fetch_array($result);
        return $result;
    }
}


