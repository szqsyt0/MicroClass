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
<script type="text/javascript" src="../resources/scripts/user.js"></script>
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
                        <li><a href="../view/comment_manage.php">所有评论</a></li>                       
                    </ul>                   
                </li>
                <li> <a href="#" class="nav-top-item"> 专辑管理 </a>
                     <ul>
                        <li><a href="#">所有专辑</a></li>                       
                    </ul> 
                </li>
                <li> <a href="#" class="nav-top-item"> 分类管理</a>
                     <ul>
                        <li><a href="./category_manage.php">所有分类</a></li>                       
                    </ul> 
                </li>
                <li> <a href="#" class="nav-top-item current"> 账号设置 </a>
                    <ul>  
                        <li><a class="current" href="./admin_manage.php">所有管理员</a></li>  
                        <li><a href="./user_edit.php">个人信息</a></li> 
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
            <p id="page-intro">欢迎进入微学后台管理系统</p>
    <div class="content-box">
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3>管理员列表</h3>
        <ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">名单</a></li>
          <!-- href must be unique and match the id of target div -->
          <li><a href="#tab2">添加管理员</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <!-- This is the target div. id must match the href of this div's tab -->
          <div class="notification attention png_bg"> <a href="#" class="close"><img src="../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div> 这里是管理员列表，你可以在这里进行对管理员账户的相应操作 </div>
          </div>
          <table>
            <thead>
              <tr>
                  <th>
                  <input class="check-all" type="checkbox" />
                </th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>权限</th>               
                <th>手机号码</th>
                <th>上次登录时间</th>
                <th></th>
              </tr>
            </thead>
            <tfoot>            
              <tr>
                <td colspan="6">
                  <div class="bulk-actions align-left">
                    <select name="dropdown">                               
                      <option value="option1">批量删除</option>
                    </select>
                    <a class="button" href="#">确定</a> </div>
                  
                  <!-- End .pagination -->
                  <div class="clear"></div>
                </td>
              </tr>          
            </tfoot>
            <tbody>
                <?php
                 require '../control/user_control.php';
                 $userControl = new UserControl();
                 $current_admin = $userControl->getAdminList(1, 20);   
                 
                 $user = new User;
                    while(count($current_admin)){
                        $user = unserialize(array_pop($current_admin));
                        ?>           
               <tr>            
                <td>
                  <input type="checkbox" />
                </td>   
                <td><?php echo $user->getUserName();?></td>
                <td><a href="#" title="title"><?php echo $user->getUserEmail();?></a></td>
                <td><?php echo $user->getUserIdentity();?></td>
                <td><?php echo $user->getUserPhoneNumber();?></td>
                <td><?php echo $user->getUserLastlogin();?></td>
                <td>
                  <!-- Icons -->
                  <a href="../action/user_action.php?user_id=<?php echo $user->getUserId();?>&flag=del_user" title="删除" onclick="return confirm_del();"><img src="../resources/images/icons/cross.png" alt="删除" /></a>  </td>
              </tr>            
                        <?php
                    }
                ?>              
            </tbody>
          </table>
        </div>
        <!-- End #tab1 -->
        <div class="tab-content" id="tab2">
            <!--用于判断用户身份-->
            <input style="display: none" id="login_identity" value="<?php echo $_SESSION['user_identity'];?>"/>
            <form action="../action/register_action.php" method="post" name="add_admin" onsubmit="return prevent_form_post();">
            <fieldset>
            <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
            <p>
                <label>用户名</label>
                <input class="text-input small-input" type="text" id="user_name" name="user_name" onblur="isUserExist();"/>
                <span class="input-notification error png_bg" style="display: none" id="userexist">用户名已存在</span> 
                <span class="input-notification success png_bg" style="display: none" id="usernotexist"></span>
              <!-- Classes for input-notification: success, error, information, attention -->
              <br />             
              </p>
            <p>                
                <label>密码</label>
                <input  class="text-input small-input" type="password"  name="user_password" id="password"/>
                <span class="input-notification success png_bg" style="display: none" id="password2"></span>
              <!-- Classes for input-notification: success, error, information, attention -->
              <br />             
            </p>
            <p>
              <label>确认密码</label>
              <input  class="text-input small-input" type="password"  name="user_password2" id="password1" onblur="return isPasswordEqual();"/>
              <span class="input-notification error png_bg" style="display: none" id="errorpassword">两次输入的密码不一致</span> 
              <span class="input-notification success png_bg" style="display: none" id="rightpassword"></span>
            </p>
           
            <p>
                <label>邮箱</label>
                <input class="text-input small-input" type="email" id="user_email" name="user_email" onblur="isEmailExist();"/>
                <span class="input-notification error png_bg" style="display: none" id="emailexist">该邮箱已存在</span> 
                <span class="input-notification success png_bg" style="display: none" id="emailnotexist"></span>
              <!-- Classes for input-notification: success, error, information, attention -->
              <br />             
            </p>
            <p>
                <label>手机号码</label>
                <input class="text-input small-input" type="tel" id="user_phonenumber" name="user_phonenumber" onblur="isPhoneExist();"/>
                <span class="input-notification error png_bg" style="display: none" id="phoneexist">该手机号码已存在</span> 
                <span class="input-notification success png_bg" style="display: none" id="phonenotexist"></span>
              <!-- Classes for input-notification: success, error, information, attention -->
              <br />             
            </p>  
            <p>
              <label>权限</label>
              <select name="user_identity" id="user_identity" class="small-input">
                  <option value="admin">普通管理员</option>
                  <option value="sadmin">超级管理员</option>
              </select>
            </p>
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
      &#169; Copyright 2014 MicroClass | Powered by <a href="#">微学</a> | <a href="#">返回顶部</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
</html>
