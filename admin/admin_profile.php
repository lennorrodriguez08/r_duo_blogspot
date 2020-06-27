<?php 
    include "./admin_header.php";
    include "./admin_top_navigation.php";
    include "./admin_sidebar.php";
?>

<?php 

    $query = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $admin_user_firstname = $row['user_firstname'];
        $admin_user_lastname = $row['user_lastname'];
        $admin_user_email = $row['user_email'];
        $admin_user_role = $row['user_role'];
        $admin_user_username = $row['user_username'];
        $admin_user_password = $row['user_password'];
        $admin_user_image = $row['user_image'];
        $admin_user_registration_date_1 = $row['user_registration_date'];
    }

?>

<?php 

    if (isset($_POST['update_admin_profile'])) {
        $admin_user_firstname = clean($_POST['user_firstname']);
        $admin_user_lastname = clean($_POST['user_lastname']);
        $admin_user_email = clean($_POST['user_email']);
        $admin_user_role = clean($_POST['user_role']);
        $admin_user_new_image = $_FILES['user_image']['name'];
        $admin_user_image_tmp_name = $_FILES['user_image']['tmp_name'];
        $admin_user_username = clean($_POST['user_username']);
        $admin_user_password = clean($_POST['user_password']);
        date_default_timezone_set("Asia/Chongqing");
        $admin_user_registration_date = "Updated " . date('F d, Y – h:i A'); // RETURN A STRING VALUE

        $imageExtension = explode(".", $admin_user_new_image); 
        $finalImageExtension = strtolower(end($imageExtension));
        $allowedExtension = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($finalImageExtension, $allowedExtension)) {

            $admin_user_image_unique_name = uniqid('', true) . "." . $finalImageExtension;
            $imageDestination = "../img/" . $admin_user_image_unique_name;
            move_uploaded_file($admin_user_image_tmp_name, $imageDestination);

        $update_user_profile = "UPDATE users SET user_firstname = '$admin_user_firstname', user_lastname = '$admin_user_lastname', user_email = '$admin_user_email', user_image = '$admin_user_image_unique_name', user_role = '$admin_user_role', user_username = '$admin_user_username', user_password = '$admin_user_password', user_registration_date = '$admin_user_registration_date $admin_user_registration_date_1' WHERE user_id = {$_SESSION['user_id']}";
        $update_result = mysqli_query($connection, $update_user_profile);

        $query = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";

        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $admin_user_image = $row['user_image'];
        }

        }   else {

            $update_user_profile = "UPDATE users SET user_firstname = '$admin_user_firstname', user_lastname = '$admin_user_lastname', user_email = '$admin_user_email', user_image = '$admin_user_image', user_role = '$admin_user_role', user_username = '$admin_user_username', user_password = '$admin_user_password', user_registration_date = '$admin_user_registration_date $admin_user_registration_date_1' WHERE user_id = {$_SESSION['user_id']}";
            $update_result = mysqli_query($connection, $update_user_profile);
        }
    }

?>

    <div class="form-wrapper">
        <form action="" class="new-blog-form" method="POST" autocomplete="off" enctype="multipart/form-data">
            <h1 style="font-size: 20px;">UPDATE ADMIN PROFILE</h1>
            <div class="main-input">
                <div>
                    <label for="">First Name</label>
                    <input type="text" name="user_firstname" id="" required minlength="2" value="<?php echo $admin_user_firstname; ?>">
                </div>
                <div>
                    <label for="">Last Name</label>
                    <input type="text" name="user_lastname" required minlength="2" value="<?php echo $admin_user_lastname; ?>">
                </div>
                <div>
                    <label for="">Email Address</label>
                    <input type="text" name="user_email" required minlength="12" value="<?php echo $admin_user_email; ?>">
                </div>
                <div>
                    <label for="">Profile Picture</label>
                    <img src="../img/<?php echo $admin_user_image; ?>" alt="" width="100px" height="100px">
                    <input type="file" name="user_image" class="admin-user-image">
                </div>
                <div>
                    <label for="">User Role</label>
                    <select name="user_role" id="" class="select">
                        <option value="Administrator">Administrator</option>
                        <option value="Subscriber">Subscriber</option>
                    </select>
                </div>
                <div>
                    <label for="">Username</label>
                    <input type="text" name="user_username" required minlength="2" value="<?php echo $admin_user_username; ?>">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="user_password" required minlength="5" value="<?php echo $admin_user_password; ?>">
                </div>
                <input type="submit" value="Update Profile" name="update_admin_profile" class="submit-blog">
            </div>
        </form>
    </div>

<?php include "./admin_footer.php"; ?>