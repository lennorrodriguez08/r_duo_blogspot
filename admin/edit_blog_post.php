<?php 
    include "./admin_header.php";
    include "./admin_top_navigation.php";
    include "./admin_sidebar.php";
?>

<?php 

// ECHO ALL THE DATA FROM SPECIFIC ROW
if (isset($_GET['edit_blog_post'])) {
    $edit_blog_id = $_GET['edit_blog_post'];
    
    $query = "SELECT * FROM blog_post WHERE blog_id = $edit_blog_id";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $blog_title = $row['blog_title'];
        $blog_category_id = $row['blog_category_id'];
        $blog_author = $row['blog_author'];
        $blog_status = $row['blog_status'];
        $edit_blog_image = $row['blog_image'];
        $blog_tags = $row['blog_tags'];
        $blog_content = $row['blog_content'];
    }
    }   else {
        header("Location: index.php");
}
    

if (isset($_POST['edit_blog'])) {
    $edit_blog_image = $_FILES['blog_image']['name'];

    if (empty($edit_blog_image)) {

        $query = "SELECT * FROM blog_post WHERE blog_id = $edit_blog_id";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $edit_blog_image = $row['blog_image'];
        }

        $edit_blog_title = $_POST['blog_title'];
        $edit_blog_category_id = $_POST['blog_category_id'];
        $edit_blog_author = $_POST['blog_author'];
        $edit_blog_status = $_POST['blog_status'];
        $edit_blog_tags = $_POST['blog_tags'];
        $edit_blog_content = $_POST['blog_content'];
    
        $query = "UPDATE blog_post SET blog_title = '$edit_blog_title', blog_category_id = $edit_blog_category_id, blog_author = '$edit_blog_author', blog_status = '$edit_blog_status', blog_image = '$edit_blog_image', blog_content = '$edit_blog_content', blog_tags = '$edit_blog_tags' WHERE blog_id = $edit_blog_id";

        $result = mysqli_query($connection, $query);

        checkQuery($result);

        $query = "SELECT * FROM blog_post WHERE blog_id = $edit_blog_id";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $blog_image = $row['blog_image'];
            $blog_title = $row['blog_title'];
            $blog_category_id = $row['blog_category_id'];
            $blog_author = $row['blog_author'];
            $blog_status = $row['blog_status'];
            $blog_tags = $row['blog_tags'];
            $blog_content = $row['blog_content'];
        }
    
    }  else {
            $edit_blog_image = $_FILES['blog_image']['name'];
            $edit_blog_title = $_POST['blog_title'];
            $edit_blog_category_id = $_POST['blog_category_id'];
            $edit_blog_author = $_POST['blog_author'];
            $edit_blog_status = $_POST['blog_status'];
            $edit_blog_image_tmp_name = $_FILES['blog_image']['tmp_name'];
            $edit_blog_tags = $_POST['blog_tags'];
            $edit_blog_content = $_POST['blog_content'];
            
            $actualImageExtension = explode('.', $edit_blog_image);
            $actualImageFinalExtension = strtolower(end($actualImageExtension));
            $allowedExtensionFile = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($actualImageFinalExtension, $allowedExtensionFile)) {
                $new_image_name = uniqid($edit_blog_image, true) . "." . $actualImageFinalExtension;
                $image_destination = "../img/" . $new_image_name;
                move_uploaded_file($edit_blog_image_tmp_name, $image_destination);

                $query = "UPDATE blog_post SET blog_title = '$edit_blog_title', blog_category_id = $edit_blog_category_id, blog_author = '$edit_blog_author', blog_status = '$edit_blog_status', blog_image = '$new_image_name', blog_content = '$edit_blog_content', blog_tags = '$edit_blog_tags' WHERE blog_id = $edit_blog_id";
                $result = mysqli_query($connection, $query);
                checkQuery($result);
            }  

                $query = "SELECT * FROM blog_post WHERE blog_id = $edit_blog_id";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $edit_blog_image = $row['blog_image'];
                    $blog_title = $row['blog_title'];
                    $blog_category_id = $row['blog_category_id'];
                    $blog_author = $row['blog_author'];
                    $blog_status = $row['blog_status'];
                    $blog_tags = $row['blog_tags'];
                    $blog_content = $row['blog_content'];
                }
    }    
}

?>
 
    <div class="form-wrapper">
        <form action="" class="new-blog-form" method="POST" autocomplete="off" enctype="multipart/form-data">
            <h1 style="font-size: 20px;">EDIT BLOG POST</h1>
            <div class="main-input">
                <div>
                    <label for="">Blog Title</label>
                    <input type="text" name="blog_title" id="" required minlength="5" value="<?php echo $blog_title; ?>">
                </div>
                <div>
                    <label for="">Blog Category</label>
                    <select name="blog_category_id" id="" class="select" required value="">

                        <?php 
                        
                            $query = "SELECT * FROM blog_categories WHERE blog_category_id = $blog_category_id";
                            $result = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                $actual_blog_category_id = $row['blog_category_id'];
                                $actual_blog_category = $row['blog_category'];

                                ?>

                                <option value="<?php echo $actual_blog_category_id; ?>"><?php echo $actual_blog_category; ?></option> <!-- TO CHECK FOR CATEGORY ID -->

                            <?php }
                        ?>

                        <?php 
                    
                        $query = "SELECT * FROM blog_categories";
                        $result = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $blog_category_id = $row['blog_category_id'];
                            $blog_category = $row['blog_category'];

                            ?>

                            <option value="<?php echo $blog_category_id; ?>"><?php echo $blog_category; ?></option>

                        <?php  } ?>

                    </select>
                </div>
                <div>
                    <label for="">Author Full Name</label>
                    <input type="text" name="blog_author" required minlength="5" value="<?php echo $blog_author; ?>">
                </div>
                <div>
                    <label for="">Blog Status</label>
                    <select name="blog_status" id="" class="select">
                        <option value="<?php echo $blog_status; ?>"><?php echo $blog_status; ?></option> <!-- TO CHECK -->

                        <?php 
                        
                            if ($blog_status == "Published") {
                                echo "<option value='Draft'>Draft</option>";
                            }   else {
                                echo "<option value='Published'>Publish</option>";
                            }
                        
                        ?>

                    </select>
                </div>
                <div>
                    <label for="">Blog Image</label>
                    <img src="../img/<?php echo $edit_blog_image; ?>" alt="" class="edit-img">
                    <input type="file" name="blog_image" class="image-input" value="<?php echo $edit_blog_image; ?>">
                </div>
                <div>
                    <label for="">Blog Keyword | Tags</label>
                    <input type="text" name="blog_tags" required value="<?php echo $blog_tags; ?>">
                </div>
                <div>
                    <label for="">Blog Content</label>
                    <textarea name="blog_content" id="body" class="textarea" minlength="100"><?php echo $blog_content; ?></textarea>
                </div>
                <input type="submit" value="Update Post" name="edit_blog" class="submit-blog">
            </div>
        </form>
    </div>

<?php include "./admin_footer.php"; ?>