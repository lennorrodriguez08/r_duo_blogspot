<?php 
    include "./admin_header.php";
    include "./admin_top_navigation.php";
    include "./admin_sidebar.php";
?>

<?php 

    if (isset($_POST['submit_user'])) {
        $user_firstname = clean($_POST['user_firstname']);
        $user_lastname = clean($_POST['user_lastname']);
        $user_email = clean($_POST['user_email']);
        $user_role = clean($_POST['user_role']);
        $user_image_name = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $user_username = clean($_POST['user_username']);
        $user_password = clean($_POST['user_password']);
        date_default_timezone_set("Asia/Chongqing");
        $user_registration_date = date('F d, Y – h:i A'); // RETURN A STRING VALUE

        $imageExtension = explode(".", $user_image_name);
        $finalImageExtension = strtolower(end($imageExtension));
        $allowedExtension = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($finalImageExtension, $allowedExtension)) {
            $image_unique_name = uniqid('', true) . "." . $finalImageExtension;
            $image_destination = "../img/" . $image_unique_name;
            move_uploaded_file($user_image_tmp, $image_destination);

            $query = "INSERT INTO users(user_registration_date, user_firstname, user_lastname, user_email, user_role, user_username, user_password, user_image) VALUES ('$user_registration_date', '$user_firstname', '$user_lastname', '$user_email', '$user_role', '$user_username', '$user_password', '$image_unique_name')";
            $result = mysqli_query($connection, $query);
        }   else {
            $user_image = "user.png";
            $query = "INSERT INTO users(user_registration_date, user_firstname, user_lastname, user_email, user_role, user_username, user_password, user_image) VALUES ('$user_registration_date', '$user_firstname', '$user_lastname', '$user_email', '$user_role', '$user_username', '$user_password', '$user_image')";
            $result = mysqli_query($connection, $query);
        }

        // $query = "INSERT INTO users(user_registration_date, user_firstname, user_lastname, user_email, user_role, user_username, user_password) VALUES ('$user_registration_date', '$user_firstname', '$user_lastname', '$user_email', '$user_role', '$user_username', '$user_password')";
        // $result = mysqli_query($connection, $query);
    }

?>

    <div class="form-wrapper">
        <form action="" class="new-blog-form" method="POST" autocomplete="off" enctype="multipart/form-data">
            <h1 style="font-size: 20px;">ADD NEW USER</h1>
            <div class="main-input">
                <div>
                    <label for="">First Name</label>
                    <input type="text" name="user_firstname" id="" required minlength="2">
                </div>
                <div>
                    <label for="">Last Name</label>
                    <input type="text" name="user_lastname" required minlength="2">
                </div>
                <div>
                    <label for="">Email Address</label>
                    <input type="text" name="user_email" required minlength="12">
                </div>
                <div>
                    <label for="">Profile Picture</label>
                    <input type="file" name="user_image" class="admin-user-image">
                </div>
                <div>
                    <label for="">User Role</label>
                    <select name="user_role" id="" class="select" required>
                        <option value="">Choose Role</option>
                        <option value="Administrator">Administrator</option>
                        <option value="Subscriber">Subscriber</option>
                    </select>
                </div>
                <div>
                    <label for="">Username</label>
                    <input type="text" name="user_username" required minlength="2">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="user_password" required minlength="5">
                </div>
                <input type="submit" value="Submit User" name="submit_user" class="submit-blog">
            </div>
        </form>
    </div>

<?php include "./admin_footer.php"; ?>