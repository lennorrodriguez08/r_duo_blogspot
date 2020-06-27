<?php
   // HEADER
   include "./includes/header.php";
   // TOP NAVIGATION
   include "./includes/top-navigation.php";

   $published_blogs_query = "SELECT * FROM blog_post WHERE blog_status = 'Published'";
   $published_blogs_result = mysqli_query($connection, $published_blogs_query);
   $count_published_blogs = mysqli_num_rows($published_blogs_result);

   $published_blogs_per_page = 15;
   $count_published_blogs = ceil($count_published_blogs / $published_blogs_per_page);

   if (isset($_GET['page'])) {
      $page = $_GET['page'];
   }  else {
      $page = "";
   }

   if ($page == "" || $page == 1) {
      $current_page = 0;
   }  else {
      $current_page = ($page - 1) * $published_blogs_per_page;
   }

?>

   <!-- POST -->
   <div class="container">
      <div class="main">
         <div class="main-post">

         <?php 

            // ECHO ALL BLOG POST ACCORDING TO THE SEARCH 

             

               // ECHO ALL BLOG POST ACCORDING TO ALL THE AUTHOR'S POST NO MATTER IF ITS MANY OR NOT
               
               if (isset($_GET['blog_category_id'])) {
                  $blog_category_id = $_GET['blog_category_id'];
   
                  $query = "SELECT * FROM blog_post WHERE blog_category_id = $blog_category_id AND blog_status = 'Published' ORDER BY blog_id DESC";
                  $result = mysqli_query($connection, $query);
   
                  while ($row = mysqli_fetch_assoc($result)) {
                  $blog_id = $row['blog_id'];
                  $blog_title = $row['blog_title'];
                  $blog_author = $row['blog_author'];
                  $blog_date = $row['blog_date'];
                  $blog_image = $row['blog_image'];
                  $blog_content = $row['blog_content'];
                  ?>
      
                  <h1><a href="specific_blog_post.php?blog_id=<?php echo $blog_id; ?>" style="color: #2F93EB;"><?php echo $blog_title; ?></a></h1>
                  <p><a href="multiple_blog_author.php?blog_author=<?php echo $blog_author; ?>"><i class="far fa-edit"></i>&nbsp;Author : <?php echo $blog_author; ?></a></p>
                  <div class="main-date">
                     <p><i class="far fa-clock"></i></p>
                     <p><?php echo $blog_date; ?></p>
                  </div>
                  <div class="img">
                     <a href="specific_blog_post.php?blog_id=<?php echo $blog_id; ?>"><img src="./img/<?php echo $blog_image; ?>" alt=""></a>
                  </div>
                  <div class="content">
                     <?php echo substr($blog_content, 0,400); ?>
                  </div>
                  <div class="read-more">
                     <a href="specific_blog_post.php?blog_id=<?php echo $blog_id; ?>">Read More</a>
                     <i class="fas fa-angle-double-right"></i>
                  </div>
                  <hr>
                  <?php } }

                  // ECHO ALL BLOG POST WHEN SEARCH IS NOT SET 
               else {
               $query = "SELECT * FROM blog_post WHERE blog_status = 'Published' ORDER BY blog_id DESC LIMIT $current_page, $published_blogs_per_page ";
               $result = mysqli_query($connection, $query);
   
               while ($row = mysqli_fetch_assoc($result)) {
                  $blog_id = $row['blog_id'];
                  $blog_title = $row['blog_title'];
                  $blog_author = $row['blog_author'];
                  $blog_date = $row['blog_date'];
                  $blog_image = $row['blog_image'];
                  $blog_content = $row['blog_content'];
                  ?>
   
               <h1><a href="specific_blog_post.php?blog_id=<?php echo $blog_id; ?>" style="color: #2F93EB;"><?php echo $blog_title; ?></a></h1>
               <p><a href="multiple_blog_author.php?blog_author=<?php echo $blog_author; ?>"><i class="far fa-edit"></i>&nbsp;Author : <?php echo $blog_author; ?></a></p>
               <div class="main-date">
                  <p><i class="far fa-clock"></i></p>
                  <p><?php echo $blog_date; ?></p>
               </div>
               <div class="img">
               <a href="specific_blog_post.php?blog_id=<?php echo $blog_id; ?>"><img src="./img/<?php echo $blog_image; ?>" alt=""></a>
               </div>
               <div class="content">
                  <?php echo substr($blog_content, 0,400); ?>
               </div>
               <div class="read-more">
                  <a href="specific_blog_post.php?blog_id=<?php echo $blog_id; ?>">Read More</a>
                  <i class="fas fa-angle-double-right"></i>
               </div>
               <hr>
               <?php }}  ?>
               

               <div class="pagination" style="padding-bottom: 20px;"><b>PAGES</b>
                  <ul style="display: inline-block;">
                     
                     <?php 
                     
                        for ($i = 1; $i <= $count_published_blogs; $i++) {

                           if ($i == $count_published_blogs) {
                              echo "<li><a href='index.php?page=$i'><b>$i</b></a></li>";
                           }  else {
                              echo "<li><a href='index.php?page=$i'><b>$i</b></a></li>";
                           }

                        }
                     
                     ?>

                  </ul>
               </div>


         </div>
         <!-- SIDEBAR NAVIGATION -->
         <?php include "./includes/sidebar-navigation.php"; ?>
      </div> <!-- TRANSFER THIS SPECIFIC DIV TO SIDEBAR-NAVIGATION IN CASE OF PROBLEM -->
   </div>
   <div class="scroll-to-top">
      <a href="#"><i class="fas fa-chevron-up"></i></a>
   </div>
<?php 

// if (isset($_GET['update_profile'])) {
//    $update_profile_user_id = $_GET['update_profile'];
//    include "update_guest_modal.php";

// }
include "./includes/footer.php"; 

?>