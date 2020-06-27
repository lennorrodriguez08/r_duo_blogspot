<?php 

function clean($target_clean) {
    global $connection;
    $clean_target = mysqli_real_escape_string($connection, $target_clean);
    return $clean_target;
}

function checkQuery($target_query) {
    global $connection;
    if (!$target_query) {
        die ("<h1 style='position: relative; z-index: 999999; color: orange!important'>QUERY FAILED</h1>" . mysqli_error($connection) . mysqli_error_list($connection));
    }
}

?>