<?php 
    include "./admin_header.php";
    include "./admin_top_navigation.php";
    include "./admin_sidebar.php";
?>

<?php 
    if (isset($_POST['submit_blog'])) {
        $blog_title = clean($_POST['blog_title']);
        $blog_category_id = $_POST['blog_category_id'];
        $blog_author = clean($_POST['blog_author']);
        $blog_status = clean($_POST['blog_status']);
        $blog_image = $_FILES['blog_image']['name'];
        $blog_image_tmp_name = $_FILES['blog_image']['tmp_name'];
        $blog_image_size = $_FILES['blog_image']['size'];
        $blog_image_error = $_FILES['blog_image']['error'];
        $blog_tags = clean($_POST['blog_tags']);
        $blog_content = clean($_POST['blog_content']);
        date_default_timezone_set("Asia/Chongqing");
        $blog_date = date('M d, Y – h:i A'); // RETURN A STRING VALUE

        $actualImageExtension = explode('.', $blog_image);
        $actualImageFinalExtension = strtolower(end($actualImageExtension));
        $allowedExtensionFile = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($actualImageFinalExtension, $allowedExtensionFile)) {
            
            // unique id first parameter will depends to you .. 
            $new_image_name = uniqid($blog_image, true) . '.' . $actualImageFinalExtension;
            $image_destination = "../img/" . $new_image_name;
            move_uploaded_file($blog_image_tmp_name, $image_destination);
        }   

        $query = "INSERT INTO blog_post(blog_date, blog_title, blog_category_id, blog_author, blog_status, blog_image, blog_tags, blog_content) VALUES ('$blog_date', '$blog_title', $blog_category_id, '$blog_author', '$blog_status', '$new_image_name', '$blog_tags', '$blog_content')";
        $result = mysqli_query($connection, $query);
    }
?>

    <div class="form-wrapper">
        <form action="add_new_blog.php" class="new-blog-form" method="POST" autocomplete="off" enctype="multipart/form-data">
            <h1 style="font-size: 20px;">ADD NEW BLOG POST</h1>
            <div class="main-input">
                <div>
                    <label for="">Blog Title</label>
                    <input type="text" name="blog_title" id="" required minlength="5">
                </div>
                <div>
                    <label for="">Blog Category</label>
                    <select name="blog_category_id" id="" class="select" required>
                        <option value="">Choose Category</option>
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
                    <input type="text" name="blog_author" required minlength="5">
                </div>
                <div>
                    <label for="">Blog Status</label>
                    <select name="blog_status" id="" class="select">
                        <option value="Published">Publish</option>
                        <option value="Draft">Draft</option>
                    </select>
                </div>
                <div>
                    <label for="">Blog Image</label>
                    <input type="file" name="blog_image" class="image-input" required>
                </div>
                <div>
                    <label for="">Blog Keyword | Tags</label>
                    <input type="text" name="blog_tags" required>
                </div>
                <div>
                    <label for="">Blog Content</label>
                    <textarea name="blog_content" class="textarea" minlength="100"></textarea>
                    <!-- <script>
                        CKEDITOR.replace ( 'body' );
                    </script> -->
                </div>
                <input type="submit" value="Publish Post" name="submit_blog" class="submit-blog">
            </div>
        </form>
    </div>

<?php include "./admin_footer.php"; ?>
