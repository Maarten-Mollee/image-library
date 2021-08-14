<?php include "DB_connect.php"; session_start();

if(isset($_POST['delete_account'])){
    $id = $_SESSION['login'];

    $sql = "DELETE FROM users WHERE user_id = $id";
    $result = mysqli_query($conn, $sql);

    session_unset();
    session_destroy();
    header("Location: index.php");
}
