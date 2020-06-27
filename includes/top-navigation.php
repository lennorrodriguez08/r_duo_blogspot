<!-- NAVIGATION -->
<nav>
      <div class="container">
         <div class="upper-logo">
            <a href="index.php"><img src="./img/r-duo-light-logo.png" alt=""></a>
         </div>
         <ul class="toggle-item">
            <li><a href="index.php">HOME</a</li>
            <li><a href="#">ADVERTISE</a</li>
            <li><a href="#">GUIDE</a></li>
            <li><a href="#">GET IN TOUCH</a></li>


            <?php 
            
               if (!isset($_SESSION['user_role'])) {
                  echo "<li><a href='login.php'>LOGIN</a></li>";
               }  else if ($_SESSION['user_role'] == "Subscriber" ) {
                  echo "<li class='admin-toggle'><a class='admin-toggle-target' href='#'>{$_SESSION['user_username']}&nbsp;&nbsp;<i class='fas fa-caret-down'></i></a>
                  <ul>
                     <li><a class='sub-item' href='./index.php?update_profile={$_SESSION['user_id']}'><i class='fas fa-user-cog'></i>&nbsp;&nbsp;UPDATE PROFILE</a></li>
                     <li><a class='sub-item' href='logout.php'><i class='fas fa-power-off'></i>&nbsp;&nbsp;&nbsp;LOGOUT</a></li>
                  </ul>
                  </li>";
               }  else if ($_SESSION['user_role'] == "Administrator" ) {
                  echo "<li class='admin-toggle'><a class='admin-toggle-target' href='#'>{$_SESSION['user_username']}&nbsp;<i class='fas fa-caret-down'></i></a>
                  <ul>
                     <li><a href='./admin/index.php'><i class='fas fa-user-cog'></i>&nbsp;&nbsp;ADMIN DASHBOARD</a></li>
                     <li><a href='logout.php'><i class='fas fa-power-off'></i>&nbsp;&nbsp;&nbsp;LOGOUT</a></li>
                  </ul>
                  </li>";
               }

            ?>
            <!-- <li class="admin-toggle"><a class="admin-toggle-target" href="#">RONNEL&nbsp;<i class="fas fa-caret-down"></i></a>
         
         <ul>
            <li><a href="#">ADMIN</a></li>
            <li><a href="logout.php">SIGN OUT</a></li>
         </ul>
         </li> -->

         </ul>
         <div class="toggle-icon">
            <i class="fas fa-bars"></i>
         </div>
      </div>
   </nav>
   
   

   <?php 
         // MODAL UPDATE MY PROFILE
         if (isset($_GET['update_profile'])) {
            $update_profile_user_id = $_GET['update_profile'];
            include "update_guest_modal.php";
         
         }
            
   ?>