<?php
   // HEADER
   include "./includes/header.php";
   // TOP NAVIGATION
   include "./includes/top-navigation.php";
?>

   <!-- POST -->
   <div class="container">
      <div class="main">
         <div class="main-post">

         <?php 

            // ECHO ALL BLOG POST ACCORDING TO ALL THE AUTHOR'S POST NO MATTER IF ITS MANY OR NOT

            if (isset($_GET['blog_author'])) {
               $blog_author = $_GET['blog_author'];

               $query = "SELECT * FROM blog_post WHERE blog_author = '$blog_author' LIMIT 0,15";
               $result = mysqli_query($connection, $query);
               // $count_blogs = mysqli_num_rows($result);

               // $by_page = 15;
               // $count_blogs = ceil($count_blogs / $by_page);

               // echo "<h1>$count_blogs</h1>";

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
               
                  // ECHO ALL BLOG POST WHEN REQUEST IS NOT SET
               else {
                  header("Location: index.php");
               }  ?>

         </div>
         <!-- SIDEBAR NAVIGATION -->
         <?php include "./includes/sidebar-navigation.php"; ?>
      </div> <!-- TRANSFER THIS SPECIFIC DIV TO SIDEBAR-NAVIGATION IN CASE OF PROBLEM -->
      <div class="scroll-to-top">
      <a href="#"><i class="fas fa-chevron-up"></i></a>
   </div>
   </div>
<?php include "./includes/footer.php"; ?>
   