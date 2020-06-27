<div class="echo-update"> <!-- TO BE INCLUDE -->
    <div>
        <?php 

            if ($_SESSION['user_role'] !== "Administrator") {
                header("Location: ../index.php");
            }
        
        if (isset($_POST['update_btn'])) {
            $blog_category = $_POST['new_blog_category'];
            $query = "UPDATE blog_categories SET blog_category = '$blog_category' WHERE blog_category_id = $update_category_id";
            $result = mysqli_query($connection, $query);
            
        }
        
        ?>
        <input type="text" placeholder="Update Category .." name="new_blog_category" value="<?php echo $blog_category; ?>">
    </div>
    <div>
        <input type="submit" class="update-btn btn bg-darken" value="Update Category" name="update_btn">
    </div>
</div>