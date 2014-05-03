<?php
    
    require_once '../control/category_control.php';
    
    $flag = $_REQUEST['flag'];    
    //根据flag的值来进行相应的处理
    if($flag == "del_category"){
        $category_id = trim($_REQUEST['category_id']);
        $categoryControl = new CategoryControl();
        $result = $categoryControl->deleteCategoryByID($category_id);
        //删除失败跳转到错误页面,否则返回分类管理页面
        if($result == 1){
            echo "<h1>删除失败</h1>";
            die();
        }else{
            header("Location:../view/category_manage.php");
        }
    }
    else if($flag == "add_category")
    {
        $categoryControl = new CategoryControl();
        $category_name = trim($_POST['category_name']);
        $parent_id = trim($_POST['parent_id']);
        $result = $categoryControl->addCategory($category_name, $parent_id);
        echo $parent_id;
        die();
        if($result['error']!=0){
            //创建失败，跳转到错误页面
            echo "<h1>添加分类失败！</h1>";
            die();
        }
        else
        {
            echo $category_name."<br/>";
            echo $parent_id."<br/>";
            echo $result['error'];
            die();
            //创建成功，返回分类页面
            header("Location:../view/category_manage.php");
        }
    }
    else if($flag == "iscategoryexist")
    {
        $categoryControl = new CategoryControl();
        $category_name = trim($_GET['categoryname']);
        $result = $categoryControl->isCategoryExist($category_name);
        echo $result[0];        
    }
    else if($flag == "change_category")
    {
        $category_id = $_POST['category_id'];
        $parent_id = $_POST['parent_id'];
        $category_name = $_POST['category_name'];
        $categoryControl = new CategoryControl();
        $result = $categoryControl->changeCategory($category_id, $category_name, $parent_id);
        if($result['error'] == 1)
        {
            //没有修改成功，跳转到错误页面
            echo "<h1>修改失败</h1>";
            die();
        }
        else
        {
            //修改成功，返回分类页面
            header("Location:../view/category_manage.php");
            die();
        }
    }
    
    

