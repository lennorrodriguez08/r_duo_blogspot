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

            // ECHO ALL BLOG POST ACCORDING TO THE CLICKED TITLE, IMAGE OR READ MORE BTN

            if (isset($_GET['blog_id'])) {
               $blog_id = $_GET['blog_id'];

               $query = "SELECT * FROM blog_post WHERE blog_id = $blog_id";
               $result = mysqli_query($connection, $query);

               $update = "UPDATE blog_post SET blog_views_count = blog_views_count +1 WHERE blog_id = $blog_id";

               $update_result = mysqli_query($connection, $update);

               while ($row = mysqli_fetch_assoc($result)) {
                  $blog_title = $row['blog_title'];
                  $blog_author = $row['blog_author'];
                  $blog_date = $row['blog_date'];
                  $blog_image = $row['blog_image'];
                  $blog_content = $row['blog_content'];
                  ?>

               <h1><a href="#" style="color: #2F93EB;"><?php echo $blog_title; ?></a></h1>
               <p><a href="multiple_blog_author.php?blog_author=<?php echo $blog_author; ?>"><i class="far fa-edit"></i>&nbsp;Author : <?php echo $blog_author; ?></a></p>
               <div class="main-date">
                  <p><i class="far fa-clock"></i></p>
                  <p><?php echo $blog_date; ?></p>
               </div>
               <div class="img">
                  <a href="#"><img src="./img/<?php echo $blog_image; ?>" alt=""></a>
               </div>
               <div class="content">
                  <?php echo $blog_content; ?>
               </div>

               <!-- COMMENT SECTION -->
               
               <?php }}  

                  // ECHO ALL BLOG POST WHEN GET REQUEST IS NOT SET
               else {
                  header("Location: index.php");
               }  ?>

               <!-- POSTED COMMENTS  -->
                <?php 
                
                  if (!isset($_SESSION['user_username'])) {
                     echo '
                     <div class="leave-comment">
                     <a href="login.php">
                        Login To Leave A Comment <i class="fas fa-angle-double-right"></i>
                     </a>
                     </div>
                     
                     ';
                  }

                  if (isset($_SESSION['user_username'])) {
                     echo "
                     <form action='' class='comment-form' method='POST'>
                    
                    
                    
                    <div>
                        <label for=''>Post Your Comment</label>
                        <textarea name='comment_content'></textarea>
                        
                        
                    
                    </div>
                    <div>
                        <input type='submit' name='submit_comment' value='Submit Comment' class='comment-submit-btn'>
                    </div>
                    </form>

                    
                     
                     ";
                     // <div class='title-comments' style='display: flex; align-items: center; margin-top: 20px; margin-bottom: 20px; font-weight: bold; color: #666; font-size: 20px;'><i class='far fa-comment-dots' style='color: green; font-size: 30px;'></i>&nbsp;&nbsp;<p>Comments</p></div>
                     // <label for=''>Post Your Comment</label>
                     //    <textarea name='comment_content' id='body'></textarea>
                     //    <script>CKEDITOR.replace('body');</script>
                     
                  }
                
                ?> 
                     <!-- OBSERVE -->
                     <?php 
                     
                        $select_comments = "SELECT * FROM blog_comments WHERE comment_in_response = '$blog_id' AND comment_status = 'Approved'";
                        $select_comments_result = mysqli_query($connection, $select_comments);
                        $count_select_comments = mysqli_num_rows($select_comments_result);
                     
                     ?>

                     <div class="title-comments" style="display: flex; align-items: center; margin-top: 20px; margin-bottom: 10px; font-weight: bold; color: #666; font-size: 20px;"><i class="far fa-comment-dots" style="color: green; font-size: 30px;"></i>&nbsp;&nbsp;<p> <?php echo $count_select_comments; ?> Comments</p></div>
               <?php 
               

                    if (isset($_GET['blog_id'])) {


                    $query = "SELECT * FROM blog_comments WHERE comment_in_response = $blog_id AND comment_status = 'Approved' ORDER BY comment_id DESC";
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $output_comment_author = $row['comment_author'];
                        $output_comment_date = $row['comment_date'];
                        $output_comment_content = $row['comment_content'];
                        $output_comment_author_img = $row['comment_author_img'];
                        ?>

                        <div class="posted-comments">
                            <div>
                                <div class="comment-info">
                                    <div>
                                        <img src="./img/<?php echo $output_comment_author_img ?>" alt="">
                                    </div>
                                    <div>
                                        <p><?php echo $output_comment_author; ?></p>
                                        <p><?php echo $output_comment_date; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <?php echo $output_comment_content; ?>
                            </div>
                            <!-- <form action="" class="heart-react">
                                <button type="submit"><i class="fas fa-heart"></i></button>
                            </form> -->
                            <hr class="comment-hr">
                    </div>
                        <?php }}

                    ?>

         </div>
         <!-- SIDEBAR NAVIGATION -->
         <?php include "./includes/sidebar-navigation.php"; ?>
      </div> <!-- TRANSFER THIS SPECIFIC DIV TO SIDEBAR-NAVIGATION IN CASE OF PROBLEM -->
      <div class="scroll-to-top">
      <a href="#"><i class="fas fa-chevron-up"></i></a>
   </div>
   </div>
<?php include "./includes/footer.php"; ?>
   
<?php 
    // POST A COMMENT
    if (isset($_POST['submit_comment'])) {
        $comment_blog_id = $_GET['blog_id'];
        $comment_author = $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname'];
        $comment_email = $_SESSION['user_email'];
        $comment_content = $_POST['comment_content'];
        date_default_timezone_set("Asia/Chongqing");
        $comment_date = date('M d, Y – h:i A'); // OBSERVE
        $comment_author_img = $_SESSION['user_image'];
        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

            $query = "INSERT INTO blog_comments (comment_author, comment_email, comment_content, comment_status, comment_in_response, comment_date, comment_author_img) VALUES ('$comment_author', '$comment_email', '$comment_content', 'Unapproved', '$comment_blog_id', '$comment_date', '$comment_author_img')";
            
            $result = mysqli_query($connection, $query);

            // $add_comment_count = "UPDATE blog_post SET blog_comments_count = blog_comments_count + 1 WHERE blog_id = $comment_blog_id";
            // $add_comment_count_result = mysqli_query($connection, $add_comment_count);
        }

    }

?>

