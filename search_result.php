<?php
   // HEADER
   include "./includes/header.php";
   // TOP NAVIGATION
   include "./includes/top-navigation.php";

   if (isset($_POST['search_btn'])) {
      $search_input = $_POST['search_input'];
      
   }  else {
      $search_input = "";
   }

   $query_result = "SELECT * FROM blog_post WHERE blog_title LIKE '%$search_input%' AND blog_status = 'Published'";
   $search_query_result = mysqli_query($connection, $query_result);
   $count_search_query = mysqli_num_rows($search_query_result);
   
   $search_message = "";
   if ($count_search_query == 0) {
      $search_message = "No Results Found ...";
   }  else {
      $search_message = "";
   }

?>

   <!-- POST -->
   <div class="container">
      <div class="main">
         <div class="main-post">
            <?php echo "<h1 class='search-message'>$search_message</h1>"; ?>
         <?php 

            if (isset($_POST['search_btn'])) {
                $search_input = $_POST['search_input'];

                $query = "SELECT * FROM blog_post WHERE blog_title LIKE '%$search_input%' AND blog_status = 'Published' ORDER BY blog_id DESC LIMIT 0,15";
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
            <?php }} 
            
         ?>

         </div>
         <!-- SIDEBAR NAVIGATION -->
         <?php include "./includes/sidebar-navigation.php"; ?>
      </div> <!-- TRANSFER THIS SPECIFIC DIV TO SIDEBAR-NAVIGATION IN CASE OF PROBLEM -->
   </div>
   
<?php 

// if (isset($_GET['update_profile'])) {
//    $update_profile_user_id = $_GET['update_profile'];
//    include "update_guest_modal.php";

// }
include "./includes/footer.php"; 

?>