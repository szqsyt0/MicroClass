<?php

require '../db_connect.php';
class UserControl
{
    /**
     * @return type 返回错误代码,登陆成功返回0
     * @param type $user_name
     * @param type $user_password
     * @err 错误代码
     * @identity 用户类别
     */
    function loginCheck($user_name,$user_password){
        $conn = DbConnect();
        //调用存储过程
        $conn->query("set @identity");
        $conn->query("set @err");
        $query = "call login($user_name,$user_password,@identity,@err);";
        $result = $conn->query($query);
        $return_values = $conn->query("select @identity,@err;");
        $array = mysqli_fetch_array($return_values);
        return $array;
    }            
}

