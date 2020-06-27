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

    if (isset($_GET['approve_comment'])) {
        $approve_comment = $_GET['approve_comment'];

        $query = "UPDATE blog_comments SET comment_status = 'Approved' WHERE comment_id = $approve_comment";
        $result = mysqli_query($connection, $query);
    }

    if (isset($_GET['unapprove_comment'])) {
        $unapprove_comment = $_GET['unapprove_comment'];

        $query = "UPDATE blog_comments SET comment_status = 'Unapproved' WHERE comment_id = $unapprove_comment";
        $result = mysqli_query($connection, $query);
    }

    if (isset($_POST['select_apply_action'])) {
        $bulk_select_value = $_POST['bulk_select_value'];
        $check_box_array = $_POST['checkbox'];
        
        foreach($check_box_array as $check_box_id) {

            if ($bulk_select_value == "Approved") {
                $query = "UPDATE blog_comments SET comment_status = '$bulk_select_value' WHERE comment_id = $check_box_id";
                $result = mysqli_query($connection, $query);
            }   else if ($bulk_select_value == "Unapproved") {
                $query = "UPDATE blog_comments SET comment_status = '$bulk_select_value' WHERE comment_id = $check_box_id";
                $result = mysqli_query($connection, $query);
            }   else if ($bulk_select_value == "Delete") {
                $query = "DELETE FROM blog_comments WHERE comment_id = $check_box_id";
                $result = mysqli_query($connection, $query);
            }   else {
                header("Location: view_all_comments.php");
            } 
        }
    }

?>
    <div class="form-wrapper">
        <form action="" method="POST">
            <h1 style="font-size: 20px;">VIEW ALL COMMENTS</h1>
            <div class="select-div">
                <select name="bulk_select_value" id="" class="bulk-select" title="To Do Multiple Action Such As Bulk Deletion And Bulk Changing Status">
                    <option value="">Select Action</option>
                    <option value="Approved">Approve</option>
                    <option value="Unapproved">Unapprove</option>
                    <option value="Delete">Delete</option>
                </select>
                <button type="submit" class="select-action" name="select_apply_action">Apply Action</button>
            </div>
            <table cellpadding="0" cellspacing="0" role="presentation" border="1" class="mn-w-1100">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="select-all-checkbox"></th>
                        <th>Id</th>
                        <th colspan="2">Author</th>
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>In Response To</th>
                        <th>Date</th>
                        <th>Approve</th>
                        <th>Unapprove</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php 


                    $select_all_comment_query = "SELECT * FROM blog_comments";
                    $select_all_comment_query_result = mysqli_query($connection, $select_all_comment_query);
                    $count_all_comment = mysqli_num_rows($select_all_comment_query_result);
                    $comments_per_page = 15;
                    $count_all_comment = ceil($count_all_comment / $comments_per_page);

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    }   else {
                        $page = "";
                    }

                    if ($page == "" || $page == 1) {
                        $current_page = 0;
                    }   else {
                        $current_page = ($page - 1) * $comments_per_page;
                    }


                    // EXTRACT ALL DATA FROM BLOG POST
                    $query = "SELECT * FROM blog_comments ORDER BY comment_id DESC LIMIT $current_page, $comments_per_page";
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $comment_id = $row['comment_id'];
                        $comment_author = substr($row['comment_author'], 0,10) . "..";
                        $comment_author_not_substr = $row['comment_author'];
                        $comment_content = substr($row['comment_content'], 0,38) . "..";
                        $comment_content_not_substr = $row['comment_content'];
                        $comment_email = $row['comment_email'];
                        $comment_status = $row['comment_status'];
                        $comment_in_response = $row['comment_in_response'];
                        $comment_date = substr($row['comment_date'], 0,6) . "..";
                        $comment_date_not_substr = $row['comment_date'];
                        $comment_author_img = $row['comment_author_img'];
                        
                        echo "
                        <tr>
                        <td><input type='checkbox' class='checkbox' name='checkbox[]' value='$comment_id'></td>
                        <td>$comment_id</td>
                        <td class='td-img'><img src='../img/$comment_author_img' alt=''></td>
                        <td title='$comment_author_not_substr'>$comment_author</td>
                        <td title='$comment_content_not_substr'>$comment_content</td>
                        <td>$comment_email</td>
                        <td>$comment_status</td>";

                        $query1 = "SELECT * FROM blog_post WHERE blog_id = $comment_in_response";
                        $result1 = mysqli_query($connection, $query1);

                        while ($row = mysqli_fetch_assoc($result1)) {
                            $in_response_to = substr($row['blog_title'], 0,14) . "..";
                            $in_response_to_not_substr = $row['blog_title'];
                            $in_response_to_id = $row['blog_id'];

                            echo "<td title='$in_response_to_not_substr'><a class='link-indicator-title' href='../specific_blog_post.php?blog_id=$in_response_to_id'>$in_response_to</a></td>";
                        }

                        echo "
                        <td title='$comment_date_not_substr'>$comment_date</td>
                        <td><a class='btn bg-darken td-min-60px' href='view_all_comments.php?approve_comment=$comment_id'>Approve</a></td>
                        <td><a class='btn bg-bluish td-min-60px' href='view_all_comments.php?unapprove_comment=$comment_id'>Unpprove</a></td>
                        <td class='td-min-60px'><a onClick=\"javascript: return confirm('Are you sure you want to delete Comment No. $comment_id?')\" href='view_all_comments.php?delete_comment=$comment_id&the_blog_id=$in_response_to_id' class='btn bg-alert'>Delete</a></td>
                    </tr>
                    ";
                 } ?>

                </tbody>
            </table>
            <div class="pagination">

                 <ul><b>PAGES</b>

                    <?php 
                    
                        for ($i = 1; $i <= $count_all_comment; $i++) {

                            if ($i == $count_all_comment) {
                                echo "<li><a href='view_all_comments.php?page=$i'><b>$i</b></li>";
                            }   else {
                                echo "<li><a href='view_all_comments.php?page=$i'><b>$i</b></li>";
                            }

                        }
                    
                    ?>
                 
                 </ul>

            </div>
        </form>
    </div>

<?php include "./admin_footer.php"; ?>
