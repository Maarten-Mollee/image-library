<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <title>add image</title>
    </head>
    <body>
    <header>
        <?php include "menu.php"?>
    </header>
        <main>
            <form action="add_image2.php" method="post" enctype="multipart/form-data">
                <br><p>upload your images here:</p>
                <input type="file" name="image[]" value="" multiple ><br>
                <input type="submit" name="add_image" value="add image" class="index-submit">
            </form>
        </main>
    </body>
</html>
