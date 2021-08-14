<?php include "DB_connect.php"; session_start();

if (isset($_POST['delete'])){
    if(isset($_POST['id']) && $_POST['id']!=''){
        $id = $_POST['id'];
        $sql = "SELECT extension FROM images WHERE image_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $ext = mysqli_fetch_assoc($result);
        $ext = implode($ext);
        $file_name = $id.''.$ext;

        var_dump($file_name);
        $sql = "DELETE FROM images WHERE image_id='$file_name'";
        $result = mysqli_query($conn, $sql);

        $sql = "DELETE FROM imagetag WHERE image_id='$id'";
        $result = mysqli_query($conn, $sql);
        unlink("uploads/$id.jpg");

        if (isset($_GET['page'])){
            $page = $_GET['page'];
            header("Location: posts.php?page='.$page.'");
        }else{
            $page = $_GET['page'];
            header("Location: no_tag_images.php");
        }
    }
}