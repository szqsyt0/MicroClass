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
<script type="text/javascript" src="../resources/support.js"></script>
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
     header("Location:./login.php");
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
              <div id="profile-links"> 欢迎, <a href="#" title="Edit your profile"><?php echo $_SESSION['user_name'];?></a><br />
                <br />
                <a href="#" title="View the Site">前往首页</a> | <a href="../logout.php" title="Sign Out">退出</a> </div>
              <ul id="main-nav">
                <!-- Accordion Menu -->
                <li> <a href="#" class="nav-top-item">
                  <!-- Add the class "current" to current menu item -->
                  视频管理 </a>
                    <ul>
                        <li><a href="../admin.php">视频列表</a></li>                       
                    </ul>
                </li>
                <li> <a href="#" class="nav-top-item"> 评论管理 </a>
                    <ul>
                        <li><a href="#">评论列表</a></li>                       
                    </ul>                   
                </li>
                <li> <a href="#" class="nav-top-item"> 专辑管理 </a>
                     <ul>
                        <li><a href="#">专辑列表</a></li>                       
                    </ul> 
                </li>
                <li> <a href="#" class="nav-top-item"> 用户管理</a>
                     <ul>
                        <li><a href="#">用户列表</a></li>                       
                    </ul> 
                </li>
                <li> <a href="#" class="nav-top-item current"> 账号设置 </a>
                    <ul>
                        <li><a class="current" href="./admin_manage.php">设置</a></li>                       
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
              <div> 您的浏览器不支持Javascript，请使用其他浏览器打开</div>
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
                <th>名称</th>
                <th>专辑</th>
                <th>类别</th>               
                <th>简介</th>
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
                  <div class="pagination"> <a href="#" title="First Page">&laquo; 首页</a><a href="#" title="Previous">&laquo; 上一页</a> <a href="#" class="number" title="1">1</a> <a href="#" class="number" title="2">2</a> <a href="#" class="number current" title="3">3</a> <a href="#" class="number" title="4">4</a> <a href="#" title="Next Page">下一页 &raquo;</a><a href="#" title="Last Page">尾页 &raquo;</a> </div>
                  <!-- End .pagination -->
                  <div class="clear"></div>
                </td>
              </tr>
            </tfoot>
            <tbody>
                <?php
                    for($i=0;$i<20;$i++){
                        ?>
                            <tr>
                <td>
                  <input type="checkbox" />
                </td>
                <td>Lorem ipsum dolor</td>
                <td><a href="#" title="title">Sit amet</a></td>
                <td>Consectetur adipiscing</td>
                <td>Donec tortor diam</td>
                <td>
                  <!-- Icons -->
                  <a href="#" title="Edit"><img src="../resources/images/icons/pencil.png" alt="Edit" /></a> <a href="#" title="Delete"><img src="../resources/images/icons/cross.png" alt="Delete" /></a> <a href="#" title="Edit Meta"><img src="../resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a> </td>
              </tr>
                        <?php
                    }
                ?>
              
            </tbody>
          </table>
        </div>
        <!-- End #tab1 -->
        <div class="tab-content" id="tab2">
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
                <span class="input-notification"><!--添加标题要求--></span>
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
<!-- Download From www.exet.tk-->
</html>
