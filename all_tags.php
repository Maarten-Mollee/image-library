<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/all_tags.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php include "menu.php"?>
        </header>
        <main>
        
            <?php
            // PAGINATOR
            $sql = "SELECT tag_name, type FROM tags";
            $result_per_page = 150;
            $adress = "all_tags.php?";
            // $result and $page are made in paginator.php
            include "paginator.php";
            ?>

            <br><hr><br>
            <!-- SHOW TAGS -->
            <div class="all_tags_per_page">
                <ul> <?php
                    while ($row = mysqli_fetch_assoc($result)){
                        $tag = $row['tag_name'];
                        $tagcount = "SELECT tag_name, count(tag_name) FROM imagetag WHERE tag_name in ('$tag')";
                        $tagcountresult = mysqli_query($conn, $tagcount);
                        $countrow = mysqli_fetch_assoc($tagcountresult);
                        $count = $countrow['count(tag_name)'] ;
                        $type = $row['type'];
                        echo '<li class="' . $type . '"><a href="posts.php?tag=' . $tag . '">' . $tag . '</a> ' . $count . '</li>'; ?>

                        <!-- <form action="delete_tags.php" method="post">
                            <input type="submit" name="delete" value="delete tag">
                            <input type="hidden" name="tag" value="<?php echo $tag; ?>">
                            <input type="hidden" name="page" value="<?php echo $page; ?>">
                        </form></li> -->
                        <?php
                    } ?>
                </ul>
            </div>
        </main>
    </body>
</html>
