<?php 
    include "./admin_header.php";
    include "./admin_top_navigation.php";
    include "./admin_sidebar.php";
?>

<?php 

$query  = "SELECT * FROM users WHERE user_id = {$_GET['user_id']}";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_image = $row['user_image'];
        $user_registration_date_old = $row['user_registration_date'];
    }

    if (isset($_GET['user_id'])) {
        $target_edit_user = $_GET['user_id'];
    }

?>

<?php 

    if (isset($_POST['update_user'])) {
        $user_firstname = clean($_POST['user_firstname']);
        $user_lastname = clean($_POST['user_lastname']);
        $user_email = clean($_POST['user_email']);
        $user_role = clean($_POST['user_role']);
        $user_username = clean($_POST['user_username']);
        $user_password = clean($_POST['user_password']);
        $user_image_name = $_FILES['user_image']['name'];
        $user_image_tmp_name = $_FILES['user_image']['tmp_name'];
        date_default_timezone_set("Asia/Chongqing");
        $user_registration_date = "Updated " . date('F d, Y – h:i A'); // RETURN A STRING VALUE
        
        $imageExtension = explode(".", $user_image_name);
        $actualImageExtension = strtolower(end($imageExtension));
        $allowedExtension = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($actualImageExtension, $allowedExtension)) {
            $image_unique_name = uniqid('', true) . "." . $actualImageExtension;
            $imageDestination = "../img/" . $image_unique_name;
            move_uploaded_file($user_image_tmp_name, $imageDestination);

            $query1 = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email', user_role = '$user_role', user_username = '$user_username', user_password = '$user_password', user_registration_date = '$user_registration_date $user_registration_date_old', user_image = '$image_unique_name' WHERE user_id = '$target_edit_user'";
            $result1 = mysqli_query($connection, $query1);

            $query  = "SELECT * FROM users WHERE user_id = {$_GET['user_id']}";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $user_image = $row['user_image'];
            }


        }   else {
            $query1 = "UPDATE users SET user_firstname = '$user_firstname', user_lastname = '$user_lastname', user_email = '$user_email', user_role = '$user_role', user_username = '$user_username', user_password = '$user_password', user_registration_date = '$user_registration_date $user_registration_date_old', user_image = '$user_image' WHERE user_id = '$target_edit_user'";
            $result1 = mysqli_query($connection, $query1);

            $query  = "SELECT * FROM users WHERE user_id = {$_GET['user_id']}";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $user_image = $row['user_image'];
            }
            
        }

        

        if (!$result) {
            die("QUERY FAILED" . mysqli_error($connection) . mysqli_error_list($connection));
        }
    }

?>

    <div class="form-wrapper">
        <form action="" class="new-blog-form" method="POST" autocomplete="off" enctype="multipart/form-data">
            <h1 style="font-size: 20px;">EDIT USER</h1>
            <div class="main-input">
                <div>
                    <label for="">First Name</label>
                    <input type="text" name="user_firstname" id="" required minlength="2" value="<?php echo $user_firstname; ?>">
                </div>
                <div>
                    <label for="">Last Name</label>
                    <input type="text" name="user_lastname" required minlength="2" value="<?php echo $user_lastname; ?>">
                </div>
                <div>
                    <label for="">Email Address</label>
                    <input type="text" name="user_email" required minlength="12" value="<?php echo $user_email; ?>">
                </div>
                <div>
                    <label for="">Profile Picture</label>
                    <img src="../img/<?php echo $user_image; ?>" alt="" width="100px" height="100px">
                    <input type="file" name="user_image" class="admin-user-image">
                </div>
                <div>
                    <label for="">User Role</label>
                    <select name="user_role" id="" class="select">

                        <?php 
                        
                            if ($user_role == "Administrator") {
                                echo "
                                <option value='$user_role'>$user_role</option>
                                <option value='Subscriber'>Subscriber</option>";
                            }   else {
                                echo "
                                <option value='$user_role'>$user_role</option>
                                <option value='Administrator'>Administrator</option>";
                            }
                        
                        ?>
                        
                    </select>
                </div>
                <div>
                    <label for="">Username</label>
                    <input type="text" name="user_username" required minlength="2" value="<?php echo $user_username; ?>">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="user_password" required minlength="5" value="<?php echo $user_password; ?>">
                </div>
                <input type="submit" value="Update User" name="update_user" class="submit-blog">
            </div>
        </form>
    </div>

<?php include "./admin_footer.php"; ?>