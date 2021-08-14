<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/post.css" type="text/css">
        <title>no tags</title>
    </head>
    <body>
        <header>
            <?php include "menu.php"?>
        </header>
        <main>

            <?php
            $sql = "SELECT image_id, extension FROM images
                    WHERE image_id NOT IN(
                    SELECT image_id FROM imagetag WHERE tag_name NOT in (
                    SELECT tag_name FROM tags WHERE NOT type = 'tag'))";
            // PAGINATOR
            $adress = "no_tag_images.php?";
            $result_per_page = 100;

            // $result and $page are made in paginator.php
            include "paginator.php";

            include "paste_image.php"; ?>

        </main>
    </body>
</html>