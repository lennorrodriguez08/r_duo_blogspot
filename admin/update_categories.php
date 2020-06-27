<?php 
    include "./admin_header.php";
    include "./admin_top_navigation.php";
    include "./admin_sidebar.php";
?>

<?php 

    if (isset($_GET['delete_category_id'])) {

        if (isset($_SESSION['user_role'])) {

            if ($_SESSION['user_role'] == 'Administrator') {
                $delete_category_id = $_GET['delete_category_id'];
                $query = "DELETE FROM blog_categories WHERE blog_category_id = $delete_category_id";
                $result = mysqli_query($connection, $query);
            }

        }
        
    }

   

    if (isset($_POST['add_category_btn'])) {
        $added_category = $_POST['add_category'];

        if (empty($added_category)) {
            
        }   else {

            $query = "INSERT INTO blog_categories (blog_category) VALUES ('$added_category')";
            $result = mysqli_query($connection, $query);
            
        }

    }

?>
 
    <div class="form-wrapper">
        <form action="" class="new-blog-form" method="POST" autocomplete="off" enctype="multipart/form-data">
            <h1 style="font-size: 20px;">UPDATE CATEGORIES</h1>
            <div class="category-wrapper">
                <div>
                    <div>
                        <input type="text" placeholder="New Category .." name="add_category">
                    </div>
                    <div>
                        <input type="submit" class="update-btn btn bg-darken" value="Add Category" name="add_category_btn">
                    </div>
                    
                    <?php 
                    
                        if (isset($_GET['update_category_id'])) {
                            $update_category_id = $_GET['update_category_id'];

                            $query = "SELECT * FROM blog_categories WHERE blog_category_id = $update_category_id";
                            $result = mysqli_query($connection, $query);
            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $blog_category = $row['blog_category'];
                                $blog_category_id = $row['blog_category_id'];
                            }

                            include "update_category_form.php";
                            
                        }

                    ?>

                </div>
                <div>
                    <table border="1" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Title</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 

                            // PAGINATION

                                $category_pagination = "SELECT * FROM blog_categories";
                                $category_pagination_result = mysqli_query($connection, $category_pagination);
                                $count_category_pagination = mysqli_num_rows($category_pagination_result);
                                $category_per_page = 15;

                                $count_category_pagination = ceil($count_category_pagination / $category_per_page);

                                if (isset($_GET['category_page'])) {
                                    $category_page = $_GET['category_page'];
                                }   else {
                                    $category_page = "";
                                }

                                if ($category_page == "" || $category_page == 1) {
                                    $category_page = 0;
                                }   else {
                                    $category_page = ($category_page - 1) * $category_per_page;
                                }
                            
                                $query = "SELECT * FROM blog_categories ORDER BY blog_category_id DESC LIMIT $category_page, $category_per_page";
                                $result = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $blog_category_id = $row['blog_category_id'];
                                    $blog_category = $row['blog_category'];

                                    ?>
                                    <tr>
                                        <td><?php echo $blog_category_id; ?></td>
                                        <td><?php echo $blog_category; ?></td>
                                        <td class="td-min-60px"><a href="update_categories.php?update_category_id=<?php echo $blog_category_id; ?>" class="btn-category bg-bluish">Edit</a></td>
                                        <td class="td-min-60px"><a onclick="javascript: return confirm('Are you sure you want to delete Category <?php echo $blog_category; ?>')" href="update_categories.php?delete_category_id=<?php echo $blog_category_id; ?>" class="btn-category bg-alert">Delete</a</td>      
                                    </tr>                                 
                                <?php }
                            ?>
                            
                        </tbody>
                    </table>

                    <div class="pagination">
                <ul><b>PAGES</b>

                    <?php 
                    
                        for ($i = 1; $i <= $count_category_pagination; $i++) {

                            if ($i == $count_category_pagination) {
                                echo "<li><a href='update_categories.php?category_page=$i'><b>$i</b></a></li>";
                            }   else {
                                echo "<li><a href='update_categories.php?category_page=$i'><b>$i</b></a></li>";
                            }

                        }            

                    ?>

                </ul>
            </div>

                </div>
            </div>
            
        </form>
    </div>

<?php include "./admin_footer.php"; ?>

