<?php

    include '../control/user_control.php';
    
    //获取添加管理员需要的信息
    $user_name = trim($_POST['user_name']);
    $user_password = md5(trim($_POST['user_password']));
    $user_email = trim($_POST['user_email']);
    $user_phonenumber = trim($_POST['user_phonenumber']);
   
    $user_identity = trim($_POST['user_identity']);
    
    //实例化用户控制类
    $userControl = new UserControl();
    
    //开始尝试注册
    try{
        $result = $userControl->register($user_name, $user_password, $user_email, $user_phonenumber, $user_identity);
        if($result[0]==0){
           
            header("Location:../view/admin_manage.php");//应该跳转到注册成功页面
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

