<?php

    include '../control/user_control.php';
    $user_name = trim($_POST['user_name']);
    $user_password = md5(trim($_POST['user_password']));
    $userControl = new UserControl();
    
    session_start();
    try{
        $result = $userControl->loginCheck($user_name,$user_password);
        if(($result['identity']=='admin')&&$result['error']==0){
            //保存session
            $_SESSION['user_name'] = $user_name;
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

    

