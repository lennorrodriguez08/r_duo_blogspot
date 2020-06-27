<?php 
    include "./admin_header.php";
    include "./admin_top_navigation.php";
    include "./admin_sidebar.php";
?>
<?php 
    if (isset($_GET['delete_comment'])) {
        $the_blog_id = $_GET['the_blog_id'];
        $delete_comment_id = $_GET['delete_comment'];
        $query = "DELETE FROM blog_comments WHERE comment_id = $delete_comment_id";
        $result = mysqli_query($connection, $query);

        $query1 = "UPDATE blog_post SET blog_comments_count = blog_comments_count - 1 WHERE blog_id = $the_blog_id";
        $result1 = mysqli_query($connection, $query1);
    }   

    if (isset($_POST['select_apply_action'])) {
        $bulk_select_value = $_POST['bulk_select_value'];
        $check_box_array = $_POST['checkbox'];
        
        foreach($check_box_array as $check_box_id) {

            if ($bulk_select_value == "Administrator") {
                $query = "UPDATE users SET user_role = '$bulk_select_value' WHERE user_id = $check_box_id";
                $result = mysqli_query($connection, $query);
            }   else if ($bulk_select_value == "Subscriber") {
                $query = "UPDATE users SET user_role = '$bulk_select_value' WHERE user_id = $check_box_id";
                $result = mysqli_query($connection, $query);
            }   else if ($bulk_select_value == "Delete") {
                $query = "DELETE FROM users WHERE user_id = $check_box_id";
                $result = mysqli_query($connection, $query);
            }   else {
                header("Location: view_all_users.php");
            } 
        }
    }

?>
    <div class="form-wrapper">
        <form action="" method="POST">
            <h1 style="font-size: 20px;">VIEW ALL USERS</h1>
            <div class="select-div">
                <select name="bulk_select_value" id="" class="bulk-select" title="To Do Multiple Action Such As Bulk Deletion And Bulk Changing Role">
                    <option value="">Select Action</option>
                    <option value="Administrator">Change To Admin</option>
                    <option value="Subscriber">Change To Subscriber</option>
                    <option value="Delete">Delete User/s</option>
                </select>
                <button type="submit" class="select-action" name="select_apply_action">Apply Action</button>
            </div>
            <table cellpadding="0" cellspacing="0" role="presentation" border="1" class="mn-w-1100">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="select-all-checkbox"></th>
                        <th>Id</th>
                        <th>Img</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Registration Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php 

                    // PAGINATION
                    $all_users_query = "SELECT * FROM users";
                    $all_users_result = mysqli_query($connection, $all_users_query);
                    $count_all_users = mysqli_num_rows($all_users_result);
                    $users_per_page = 15;
                    $count_all_users = ceil($count_all_users / $users_per_page);

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    }   else {
                        $page = "";
                    }

                    if ($page == "" || $page == 1) {
                        $current_page = 0;
                    }   else {
                        $current_page = ($page - 1) * $users_per_page;
                    }

                    // EXTRACT ALL DATA FROM BLOG POST
                    $query = "SELECT * FROM users ORDER BY user_id DESC LIMIT $current_page, $users_per_page";
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $user_username = $row['user_username'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                        $user_role = $row['user_role'];
                        $user_image = $row['user_image'];
                        $user_registration_date = substr($row['user_registration_date'],0,16) . "..";
                        $user_registration_date_not_substr = $row['user_registration_date'];
                        echo "
                        <tr>
                        <td><input type='checkbox' class='checkbox' name='checkbox[]' value='$user_id'></td>
                        <td>$user_id</td>
                        <td class='td-img'><img src='../img/$user_image'></td>
                        <td>$user_username</td>
                        <td>$user_firstname</td>
                        <td>$user_lastname</td>
                        <td>$user_email</td>
                        <td>$user_role</td>
                        <td title='$user_registration_date_not_substr'>$user_registration_date</td>
                        <td><a class='btn bg-bluish td-min-60px' href='edit_user.php?user_id=$user_id'>Edit</a></td>
                    </tr>
                    ";
                 } ?>

                </tbody>
            </table>
            <div class="pagination">

                <ul><b>PAGES</b>

                <?php 
                
                    for ($i = 1; $i <= $count_all_users; $i++) {

                        if ($i == $count_all_users) {
                            echo "<li><a href='view_all_users.php?page=$i'><b>$i</b></a></li>";
                        }   else {
                            echo "<li><a href='view_all_users.php?page=$i'><b>$i</b></a></li>";
                        }

                    }
                
                ?>

                </ul>
            </div>
        </form>
    </div>

<?php include "./admin_footer.php"; ?>