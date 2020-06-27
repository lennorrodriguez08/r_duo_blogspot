<?php 
    include "./includes/header.php";

    if (isset($_SESSION['user_username'])) {
        header("Location: index.php");
    }
    $login_error = "";
?>

<?php 

    if (isset($_POST['login_submit'])) {
        $login_user = $_POST['login_user'];
        $login_password = $_POST['login_password'];
        $login_email = $_POST['login_user'];

        $query_username = "SELECT * FROM users WHERE user_username = '$login_user'";
        $username_result = mysqli_query($connection, $query_username);

        while ($row = mysqli_fetch_assoc($username_result)) {
            $user_username = $row['user_username'];
            $user_password = $row['user_password'];
            $user_id = $row['user_id'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_image = $row['user_image'];
            // $verified_password = password_verify($login_password, $user_password);
        }

        $login_password = crypt($login_password, $user_password);

        if ($login_user == $user_username && $login_password == $user_password) {

                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_username'] = $user_username;
                $_SESSION['user_firstname'] = $user_firstname;
                $_SESSION['user_lastname'] = $user_lastname;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_role'] = $user_role;
                $_SESSION['user_image'] = $user_image;
                $_SESSION['user_password'] = $user_password;
                header("Location: index.php");
        }   else {
            $login_error = "Incorrect Username or Password";
        }
    }   

?>
  
<div class="login-container" style="padding-top: 80px">
    <div class="login-logo">
        <img src="./img/r-duo-light-logo.png" alt="">
    </div>
    <div>
        <p>Login To Your Account</p>
    </div>
    <div class="login-container-form">
        <form action="" method="POST">
            <div>
                <label for="">Username</label>
                <input type="text" name="login_user" required minlength="5">
            </div>
            <div>
                <label for="">Password</label>
                <input type="password" name="login_password" required minlength="5">
            </div>
            <div>
                <p class="login-error"><?php echo $login_error; ?></p>
                <input type="submit" value="Login Account" name="login_submit">
            </div>
        </form>
    </div>
    <div class="login-link">
        <p class="text-center"><a href="register.php">Create An Account</a></p>
    </div>
    <div class="login-link">
        <p class="text-center"><a href="#">Forgot Password</a></p>
    </div>
</div>

</body>
</html>