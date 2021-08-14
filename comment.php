<?php include "DB_connect.php"; session_start();

if (isset($_POST['submit'])){
    if (isset($_POST['comment']) && $_POST['comment'] !='' && isset($_POST['image_id']) && $_POST['image_id'] !='' && isset($_POST['time']) && $_POST['time'] !='')  {
        $text = $_POST['comment'];
        $image_id = $_POST['image_id'];
        $user_id = $_SESSION['login'];
        $time = $_POST['time'];

        $result = $conn->query("INSERT INTO comments (user_id, image_id, comment_text, comment_time)
                                       VALUES ('$user_id','$image_id','$text', '$time') ");
        header("Location: image.php?id=$image_id");
    }
}