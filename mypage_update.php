<?php include "DB_connect.php"; session_start();


if (isset($_POST['submit'])){
    if (isset($_FILES['file']) && $_FILES['file'] != ''){
        $file = $_FILES['file'];
        var_dump($file);

        $extensions = array('jpg', 'png', 'gif', 'jpeg');
        $file_ext = explode('.', $file['name']);
        $file_ext = end($file_ext);

        if (!in_array($file_ext, $extensions)) { ?>
            <div class="alert alert-danger"> <?php
                echo "{$file['name']} - Invalid file extension!"; ?>
            </div> <?php
        }else {
            $id = $_SESSION['login'];

            $result = $conn->query("UPDATE users SET pic=$id AND extention='.'$file_ext");
            move_uploaded_file($file['tmp_name'], 'profile_photos/'.$id.'.'.$file_ext);
        }
    }else{
        die('somethings wrong with the picture');
    }
}else{
    die('no submit pressed');
}

