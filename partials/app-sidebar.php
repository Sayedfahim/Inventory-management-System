
    <div class="dashboard_sidebar" id="dashboard_sidebar">
      <h3 class="dashboard_logo" id="dashboard_logo">SMS</h3>
     <div class="dashboard_sidebar_user">
       <img src="images/user/pic1.jpg" alt="User image." id="userimage" />
       <span><?= $user['first_name'] . ' ' . $user['last_name'] ?></span>
     </div>
     <div class="dashboard_sidebar_menus">
       <ul class="dashboard_menu_lists">
        <!--class="menuActive"-->
         <li>
           <a href="./dashboard.php" ><i class="fa fa-dashboard "></i> <span class="menuText">Dashboard</span></a>
         </li>
         <li>
           <a href="./users-add.php"><i class="fa fa-user-plus"></i> <span class="menuText">Add Customer</span></a>
         </li>
         <li>
           <a href="./products.php"><i class="fa fa-list-alt"></i> <span class="menuText">Products</span></a>
         </li>
         
         
         <li>
           <a href="./product-in.php"><i class="fa fa-plus-circle"></i> <span class="menuText">Product In</span></a>
         </li>
         <li>
           <a href="./product-out.php"><i class="fa fa-minus-circle"></i> <span class="menuText">Product Out</span></a>
         </li>
         <li>
           <a href="./sales.php"><i class="fa fa-share-square"></i> <span class="menuText">Sales</span></a>
         </li>
         <li>
           <a href="./supplier.php"><i class="fa fa-bandcamp"></i> <span class="menuText">Supplier</span></a>
         </li>
         
       </ul>
     </div>
    </div>