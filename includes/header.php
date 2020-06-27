<?php 
    include "connection.php";
    include "./admin/functions.php";

    session_start();

    if (isset($_SESSION['user_username'])) {
        $_SESSION['user_username'];
        $_SESSION['user_firstname'];
        $_SESSION['user_lastname'];
        $_SESSION['user_email'];
        $_SESSION['user_role'];
        $_SESSION['user_image'];
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>R-Duo Manila | Blogspot</title>
   <link rel="stylesheet" href="./css/main.css">
   <link rel="stylesheet" href="./css/all.css">
   <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon.png">
   <!-- <script src="https://kit.fontawesome.com/34a28b49e2.js" crossorigin="anonymous"></script>-->
   <script src="./js/ckeditor/ckeditor.js"></script>
   <script src="./js/script.js"></script> 
</head>
<body>