<?php
   
   session_start();
   if(!isset($_SESSION['user'])) header('location: login.php');

   $user =$_SESSION['user'];

   ?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Inventory Management System</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="https://kit.fontawesome.com/6f924482e7.js" crossorigin="anonymous"></script>
</head>
<body>
  <div id="dashboardMaincontainer">
    <div class="dashboard_sidebar" id="dashboard_sidebar">
      <h3 class="dashboard_logo" id="dashboard_logo">IMS</h3>
     <div class="dashboard_sidebar_user">
       <img src="images/user/pic1.jpg" alt="User image." id="userimage" />
       <span><?= $user['first_name'] . ' ' . $user['last_name'] ?></span>
     </div>
     <div class="dashboard_sidebar_menus">
       <ul class="dashboard_menu_lists">
         <li class="menuActive">
           <a href="javascript:void(0);" ><i class="fa fa-dashboard "></i> <span class="menuText">Dashboard</span></a>
         </li>
         <li>
           <a href=""><i class="fas fa-bullhorn "></i> <span class="menuText">Campaigns</span></a>
         </li>
         <li>
           <a href=""><i class="fas fa-dollar-sign "></i> <span class="menuText">Revenue Management</span></a>
         </li>
         <li>
           <a href=""><i class="fas fa-book "></i> <span class="menuText">Accounts Receivable</span></a>
         </li>
         <li>
           <a href=""><i class="fas fa-cogs "></i> <span class="menuText">Configuration</span></a>
         </li>
         <li>
           <a href=""><i class="fas fa-bell "></i> <span class="menuText">Stats</span></a>
         </li>
       </ul>
     </div>
    </div>
    <div class="dashboard_content_container" id="dashboard_content_container">
      <div class="dashboard_topnav">
        <a href=""id="togglebtn"><i class="fa fa-navicon"></i> </a>
         <a href="database/logout.php" id="logoutbtn"><i class="fa fa-power-off"></i> Log-out</a>
      </div>
      <div class="dashboard_content">
        <div class="dashboard_content_main">
          
        </div>
      </div>
    </div>
  </div>

  <script>
    var sideBarIsOpen =true;
    togglebtn.addEventListener('click' ,(event) => {
     event.preventDefault();
     if (sideBarIsOpen) {
      dashboard_sidebar.style.width ='10%';
      dashboard_sidebar.style.transition ='0.3s all';
     dashboard_content_container.style.width = '90%';
     dashboard_logo.style.fontsize = '60px';
     userimage.style.width = '60px';
     menuIcons = document.getElementsByClassName('menuText');
      for (var i =0; i < menuIcons.length; i++) {
     menuIcons[i].style.display='none';
      }
     document.getElementsByClassName('dashboard_menu_lists')[0].style.textalign = 'center';
      sideBarIsOpen =false;
     }
     else {
      dashboard_sidebar.style.width ='20%';
     dashboard_content_container.style.width = '80%';
     dashboard_logo.style.fontsize = '80px';
     userimage.style.width = '80px';
     menuIcons = document.getElementsByClassName('menuText');
      for (var i =0; i < menuIcons.length; i++) {
     menuIcons[i].style.display='inline-block';
      }
     document.getElementsByClassName('dashboard_menu_lists')[0].style.textalign = 'normal';
      sideBarIsOpen =true;
        }

      });
    </script>
</body>
</html>