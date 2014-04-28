<?php

require '../db_connect.php';
require '../model/user.php';
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
        $query = "call login(@username,@password,@id,@identity,@err);";
        $result = $conn->query($query);
        //取出返回值
        $return_values = $conn->query("select @identity as identity,@id as id,@err as error");
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
    
    /**
     * 获取管理员列表
     */
    function getAdminList($page_num,$list_num){
        $conn = DbConnect();
        //初始化变量
        $conn->query("set @pagenum='".$page_num."'");
        $conn->query("set @listnum='".$list_num."'");
        $sql = "call show_admins(@pagenum,@listnum,@err);";
        $result = $conn->query($sql);
        $return_values = array();
        while($row = mysqli_fetch_array($result)){
            $user = new User();
            $user->setUserName($row['user_name']);
            $user->setUserEmail($row['user_email']);
            $user->setUserIdentity($row['user_identity']);
            $user->setUserPhoneNumber($row['user_phonenumber']);
            $user->setUserLastLogin($row['user_lastlogin']);
            $user->setUserId($row['user_id']);
            array_push($return_values, serialize($user));
        }
        $conn->close();
        return $return_values;
    }
     
    /**
     * 删除管理员账号
     * @param type $user_id
     * @return type
     */
    function delUser($user_id){
        $conn = DbConnect();
        //初始化变量
        $conn->query("set @userid='".$user_id."'");
        $sql = "call delete_user(@userid,@err);";
        $result = $conn->query($sql);
        $result = $conn->query("select @err as error");
        $return_values = mysqli_fetch_array($result);
        return $return_values;
    }
    
    /**
     * 获取用户全部信息
     * @param type $user_id
     */
    function getUserInfo($user_id){
         $conn = DbConnect();
        //初始化变量
        $conn->query("set @userid='".$user_id."'");
        $sql = "call get_user_info(@userid,@err);";
        $result = $conn->query($sql);
        $error = $conn->query("select @err;");
        if($error!==0){
            echo "修改失败，请稍后再试";
            header("#");//跳转到错误页面
        }
        $return_values = mysqli_fetch_array($result);
        return $return_values;
    }
    
    function updateUserInfo($user_id,$user_password,$user_email,$user_phonenumber,$user_identity){
        $conn = DbConnect();
        //初始化变量
        $conn->query("set @userid='".$user_id."'");
        $conn->query("set @password='".$user_password."'");
        $conn->query("set @email='".$user_email."'");
        $conn->query("set @phone='".$user_phonenumber."'");
        $conn->query("set @identity='".$user_identity."'");
        
        $query = "call change_userinfo(@userid,@password,@email,@phone,@identity,@err);"; 
        $result = $conn->query($query);        
        //取出返回值
        $return_values = $conn->query("select @err as error");
        $array = mysqli_fetch_array($return_values);         
        $conn->close();
        return $array;
    }
}

