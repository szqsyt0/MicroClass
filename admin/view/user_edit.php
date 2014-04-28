<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MicroClass Admin</title>
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="../resources/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="../resources/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="../resources/css/invalid.css" type="text/css" media="screen" />
<!--                       Javascripts                       -->
<!-- jQuery -->
<script type="text/javascript" src="../resources/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="../resources/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="../resources/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="../resources/scripts/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="../resources/user.js"></script>
<!-- jQuery Datepicker Plugin -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script> 

</head>
<body>
<div id="body-wrapper">
  <!-- Wrapper for the radial gradient background -->
 <?php
 session_start();
 if(empty($_SESSION['user_name'])){
     header("Location:../login.php");
     die();
 }
 require '../control/user_control.php';
 //实例化用户控制类
    $userControl = new UserControl();
    $user_info = $userControl->getUserInfo($_SESSION['user_id']);
    $_SESSION['user_phonenumber'] = $user_info['user_phonenumber'];
    $_SESSION['user_email'] = $user_info['user_email'];
 ?>
  
  <div id="sidebar">
      
            <div id="sidebar-wrapper">
              <!-- Sidebar with logo and menu -->
              <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
              <!-- Logo (221px wide) -->
              <a href="#"><img id="logo" src="../resources/images/logo.png" alt="Simpla Admin logo" /></a>
              <!-- Sidebar Profile links -->
              <div id="profile-links"> 欢迎, <a href="../view/user_edit.php" title="Edit your profile"><?php echo $_SESSION['user_name'];?></a><br />
                <br />
                <a href="#" title="View the Site">前往首页</a> | <a href="../logout.php" title="Sign Out">退出</a> </div>
              <ul id="main-nav">
                <!-- Accordion Menu -->
                <li> <a href="#" class="nav-top-item">
                  <!-- Add the class "current" to current menu item -->
                  视频管理 </a>
                    <ul>
                        <li><a href="../admin.php">所有视频</a></li>                       
                    </ul>
                </li>
                <li> <a href="#" class="nav-top-item"> 图片管理 </a>
                    <ul>
                        <li><a href="#">所有图片</a></li>                       
                    </ul>                   
                </li>
                <li> <a href="#" class="nav-top-item"> 评论管理 </a>
                    <ul>
                        <li><a href="#">所有评论</a></li>                       
                    </ul>                   
                </li>
                <li> <a href="#" class="nav-top-item"> 专辑管理 </a>
                     <ul>
                        <li><a href="#">所有专辑</a></li>                       
                    </ul> 
                </li>
                <li> <a href="#" class="nav-top-item"> 分类管理</a>
                     <ul>
                        <li><a href="#">所有分类</a></li>                       
                    </ul> 
                </li>
                <li> <a href="#" class="nav-top-item current"> 账号设置 </a>
                    <ul>
                        <li><a href="./admin_manage.php">所有管理员</a></li>  
                        <li><a class="current" href="./user_edit.php">个人信息</a></li> 
                    </ul>
                </li>
              </ul>
              <!-- End #main-nav -->
            </div>
        </div>
  <!-- End #sidebar -->
  <div id="main-content">
    <!-- Main Content Section with everything -->
    <noscript>
            <!-- Show a notification if the user has disabled javascript -->
            <div class="notification error png_bg">
              <div> 您的浏览器不支持Javascript，请使用其他浏览器打开 </div>
            </div>
            </noscript>
            <!-- Page Head -->
            <h2>后台管理</h2>            
            <p id="page-intro">欢迎进入微课网后台管理页面</p>
<!--            <ul class="shortcut-buttons-set">
              <li><a class="shortcut-button" href="#"><span> <img src="../resources/images/icons/image_add_48.png" alt="icon" /><br />
                上传视频 </span></a></li>
            </ul>-->
            <!-- End .shortcut-buttons-set -->
            <div class="clear"></div>
            <!-- End .clear -->
    <div class="content-box">
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3>个人信息</h3>       
        <div class="clear"></div>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab2">
            <!--用于判断用户身份-->
            <input style="display: none" id="login_identity" value="<?php echo $_SESSION['user_identity'];?>"/>
            <input style="display: none" id="login_password" value="<?php echo $_SESSION['user_password'];?>"/>
            <form action="../action/user_action.php" method="post" name="add_admin" onsubmit="return can_change_userinfo();">
            <fieldset>
            <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
            <p style="display: none">
                <label>ID</label>
                <input class="text-input small-input" type="text" name="user_id" value="<?php echo $_SESSION['user_id'];?>" readonly="readonly"/>
                <input class="text-input small-input" type="text" name="flag" value="edit_user"/><!--要进行的动作-->
              <br />             
            </p>
            <p>
                <label>用户名</label>
                <input class="text-input small-input" type="text" id="user_name" name="user_name" value="<?php echo $_SESSION['user_name'];?>" readonly="readonly"/> <input id="show_changepassword" class="button" type="button" value="修改密码" onclick="show_changepasswd();"/>                            
              <br />             
              </p>
            <p id="old_passwd" style="display: none;">                
                <label>旧密码</label>
                <input class="text-input small-input" type="password"  name="old_password" id="old_password" onblur="check_oldpassword();"/>
                <span class="input-notification success png_bg" style="display: none" id="old_password_true" ></span>
                <span class="input-notification error png_bg" style="display: none" id="old_password_false">密码错误</span>
              <!-- Classes for input-notification: success, error, information, attention -->
              <br />             
            </p>
            <p id="passwd" style="display: none;">                
                <label>新密码</label>
                <input class="text-input small-input" type="password"  name="user_password" id="password"/>
                <span class="input-notification success png_bg" style="display: none" id="password2" ></span>
              <!-- Classes for input-notification: success, error, information, attention -->
              <br />             
            </p>
            <p id="passwd1" style="display: none;">
              <label>确认密码</label>
              <input class="text-input small-input" type="password"  name="user_password2" id="password1" onblur="return isPasswordEqual();" />
              <span class="input-notification error png_bg" style="display: none" id="errorpassword">两次输入的密码不一致</span> 
              <span class="input-notification success png_bg" style="display: none" id="rightpassword"></span>
            </p>
           
            <p>
                <label>邮箱</label>
                <input class="text-input small-input" type="email" id="user_email" name="user_email" value="<?php echo $user_info['user_email'];?>" onclick="if(this.value==='<?php echo $user_info['user_email'];?>'){this.value='';}" onblur="if(this.value==='') {this.value='<?php echo $user_info['user_email'];?>';}else if(this.value!=='<?php echo $user_info['user_email'];?>'){isEmailExist();}"/>
                <span class="input-notification error png_bg" style="display: none" id="emailexist">该邮箱已存在</span> 
                <span class="input-notification success png_bg" style="display: none" id="emailnotexist"></span>
              <!-- Classes for input-notification: success, error, information, attention -->
              <br />             
            </p>
            <p>
                <label>手机号码</label>
                <input class="text-input small-input" type="tel" id="user_phonenumber" name="user_phonenumber" value="<?php echo $user_info['user_phonenumber'];?>" onclick="if(this.value==='<?php echo $user_info['user_phonenumber'];?>'){this.value='';}" onblur="if(this.value==='') {this.value='<?php echo $user_info['user_phonenumber'];?>';}else if(this.value!=='<?php echo ['user_phonenumber'];?>'){isPhoneExist();}"/>
                <span class="input-notification error png_bg" style="display: none" id="phoneexist">该手机号码已存在</span> 
                <span class="input-notification success png_bg" style="display: none" id="phonenotexist"></span>
              <!-- Classes for input-notification: success, error, information, attention -->
              <br />             
            </p> 
            <?php                
                if($_REQUEST['login_identity']=="sadmin"){
                    ?>
                    <p>
                    <label>权限</label>
                    <select name="user_identity" id="user_identity" class="small-input">
                        <option value="admin">普通管理员</option>
                        <option value="sadmin">超级管理员</option>
                    </select>
                    </p>
               <?php }                                    
               ?>
            <p>
                <input class="button" type="submit" value="Submit"/>
            </p>
            </fieldset>
            <div class="clear"></div>
            <!-- End .clear -->
          </form>
        </div>
        <!-- End #tab2 -->
      </div>
      <!-- End .content-box-content -->
    </div>
    <div id="footer"> <small>
      <!-- Remove this notice or replace it with whatever you want -->
      &#169; Copyright 2014 MicroClass | Powered by <a href="#">admin templates</a> | <a href="#">返回顶部</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
</html>
