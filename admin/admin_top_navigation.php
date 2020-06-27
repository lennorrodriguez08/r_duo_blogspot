<?php 

if ($_SESSION['user_role'] !== "Administrator") {
    header("Location: ../index.php");
}

?>
<nav>
        <div>
            <a href="index.php"><img src="../img/r-duo-light-logo.png" alt=""></a>
        </div>
        <ul class="logout-button">
            <li>
                <a href="#" class="logout-toggle"><i class="far fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['user_username']; ?>&nbsp;&nbsp;<i class="fas fa-caret-down"></i></a>
                <ul class="logout-dropdown">
                    <li>
                        <a href="admin_profile.php"><i class="far fa-user"></i>&nbsp;&nbsp;Profile</a>
                    </li>
                    <li>
                        <a href="../logout.php" class=""><i class="fas fa-power-off"></i>&nbsp;&nbsp;Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="toggle-icon">
            <i class="fas fa-bars"></i>
        </div>
    </nav>