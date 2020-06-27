<?php 
    include "../includes/connection.php";
    include "./functions.php";
    session_start();

    if ($_SESSION['user_role'] !== "Administrator") {
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R-Duo Manila | Blogspot | Admin</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon.png">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/all.css">
    <script src="../js/admin.js"></script>
    <script src="../js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script src="https://kit.fontawesome.com/34a28b49e2.js" crossorigin="anonymous"></script>-->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script> -->
</head>
<body>