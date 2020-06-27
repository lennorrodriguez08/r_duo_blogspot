<?php 
    include "./admin_header.php";
    include "./admin_top_navigation.php";
    include "./admin_sidebar.php";
?>
<?php 
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];        

        $delete_with_comments = "DELETE FROM blog_comments WHERE comment_in_response = $delete_id";
        $delete_result = mysqli_query($connection, $delete_with_comments);

        $query = "DELETE FROM blog_post WHERE blog_id = $delete_id";
        $result = mysqli_query($connection, $query);
        header("Location: view_all_blog.php");
    }   

    if (isset($_POST['select_apply_action'])) {
        $bulk_select_value = $_POST['bulk_select_value'];
        $check_box_array = $_POST['checkbox'];
        
        foreach($check_box_array as $check_box_id) {

            if ($bulk_select_value == "Published") {
                $query = "UPDATE blog_post SET blog_status = '$bulk_select_value' WHERE blog_id = $check_box_id";
                $result = mysqli_query($connection, $query);
            }   else if ($bulk_select_value == "Draft") {
                $query = "UPDATE blog_post SET blog_status = '$bulk_select_value' WHERE blog_id = $check_box_id";
                $result = mysqli_query($connection, $query);
            }   else if ($bulk_select_value == "Delete") {
                $query = "DELETE FROM blog_post WHERE blog_id = $check_box_id";
                $result = mysqli_query($connection, $query);
            }   else if ($bulk_select_value == "Clone") {
                $query = "SELECT * FROM blog_post WHERE blog_id = $check_box_id";
                $result = mysqli_query($connection, $query);
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $clone_blog_date = date('F d Y');
                    $clone_blog_title = $row['blog_title'];
                    $clone_blog_author = $row['blog_author'];
                    $clone_blog_category_id = $row['blog_category_id'];
                    $clone_blog_status = $row['blog_status'];
                    $clone_blog_image = $row['blog_image'];
                    $clone_blog_tags = $row['blog_tags'];
                    $clone_blog_content = $row['blog_content'];
                }

                $query = "INSERT INTO blog_post(blog_date, blog_title, blog_author, blog_category_id, blog_status, blog_image, blog_tags, blog_content) VALUES ('$clone_blog_date', '$clone_blog_title', '$clone_blog_author', $clone_blog_category_id, '$clone_blog_status', '$clone_blog_image', '$clone_blog_tags', '$clone_blog_content')";
                $result = mysqli_query($connection, $query);

            }   else {
                header("Location: view_all_blog.php");
            }
        }
    }
?>
    <div class="form-wrapper">
        <form action="" method="POST">
            <h1 style="font-size: 20px;">VIEW ALL BLOG POST</h1>
            <div class="select-div">
                <select name="bulk_select_value" id="" class="bulk-select" title="To Do Multiple Action Such As Bulk Deletion, Bulk Changing Status And Bulk Cloning Of Blogs">
                    <option value="">Select Action</option>
                    <option value="Published">Publish</option>
                    <option value="Draft">Draft</option>
                    <option value="Delete">Delete</option>
                    <option value="Clone">Clone</option>
                </select>
                <button onclick="javascript: return confirm('Are you sure to this action?')" type="submit" class="select-action" name="select_apply_action">Apply Action</button>
            </div>
            <table cellpadding="0" cellspacing="0" role="presentation" border="1" class="mn-w-1100">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="select-all-checkbox"></th>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Views</th>
                        <th>Comments</th>
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                
                    // PAGINATION
                    $query_pagination = "SELECT * FROM blog_post";
                    $result_pagination = mysqli_query($connection, $query_pagination);
                    $count_all_blogs = mysqli_num_rows($result_pagination);
                    $blogs_per_page = 15;
                    $count_all_blogs = ceil($count_all_blogs / $blogs_per_page);

                    if (isset($_GET['current_page'])) {
                        $current_page = $_GET['current_page'];
                    }   else {
                        $current_page = "";
                    }

                    if ($current_page == "" || $current_page == 1) { // OBSERVE
                        $current_page = 0;
                    }   else {
                        $current_page = ($current_page - 1) * $blogs_per_page;
                    }

                    // EXTRACT ALL DATA FROM BLOG POST
                    $query = "SELECT * FROM blog_post ORDER BY blog_id DESC LIMIT $current_page, $blogs_per_page";
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $blog_id = $row['blog_id'];
                        $blog_author = $row['blog_author'];
                        $blog_title = $row['blog_title'];
                        $blog_category_id = $row['blog_category_id'];
                        $blog_status = $row['blog_status'];
                        $blog_image = $row['blog_image'];
                        $blog_tags = $row['blog_tags'];
                        $blog_comments_count = $row['blog_comments_count'];
                        $blog_date = $row['blog_date'];
                        $blog_views_count = $row['blog_views_count'];

                        ?>

                    <tr>
                        <td><input type="checkbox" class="checkbox" name="checkbox[]" value="<?php echo $blog_id; ?>"></td>
                        <td><?php echo $blog_id ?></td>
                        <td title="<?php echo $blog_date ?>"><?php echo substr($blog_date, 0,6); ?></td>
                        <td title="<?php echo $blog_title ?>"><?php echo substr($blog_title, 0,15) . ".."; ?></td>
                        <td title="<?php echo $blog_author ?>"><?php echo substr($blog_author, 0,15) . ".."; ?></td>
                        <td><?php echo $blog_category_id ?></td>
                        <td><?php echo $blog_status ?></td>
                        <td class="td-img"><img src="../img/<?php echo $blog_image; ?>" alt=""></td>
                        <td title="<?php echo $blog_tags ?>"><?php echo substr($blog_tags, 0,10) . ".."; ?></td>
                        <td><?php echo $blog_views_count ?></td>
                        <td><?php echo $blog_comments_count ?></td>
                        <td class="td-min-80px"><a href="../specific_blog_post.php?blog_id=<?php echo $blog_id; ?>" class="btn bg-darken">View Post</a></td>
                        <td class="td-min-60px"><a href="edit_blog_post.php?edit_blog_post=<?php echo $blog_id; ?>" class="btn bg-bluish">Edit</a></td>
                        <td class="td-min-60px"><a onClick="javascript: return confirm('Are you sure you want to delete <?php echo $blog_title; ?>?')" href="view_all_blog.php?delete=<?php echo $blog_id; ?>" class="btn bg-alert">Delete</a></td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>
            <div class="pagination">
                <ul><b>PAGES</b>
                    <?php 
                    
                        for ($i = 1; $i <= $count_all_blogs; $i++) {
                            
                            if ($i == $count_all_blogs) {
                                echo "<li><a href='view_all_blog.php?current_page=$i'><b>$i</b></a></li>";
                            }   else {
                                echo "<li><a href='view_all_blog.php?current_page=$i'><b>$i</b></a></li>";
                            }
                        }   
                    
                    ?>
                </ul>
            </div>
        </form>
    </div>

<?php include "./admin_footer.php"; ?>