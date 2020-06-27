<?php 

if ($_SESSION['user_role'] !== "Administrator") {
    header("Location: ../index.php");
}

?>
<div class="admin-sidebar">
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i>&nbsp;&nbsp;Main</a></li>
            <li><a href="#" class="blog-dropdown-target"><i class="fas fa-newspaper" class="blog-post-dropdown"></i>&nbsp;&nbsp;Blog Posts&nbsp;&nbsp;<i class="fas fa-caret-down"></i></a>
                <ul class="blog-post-dropdown-item">
                    <li><a href="view_all_blog.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View All Blog</a></li>
                    <li><a href="add_new_blog.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add New Blog</a></li>
                </ul>
            </li>
            <li><a href="update_categories.php"><i class="fas fa-list"></i>&nbsp;&nbsp;Categories</a></li>
            <li><a href="view_all_comments.php"><i class="far fa-comments"></i>&nbsp;&nbsp;Comments</a></li>
            <li class="user-dropdown"><a href="#" class="user-dropdown-target"><i class="fas fa-users"></i>&nbsp;&nbsp;Users&nbsp;&nbsp;<i class="fas fa-caret-down"></i></a>
                <ul class="user-dropdown-item">
                    <li><a href="view_all_users.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View All Users</a></li>
                    <li><a href="add_new_user.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add New User</a></li>
                </ul>
            </li>
            <li><a href="admin_profile.php"><i class="fas fa-id-card"></i>&nbsp;&nbsp;Profile</a></li>
            <li><a href="../index.php"><i class="fas fa-blog"></i>&nbsp;&nbsp;Blogspot Home</a></li>
        </ul>
    </div>