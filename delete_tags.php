<?php include "DB_connect.php"; session_start();

//TO REMOVE A TAG FROM ONE IMAGE (IN THE DATABASE ONE ROW DELETED FROM TABEL IMAGETAG
if (isset($_POST['editArtist'])) {
    if(isset($_POST['id']) && $_POST['id']!='' && isset($_POST['tag']) && $_POST['tag']!='' && isset($_POST['newName']) && $_POST['newName']!='') {
        $id = $_POST['id'];
        $tag = $_POST['tag'];
        $newName = $_POST['newName'];

        $result = $conn->query("UPDATE imagetag SET tag_name = '$newName' WHERE image_id = $id AND tag_name = '$tag'");

        $result = $conn->query("UPDATE images SET artist = '$newName' WHERE image_id = $id");

        header("Location: image.php?id=$id");
    }
}

if (isset($_POST['removeCopyright'])){
    if(isset($_POST['id']) && $_POST['id']!='' && isset($_POST['tag']) && $_POST['tag']!=''){
        $id = $_POST['id'];
        $tag = $_POST['tag'];

        $result = $conn->query("DELETE FROM imagetag WHERE image_id= $id AND tag_name= '$tag'");

        $result = $conn->query("DELETE FROM imagecopyright WHERE image_id = $id AND copyright = '$tag'");

        header("Location: image.php?id=$id");
    }
}

if (isset($_POST['removeCharacter'])){
    if(isset($_POST['id']) && $_POST['id']!=''&& isset($_POST['tag']) && $_POST['tag']!=''){
        $id = $_POST['id'];
        $tag = $_POST['tag'];

        $result = $conn->query("DELETE FROM imagetag WHERE image_id= $id AND tag_name= '$tag'");

        $result = $conn->query("DELETE FROM imagecharacter WHERE image_id = $id AND character_name = '$tag'");

        header("Location: image.php?id=$id");
    }
}

if (isset($_POST['remove'])){
    if(isset($_POST['id']) && $_POST['id']!=''&& isset($_POST['tag']) && $_POST['tag']!=''){
        $id = $_POST['id'];
        $tag = $_POST['tag'];

        $result = $conn->query("DELETE FROM imagetag WHERE image_id=$id AND tag_name= '$tag'");


        header("Location: image.php?id=$id");
    }
}

if (isset($_POST['removeWorld'])){
    if(isset($_POST['id']) && $_POST['id']!=''&& isset($_POST['tag']) && $_POST['tag']!=''){
        $id = $_POST['id'];
        $tag = $_POST['tag'];

        $result = $conn->query("DELETE FROM imagetag WHERE image_id= $id AND tag_name= '$tag'");

        $result = $conn->query("DELETE FROM world WHERE image_id = $id AND world = '$tag'");

        header("Location: image.php?id=$id");
    }
}

//TO DELETE ALL THE TAGS WITH THAT NAME FROM THE WHOLE DATABASE
if (isset($_POST['delete'])){
    if(isset($_POST['tag']) && $_POST['tag']!='' && isset($_POST['page']) && $_POST['page']!=''){
        $tag = $_POST['tag'];
        $page = $_POST['page'];

        $result = $conn->query("DELETE FROM tags WHERE tag_name='$tag'");

        $result = $conn->query("DELETE FROM imagetag WHERE tag_name='$tag'");

        $result = $conn->query("DELETE FROM imagecharacter WHERE character_name='$tag'");

        $result = $conn->query("DELETE FROM imagecopyright WHERE copyright='$tag'");

        $result = $conn->query("DELETE FROM world WHERE world='$tag'");

        header("Location: all_tags.php?page=$page");
    }
}