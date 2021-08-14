<?php include "DB_connect.php"; session_start();
if (isset($_POST['submit'])){
    $id = $_POST['id'];

    if (isset($_POST['safemode'])){
        $safe = 1;
    }else{
        $safe = 0;
    }

    $result = $conn->query("UPDATE images SET safe='$safe' WHERE image_id = '$id'");
    header("Location: image.php?id=$id");
}else{
    echo 'something went wrong';
}