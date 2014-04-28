<?php

    include '../control/user_control.php';
    
    //获取添加管理员需要的信息
    $user_name = trim($_POST['user_name']);
    $user_password = md5(trim($_POST['user_password']));
    $user_email = trim($_POST['user_email']);
    $user_phonenumber = trim($_POST['user_phonenumber']);
    $user_identity = trim($_POST['user_identity']);
    
    
    //获取ajax提交的邮箱地址
    $useremail = trim($_GET['useremail']);
    //获取ajax提交的用户名
    $username = trim($_GET['username']);
    //获取ajax提交的手机号码地址
    $userphone = trim($_GET['userphone']);
    //获取ajax提交的标志位
    $flag = trim($_GET['flag']);
    
    //实例化用户控制类
    $userControl = new UserControl();
    
    //验证email是否存在
    if($flag=="emailcheck"){
        $array = $userControl->isEmailExist($useremail);         
        echo $array[0];
        die();
    }
    //验证手机号码是否存在
    else if($flag=="phonecheck"){
        $array = $userControl->isPhoneExist($userphone);          
        echo $array[0];
        die();
    }
    //验证用户名是否存在
    else if($flag=="usernamecheck"){
        $array = $userControl->isUserExist($username);         
        echo $array[0];
        die();
    }
    
    //开始尝试注册
    try{
        $result = $userControl->register($user_name, $user_password, $user_email, $user_phonenumber, $user_identity);
        if($result[0]==0){
           
            header("Location:../view/admin_manage.php");//应该跳转到注册成功页面
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

