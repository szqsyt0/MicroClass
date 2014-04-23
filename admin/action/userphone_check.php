<?php
    //验证手机号码是否已存在

    include '../control/user_control.php';
    //获取ajax提交的手机号码地址
    $userphone = trim($_GET['userphone']);
    
    //实例化用户控制类
    $userControl = new UserControl();
    
    //验证手机号码是否存在
    try{
        $array = $userControl->isPhoneExist($userphone);  
        
        echo $array[0];
        die();
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

