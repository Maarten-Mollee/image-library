<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/post.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php include "menu.php"?>
        </header>
        <main>
        
            <?php
            // PAGINATOR
            $sql = "SELECT * FROM images WHERE link = ''";
            $result_per_page = 40;
            $adress = "add_link.php?";
            // $result and $page are made in paginator.php
            include "paginator.php";

            include "paste_image.php"; ?>

        </main>
    </body>
</html>
