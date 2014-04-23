<?php

require '../db_connect.php';
class UserControl
{
    /**
     * 登陆
     * @return type 返回错误代码,登陆成功返回0
     * @param type $user_name
     * @param type $user_password
     * @err 错误代码
     * @identity 用户类别
     */
    function loginCheck($user_name,$user_password){
        $conn = DbConnect();
        //调用存储过程
        $conn->query("set @username='".$user_name."'");
        $conn->query("set @password='".$user_password."'");
        $query = "call login(@username,@password,@identity,@err);";
        $result = $conn->query($query);
        //取出返回值
        $return_values = $conn->query("select @identity as identity,@err as error");
        $array = mysqli_fetch_array($return_values);
        $conn->close();
        return $array;
    }  
    
    /**
     * 注册
     * @param type $user_name
     * @param type $user_password
     * @param type $user_email
     * @param type $user_phone
     * @param type $user_identity
     * @return type 成功返回0，否则返回错误代码
     */
    function register($user_name,$user_password,$user_email,$user_phonenumber,$user_identity){
        $conn = DbConnect();
        //初始化变量
        $conn->query("set @username='".$user_name."'");
        $conn->query("set @password='".$user_password."'");
        $conn->query("set @email='".$user_email."'");
        $conn->query("set @phone='".$user_phonenumber."'");
        $conn->query("set @identity='".$user_identity."'");
        //调用存储过程     
        $query = "call register(@username,@password,@email,@phone,@identity,@err);"; 
        $result = $conn->query($query);
        //取出返回值
        $return_values = $conn->query("select @err as error");
        $array = mysqli_fetch_array($return_values);
        $conn->close();
        return $array;
    }
    
    /**
     * 检验用户名是否存在
     * @param type $user_name
     * @return type
     */
    function isUserExist($user_name){
        $conn = DbConnect();
        $sql = "select username_existed('".$user_name."');";
        $result = $conn->query($sql);
        $return_value = mysqli_fetch_array($result);
        $conn->close();
        return $return_value;
    }
    
    /**
     * 检验邮箱是否存在
     * @param type $user_email
     * @return type
     */
    function  isEmailExist($user_email){
        $conn = DbConnect();
        $sql = "select useremail_existed('".$user_email."');";
        $result = $conn->query($sql);
        $return_value = mysqli_fetch_array($result);
        $conn->close();
        return $return_value;
    }
    
    /**
     * 检验手机号码是否存在
     * @param type $user_phonenumber
     * @return type
     */
    function  isPhoneExist($user_phonenumber){
        $conn = DbConnect();
        $sql = "select userphone_existed('".$user_phonenumber."');";
        $result = $conn->query($sql);
        $return_value = mysqli_fetch_array($result);
        $conn->close();
        return $return_value;
    }
}

