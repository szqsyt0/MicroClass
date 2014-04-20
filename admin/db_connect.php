<?php

    //连接数据库
    function DbConnect(){
        try{
            $conn = new mysqli('localhost','root','root','microclass');
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } 
        return $conn;
    }
    


