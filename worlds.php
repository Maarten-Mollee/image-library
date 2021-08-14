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

            if (isset($_GET['tag'])) {
                $tag = $_GET['tag'];
                $sql = "SELECT * FROM images WHERE image_id IN (
                        SELECT image_id FROM imagetag WHERE tag_name = '$tag')";

            } else {
                $sql = "SELECT * FROM images WHERE image_id IN (
                        SELECT image_id FROM imagetag WHERE tag_name IN (
                        SELECT tag_name FROM tags WHERE type = 'world'))";
            }

            $result_per_page = 40;
            $adress = "add_link.php?";

            // PAGINATOR
            // $result and $page are made in paginator.php
            include "paginator.php"; ?>

            <!-- IMAGES -->
            <div class="images">
                <ul class="image_list"> <?php
                    if ($queryresult > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['image_id'];
                            $ext = $row['extension'];
                            $image = 'uploads/' . $id . $ext; ?>
                            <li class="image_container">
                                <a href="image.php?id=<?php echo $id; ?>"><img alt="" src=<?php echo $image; ?>></a> <?php
                                // if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                //     echo '<form action="delete_image.php" method="post">';
                                //         echo '<input type="submit" name="delete" value="delete image">';
                                //         echo '<input type="hidden" name="id" value="' . $id . '">';
                                //     echo '</form>';
                                // } ?>
                            </li> <?php
                        }
                    } ?>
                </ul>
            </div> 

            <!-- TAGLIST -->
            <div class="tags">

                <a href="worlds.php?">all worlds</a> <br><br>
                <?php
                for ($i = 1; $i <=10; $i++) {
                    $world_tags[$i] = 'world_' . $i;
                }

                foreach ($world_tags as $tag) {
                    $tagcount = "SELECT count(tag_name) FROM imagetag WHERE tag_name in ('$tag')";
                    $tagcountresult = mysqli_query($conn, $tagcount);
                    $countrow = mysqli_fetch_assoc($tagcountresult);
                    $count = $countrow['count(tag_name)']; ?>
                    <li class="tag">
                        <a href="worlds.php?tag=<?php echo $tag; ?>"><?php echo $tag; ?> </a><?php echo $count; ?>
                    </li> <?php
                    unset($tag);
                }
                ?>
            </div>
        </main>
    </body>
</html>
