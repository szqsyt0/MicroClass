<?php
    require '../control/user_control.php';
    $user_id = trim($_REQUEST['user_id']);
    $flag = trim($_REQUEST['flag']);
    
    if($flag=='del_user'){
        $userControl = new UserControl();
        $result = $userControl->delUser($user_id);
        
        if($result['error']==0){
            
            header("Location:../view/admin_manage.php");
        }else{
            echo "删除失败，请返回重试。</br>";
            echo "<a href='../view/admin_manage'>返回</a>";
        }
        die();
    }
    else if(($flag = trim($_POST['flag']) == "edit_user")){
        
        session_start();
        //获取用户原来的信息
        $user_id = trim($_POST['user_id']);
        $old_password = md5(trim($_POST['old_password']));
        $old_email = $_SESSION['user_email'];
        $old_phonenumber = $_SESSION['user_phonenumber'];
        
        //获取要更新的信息        
        $user_password = md5(trim($_POST['user_password']));
        $user_email = trim($_POST['user_email']);
        $user_phonenumber = trim($_POST['user_phonenumber']);        
        
        //判断密码，邮箱，手机号码是否需要更新
        if($old_password == $user_password||$user_password==""){
            $user_password = NULL;
        }
        if($old_email == $user_email){
            $user_email = NULL;
        }
        if($old_phonenumber == $user_phonenumber){
            $user_phonenumber = NULL;
        }
        //实例化用户控制类
        $userControl = new UserControl();
        $result = $userControl->updateUserInfo($user_id, $user_password, $user_email, $user_phonenumber, $user_identity);
        
        //判断是否修改成功，成功则返回，否则跳转到错误页
        if($result['error'] == 0){
            header("Location:../view/admin_manage.php");
        }
        else{
            echo $old_email."<br/>";
            echo $old_password."<br/>";
            echo $old_phonenumber."<br/>";
            echo $user_password."<br/>";
            echo $user_email."<br/>";
            echo $user_phonenumber."<br/>";
            echo $user_identity."<br/>";
            echo "修改信息失败"; //应该跳转到错误页
            die();
        }
    }


