<?php
    require '../control/user_control.php';
    $user_id = trim($_REQUEST['user_id']);
    $flag = trim($_REQUEST['flag']);
    
    echo $flag."\t".$user_id;
    if($flag=='del_user'){
        $userControl = new UserControl();
        $result = $userControl->delUser($user_id);
        echo "hehe";
        if($result['error']==0){
            echo "caca";
            header("Location:../view/admin_manage.php");
        }else{
            echo "删除失败，请返回重试。</br>";
            echo "<a href='../view/admin_manage'>返回</a>";
        }
    }


