<?php

    include '../control/user_control.php';
    $user_name = trim($_POST['user_name']);
    $user_password = trim($_POST['user_password']);
    $userControl = new UserControl();
    session_start();
    try{
        $result = $userControl->loginCheck($user_name,$user_password);
        print_r($result);
        echo '</br>'.$result[0].$result[1];
        if(($array[0]=='admin')&&$array[1]==0){
            //保存session
            $_SESSION['user_name'] = $user_name;
            //重定向浏览器
            header("Location:../admin.php");
        }
        else{
            header("Location:../login.php");
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }    

    

