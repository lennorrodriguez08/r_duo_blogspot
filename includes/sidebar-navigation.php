<div class="sidebar">
            <div class="search-div"> <!-- SEARCH BLOG DIV -->
               <p>Search Blog</p>
               <form action="search_result.php" method="POST" autocomplete="off">
                  <input type="text" name="search_input">
                  <button type="submit" name="search_btn"><i class="fas fa-search"></i></button>
               </form>
            </div>


            <div class="most-popular">
               <p class="title">Most Popular</p>

            <?php 
            
                  $select_most_recent = "SELECT * FROM blog_post ORDER BY blog_views_count DESC LIMIT 0,5";
                  $select_most_recent_result = mysqli_query($connection, $select_most_recent);

                  while ($row = mysqli_fetch_assoc($select_most_recent_result)) {
                     $recent_image = $row['blog_image'];
                     $recent_title = $row['blog_title'];
                     $recent_date = $row['blog_date'];
                     $recent_id = $row['blog_id'];
                     ?>

                  <div class="most-popular-container">
                     <div>
                        <img src="./img/<?php echo $recent_image; ?>" alt="">
                     </div>
                     <div class="text-center">
                        <p class="popular-title"><a href="./specific_blog_post.php?blog_id=<?php echo $recent_id; ?>"><?php echo $recent_title; ?></a></p>
                        <p class="popular-date"><i class="far fa-clock"></i> <?php echo $recent_date; ?></p>
                     </div>
                  </div>

                 <?php }
            ?>

            </div>

            <div class="most-popular">
               <p class="title">Most Recent</p>

               <?php 
            
                  $select_most_popular = "SELECT * FROM blog_post ORDER BY blog_id DESC LIMIT 0,5";
                  $select_most_popular_result = mysqli_query($connection, $select_most_popular);

                  while ($row = mysqli_fetch_assoc($select_most_popular_result)) {
                     $popular_image = $row['blog_image'];
                     $popular_title = $row['blog_title'];
                     $popular_date = $row['blog_date'];
                     $popular_id = $row['blog_id'];
                     ?>

                  <div class="most-popular-container">
                     <div>
                        <img src="./img/<?php echo $popular_image; ?>" alt="">
                     </div>
                     <div class="text-center">
                        <p class="popular-title"><a href="./specific_blog_post.php?blog_id=<?php echo $popular_id; ?>"><?php echo $popular_title; ?></a></p>
                        <p class="popular-date"><i class="far fa-clock"></i> <?php echo $popular_date; ?></p>
                     </div>

                  </div>

                 <?php }
            
              ?>

            </div>


            <div class="category-div"><!-- CATEGORIES DIV -->
               <p>Categories</p>
               <ul>
                  <!-- ECHO ALL CATEGORIES -->
                  <?php 
                     $query = "SELECT * FROM blog_categories";
                     $result = mysqli_query($connection, $query);

                     while ($row = mysqli_fetch_assoc($result)) {
                        $blog_category_id = $row['blog_category_id'];
                        $blog_category = $row['blog_category'];
                  ?>
                        <li><a href="index.php?blog_category_id=<?php echo $blog_category_id; ?>"><?php echo $blog_category; ?></a></li>
                     <?php } ?>
                     
               </ul>
            </div>
         </div>
      <!-- TRANSFER BACK HERE THE DIV FROM INDEX IN CASE OF PROBLEM -->