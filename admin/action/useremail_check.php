<?php
    //验证邮箱是否已存在

    include '../control/user_control.php';
    //获取ajax提交的邮箱地址
    $useremail = trim($_GET['useremail']);
    
    //实例化用户控制类
    $userControl = new UserControl();
    
    //验证邮箱是否存在
    try{
        $array = $userControl->isEmailExist($useremail);  
        
        echo $array[0];
        die();
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

