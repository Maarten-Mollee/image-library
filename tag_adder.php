<?php include "DB_connect.php"; session_start();

if(isset($_POST['add_tag'])){
    if(isset($_POST['id']) && $_POST['id'] != '' && isset($_POST['tag']) && $_POST['tag'] != ''){
        $id = $_POST['id'];
        $tag = $_POST['tag'];

        $result = $conn->query("INSERT INTO tags (tag_name, type) VALUES ('$tag', 'tag')");

        $result = $conn->query("INSERT INTO imagetag (image_id, tag_name)
        VALUES('$id','$tag')");

        header("Location: image.php?id=$id");
    }else{
        $id = $_POST['id'];
        header("Location: image.php?id=$id&fill_in_the_field");
        exit();
    }
}elseif(isset($_POST['add_artist'])){
    if(isset($_POST['id']) && $_POST['id'] != '' && isset($_POST['artist']) && $_POST['artist'] != '' ){
        $id = $_POST['id'];
        $artist = $_POST['artist'];

        $result = $conn->query("INSERT INTO tags (tag_name, type) VALUES ('$artist', 'artist')");

        $result = $conn->query("UPDATE images SET artist='$artist' WHERE image_id=$id");

        $result = $conn->query("INSERT INTO imagetag (image_id, tag_name)
        VALUES('$id','$artist')");

        header("Location: image.php?id=$id");
    }else{
        $id = $_POST['id'];
        header("Location: image.php?id=$id&fill_in_the_field");
        exit();
    }
}elseif(isset($_POST['add_character'])){
    if(isset($_POST['id']) && $_POST['id'] != '' && isset($_POST['character']) && $_POST['character'] != '' ){
        $id = $_POST['id'];
        $character = $_POST['character'];

        $result = $conn->query("INSERT INTO tags (tag_name, type) VALUES ('$character', 'character')");

        $result = $conn->query("INSERT INTO imagecharacter (image_id, character_name)
        VALUES('$id','$character')");

        $result = $conn->query("INSERT INTO imagetag (image_id, tag_name)
        VALUES('$id','$character')");

        header("Location: image.php?id=$id");
    }else{
        $id = $_POST['id'];
        header("Location: image.php?id=$id&fill_in_the_field");
        exit();
    }
}elseif(isset($_POST['add_copyright'])){
    if(isset($_POST['id']) && $_POST['id'] != '' && isset($_POST['copyright']) && $_POST['copyright'] != '' ){
        $id = $_POST['id'];
        $copyright = $_POST['copyright'];

        $result = $conn->query("INSERT INTO tags (tag_name, type) VALUES ('$copyright', 'copyright')");

        $result = $conn->query("INSERT INTO imagecopyright (image_id, copyright)
        VALUES('$id','$copyright')");

        $result = $conn->query("INSERT INTO imagetag (image_id, tag_name)
        VALUES('$id','$copyright')");

        header("Location: image.php?id=$id");
    }else{

        $id = $_POST['id'];
        header("Location: image.php?id=$id&fill_in_the_field");
        exit();
    }
}elseif(isset($_POST['add_world'])){
    if(isset($_POST['id']) && $_POST['id'] != '' && isset($_POST['world']) && $_POST['world'] != '' ){
        $id = $_POST['id'];
        $world = 'world_' . $_POST['world'];

        $result = $conn->query("INSERT INTO tags (tag_name, type) VALUES ('$world', 'world')");

        $result = $conn->query("INSERT INTO world (image_id, world)
        VALUES('$id','$world')");

        $result = $conn->query("INSERT INTO imagetag (image_id, tag_name)
        VALUES('$id','$world')");

        header("Location: image.php?id=$id");
    }else{

        $id = $_POST['id'];
        header("Location: image.php?id=$id&fill_in_the_field");
        exit();
    }
}elseif(isset($_POST['add_link'])){
    if( isset($_POST['id']) && $_POST['id'] != '' && isset($_POST['link']) && $_POST['link'] != '' ){
        $id = $_POST['id'];
        $link = $_POST['link'];

        $result = $conn->query("UPDATE images SET link='$link' WHERE image_id=$id");

        header("Location: image.php?id=$id");
    }else{
        $id = $_POST['id'];
        header("Location: image.php?id=$id&fill_in_the_field");
        exit();
    }
}else{
    $id = $_POST['id'];
    header("Location: image.php?id=$id.stop_hacking!!!");
    exit();
}