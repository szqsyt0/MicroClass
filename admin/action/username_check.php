<?php
    //验证用户名是否已存在

    include '../control/user_control.php';
    //获取ajax提交的用户名
    $username = trim($_GET['username']);
    
    //实例化用户控制类
    $userControl = new UserControl();
    
    //验证用户名是否存在
    try{
        $array = $userControl->isUserExist($username);  
        
        echo $array[0];
        die();
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

