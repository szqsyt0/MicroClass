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
<script type="text/javascript" src="../resources/scripts/category.js"></script>
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
                <li> <a href="#" class="nav-top-item current"> 分类管理</a>
                     <ul>
                         <li><a href="./category_manage.php" class="current">所有分类</a></li>                       
                    </ul> 
                </li>
                <li> <a href="#" class="nav-top-item"> 账号设置 </a>
                    <ul>  
                        <li><a href="./admin_manage.php">所有管理员</a></li>  
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
        <h3>评论列表</h3>
        <ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">所有评论</a></li>
          <!-- href must be unique and match the id of target div -->        
        </ul>
        <div class="clear"></div>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <!-- This is the target div. id must match the href of this div's tab -->
          <div class="notification attention png_bg"> <a href="#" class="close"><img src="../resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div> 这里是评论列表，在这里可以管理评论 </div>
          </div>
          <table>
            <thead>
              <tr>
                  <th>
                  <input class="check-all" type="checkbox" />
                </th>                
                <th>评论人</th> 
                <th>评论视频</th>
                <th>评论时间</th>
                <th>评论内容</th>
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
               <tr>            
                <td>
                  <input type="checkbox" />
                </td>   
                <td></td>
                <td></td>   
                <td></td>
                <td></td>
                <td>
                  <!-- Icons -->
                  <a href="../action/category_action.php?flag=del_category&category_id=<?php echo $category->get_category_id();?>" title="删除" onclick="return confirm_del();"><img src="../resources/images/icons/cross.png" alt="删除" /></a>  </td>
              </tr>                                               
            </tbody>
          </table>
        </div>
        <!-- End #tab1 -->
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
