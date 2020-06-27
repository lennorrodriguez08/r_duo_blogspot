<?php 

   $query_salt = "SELECT random_salt FROM users";
   $query_salt_result = mysqli_query($connection, $query_salt);
   $row = mysqli_fetch_assoc($query_salt_result);
   $salt = $row['random_salt'];

    $update_user_message = "";
    $query = "SELECT * FROM users WHERE user_id = $update_profile_user_id";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
    $update_user_firstname = $row['user_firstname'];
    $update_user_lastname = $row['user_lastname'];
    $update_user_email = $row['user_email'];
    $update_user_username = $row['user_username'];
    $update_user_password = $row['user_password'];
   //  $hashed_password = crypt($update_user_password, $salt);
    $update_user_image = $row['user_image'];
    $update_user_registration_date = $row['user_registration_date'];
    }

?>

<?php 
   
    if (isset($_POST['update_guest_profile'])) {
        $update_user_firstname = $_POST['new_firstname'];
        $update_user_lastname = $_POST['new_lastname'];
        $new_image_name = $_FILES['new_image']['name'];
        $new_image_tmp_name = $_FILES['new_image']['tmp_name'];
        $update_user_password = $_POST['new_password'];
        date_default_timezone_set("Asia/Chongqing");
        $update_registration_date = "Updated " . date('M d, Y – h:i A');
        $imageExtension = explode(".", $new_image_name);
        $finalImageExtension = strtolower(end($imageExtension));
        $allowedImageExtension = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($finalImageExtension, $allowedImageExtension)) {
            
            $new_unique_name = uniqid('Profile', true) . "." . $finalImageExtension;
            $image_destination = "./img/" . $new_unique_name;
            move_uploaded_file($new_image_tmp_name, $image_destination);
            
            $query = "UPDATE users SET user_firstname = '$update_user_firstname', user_lastname = '$update_user_lastname', user_image = '$new_unique_name', user_password = '$update_user_password', user_registration_date = '$update_registration_date $update_user_registration_date' WHERE user_id = $update_profile_user_id";
            $result = mysqli_query($connection, $query);


            $query = "SELECT * FROM users WHERE user_id = $update_profile_user_id";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            $update_user_image = $row['user_image'];
            }

            $update_user_message = "Update Successful";

        }

        else {
           
            $query = "UPDATE users SET user_firstname = '$update_user_firstname', user_lastname = '$update_user_lastname', user_image = '$update_user_image', user_password = '$update_user_password', user_registration_date = '$update_registration_date' WHERE user_id = $update_profile_user_id";
            $result = mysqli_query($connection, $query);


            $query = "SELECT * FROM users WHERE user_id = $update_profile_user_id";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            $update_user_image = $row['user_image'];
            }
            $update_user_message = "Update Successful";
    } 
        
    }   
    
   ?>

<div class="update-profile-modal">
      <div class="modal-container">
         <form action="" method="POST" enctype="multipart/form-data">
            <div class="update-title">
               <p><i class="far fa-edit"></i>&nbsp;&nbsp;Update My Profile</p>
               <p><i class="fas fa-times"></i></p>
            </div>
            <div>
               <p class="update_user_message"><?php echo $update_user_message; ?></p>
               <label for="">First Name</label>
               <input type="text" value="<?php echo $update_user_firstname; ?>" name="new_firstname" required minlength="2">
            </div>
            <div>
               <label for="">Last Name</label>
               <input type="text" value="<?php echo $update_user_lastname; ?>" name="new_lastname" required minlength="2">
            </div>
            <div>
               <label for="">Email Address</label>
               <input type="email" value="<?php echo $update_user_email; ?>" disabled name="new_email">
            </div>
            <div>
               <label for="">Upload Image</label>
               &nbsp;&nbsp;<img src="./img/<?php echo $update_user_image; ?>" width="80px" height="60px" alt="">
               <input type="file" name="new_image" value="<?php echo $update_user_image; ?>">
            </div>
            <div>
               <label for="">Username</label>
               <input type="text" value="<?php echo $update_user_username; ?>" disabled name="new_user_username">
            </div>
            <div>
               <label for="">Password</label>
               <input type="password" value="<?php echo $update_user_password; ?>" name="new_password" required minlength="5">
            </div>
            <input type="submit" value="Update Now" name="update_guest_profile">
         </form>
      </div>
   </div>
