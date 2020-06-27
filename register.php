<?php 
    include "./includes/header.php";

    if (isset($_SESSION['user_username'])) {
        header("Location: index.php");
    }

    $username_error = "";
    $email_error = "";
    $register_success = "";

    $query_salt = "SELECT random_salt FROM users";
    $query_salt_result = mysqli_query($connection, $query_salt);
    $row = mysqli_fetch_assoc($query_salt_result);
    $salt = $row['random_salt'];
    

    if (isset($_POST['register_account'])) {
        $reg_firstname = $_POST['reg_firstname'];
        $reg_lastname = $_POST['reg_lastname'];
        $reg_email = $_POST['reg_email'];
        $reg_username = $_POST['reg_username'];
        // $reg_password = password_hash($_POST['reg_password'], PASSWORD_DEFAULT); // THIS IS MOST RECOMMENDE BUT WE JUST USE CRYPT FOR DEHASHING OR DECRYPTING ..
        $reg_password = $_POST['reg_password'];
        $reg_password = crypt($reg_password, $salt);
        date_default_timezone_set("Asia/Chongqing");
        $reg_date = "Created " . date('M d, Y – h:i A');
        $reg_img = "user.png";

        $find_username_query = "SELECT * FROM users WHERE user_username = '$reg_username'";
        $find_username_query_result = mysqli_query($connection, $find_username_query);
        $count_username_query = mysqli_num_rows($find_username_query_result);

        $find_email_query = "SELECT * FROM users WHERE user_email = '$reg_email'";
        $find_email_query_result = mysqli_query($connection, $find_email_query);
        $count_email_query = mysqli_num_rows($find_email_query_result);

        if ($count_username_query == 0) {
            
            if ($count_email_query == 0) {
                $query = "INSERT INTO users (user_registration_date, user_username, user_password, user_firstname, user_lastname, user_email, user_role, user_image) VALUES ('$reg_date', '$reg_username', '$reg_password', '$reg_firstname', '$reg_lastname', '$reg_email', 'Subscriber', '$reg_img')";
                 $result = mysqli_query($connection, $query);
                 $register_success = "Registration Successful";
            }   else {
                 $email_error = "Email Address Unavailable";
                }

        }   else {
                 $username_error = "Username Unavailable";
            }
    }
?>
<div class="login-container">
    <div class="login-logo">
        <img src="./img/r-duo-light-logo.png" alt="">
    </div>
    <div>
        <p>Create An Account</p>
    </div>
    <div class="login-container-form">
        <form action="" method="POST">
            <div>
                <p class="register-success"><?php echo $register_success; ?></p>
                <label for="">First Name</label>
                <input type="text" name="reg_firstname" required minlength="2">
            </div>
            <div>
                <label for="">Last Name</label>
                <input type="text" name="reg_lastname" required minlength="2">
            </div>
            <div>
                <label for="">Your Email Address</label>
                <input type="email" name="reg_email" required  minlength="13">
                <p class="email-error"><?php echo $email_error; ?></p>
            </div>
            <div>
                <label for="">Choose Your Username</label>
                <input type="text" name="reg_username" required minlength="5">
                <p class="username-error"><?php echo $username_error; ?></p>
            </div>
            <div>
                <label for="">Password</label>
                <input type="password" name="reg_password" required minlength="5">
            </div>
            <div>
                <input type="submit" value="Register Account" name="register_account">
            </div>
        </form>
    </div>
    <div class="login-link">
        <p class="text-center"><a href="login.php">Go To Login Page</a></p>
    </div>
    <div class="login-link">
        <p class="text-center"><a href="#">Forgot Password</a></p>
    </div>
</div>

</body>
</html>