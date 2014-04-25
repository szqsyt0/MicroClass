<?php

    include '../control/user_control.php';
    //获取登陆需要的信息
    $user_name = trim($_POST['user_name']);
    $user_password = md5(trim($_POST['user_password']));
    
    //实例化用户控制类
    $userControl = new UserControl();
    
    session_start();
    try{
        $result = $userControl->loginCheck($user_name,$user_password);
        if(($result['identity']=='admin'||$result['identity']=='sadmin')&&$result['error']==0){
            //保存session
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_identity'] = $result['identity'];
            //重定向浏览器
            header("Location:../admin.php");
            die();
        }
        else{
            header("Location:../login.php");
            die();
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }   

    

