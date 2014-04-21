<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
        <!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
        <link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
        <!--                       Javascripts                       -->
        <!-- jQuery -->
        <script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
        <!-- jQuery Configuration -->
        <script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
        <!-- Facebox jQuery Plugin -->
        <script type="text/javascript" src="resources/scripts/facebox.js"></script>
        <!-- jQuery WYSIWYG Plugin -->
        <script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
        <!-- jQuery Datepicker Plugin -->
        <script src="http://code.jquery.com/jquery-1.11.0.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script> 
    </head>
    <body>
        <div id="sidebar">
            <div id="sidebar-wrapper">
              <!-- Sidebar with logo and menu -->
              <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
              <!-- Logo (221px wide) -->
              <a href="#"><img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" /></a>
              <!-- Sidebar Profile links -->
              <div id="profile-links"> 欢迎, <a href="#" title="Edit your profile">admin name</a><br />
                <br />
                <a href="#" title="View the Site">前往首页</a> | <a href="logout.php" title="Sign Out">退出</a> </div>
              <ul id="main-nav">
                <!-- Accordion Menu -->
                <li> <a href="#" class="nav-top-item no-submenu">
                  <!-- Add the class "no-submenu" to menu items with no sub menu -->
                  仪表盘 </a> </li>
                <li> <a href="#" class="nav-top-item current">
                  <!-- Add the class "current" to current menu item -->
                  视频管理 </a>

                </li>
                <li> <a href="#" class="nav-top-item"> 评论管理 </a>
                    <!-- 评论管理-->
                </li>
                <li> <a href="#" class="nav-top-item"> 专辑管理 </a>

                </li>
                <li> <a href="#" class="nav-top-item"> 用户管理</a>

                </li>
                <li> <a href="#" class="nav-top-item"> 账号设置 </a>

                </li>
              </ul>
              <!-- End #main-nav -->
            </div>
        </div>
    </body>
</html>
