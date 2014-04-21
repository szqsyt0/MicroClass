<?php

    session_start();
    
    //删除Session
    unset($_SESSION['user_name']);
    $result_dest = session_destroy();
    
    if(empty($_SESSION['user_name'])){
        header("Location:./login.php");
        die();
    }
    

