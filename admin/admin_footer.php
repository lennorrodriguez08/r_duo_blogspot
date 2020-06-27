<?php 

if ($_SESSION['user_role'] !== "Administrator") {
    header("Location: ../index.php");
}

?>
</body>
</html>