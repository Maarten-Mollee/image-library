<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/post.css" type="text/css">
        <title>list</title>
    </head>
    <body>
        <header>
            <?php include "menu.php"?>
        </header>
        <main>

            <?php

            //als er een zoekopdracht is
            if (isset($_GET['tag'])){
                $search = $_GET['tag'];

                //creating the sql statement in parts in an array and end with implode
                $tags = explode(' ', $search);

                $i = 0;
                $sql[0] = "SELECT image_id, extension FROM images";
                foreach ($tags as $tag) {
                    $i++;
                    if ($i == 1) {
                        if (stripos ($tag, '-') === 0) {
                            $tag1 = strpbrk($tag, 'qwertyuiopasdfghjklzxcvbnm1234567890_+=.QWERTYUIOPASDFGHJKLZXCVBNM<>,!@#$%^&*()');
                            $sql[$i] = "WHERE (image_id NOT IN (SELECT image_id FROM imagetag WHERE tag_name = '$tag1'))";
                        } else {
                            $tag1 = strpbrk($tag, 'qwertyuiopasdfghjklzxcvbnm1234567890_+=.QWERTYUIOPASDFGHJKLZXCVBNM<>,!@#$%^&*()');
                            $sql[$i] = "WHERE (image_id IN (SELECT image_id FROM imagetag WHERE tag_name = '$tag1'))";
                        }
                    } else {
                        if (stripos ($tag, '-') === 0) {
                            $tag1 = strpbrk($tag, 'qwertyuiopasdfghjklzxcvbnm1234567890_+=.QWERTYUIOPASDFGHJKLZXCVBNM<>,!@#$%^&*()');
                            $sql[$i] = "AND (image_id NOT IN (SELECT image_id FROM imagetag WHERE tag_name = '$tag1'))";
                        } else {
                            $tag1 = strpbrk($tag, 'qwertyuiopasdfghjklzxcvbnm1234567890_+=.QWERTYUIOPASDFGHJKLZXCVBNM<>,!@#$%^&*()');
                            $sql[$i] = "AND (image_id IN (SELECT image_id FROM imagetag WHERE tag_name = '$tag1'))";
                        }
                    }
                }
                $sql = implode($sql, ' ');


                if (isset($_SESSION['explicit'])){
                    if ($_SESSION['explicit'] == 1){
                        $explicit = '';
                    } else {
                        $explicit = ' AND safe NOT LIKE 1';
                    }
                } else {
                    $explicit = ' AND safe NOT LIKE 1';
                }

                $sql = $sql.$explicit . " ORDER BY image_id DESC";

            //als er geen zoekopdracht is gegeven
            } else {

                $sql = "SELECT * FROM images";

                if (isset($_SESSION['explicit'])){
                    if ($_SESSION['explicit'] == 1){
                        $explicit = '';
                    } else {
                        $explicit = ' WHERE safe NOT LIKE 1 ';
                    }
                } else {
                    $explicit = ' WHERE safe NOT LIKE 1 ';
                }

                $sql = $sql.$explicit . " ORDER BY image_id DESC";
            }

            $adress = "posts.php?";
            $result_per_page = 40;
            if (isset($tags)){
                $urltags = 'tag='.implode ($tags, '+').'&';
            }

            // $result and $page are made in paginator.php
            include "paginator.php"; ?>

            <!-- IMAGES -->
            <div class="images">
                <ul class="image_list"> <?php
                    $i = 0;
                    if ($queryresult > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['image_id'];
                            $idRow[$i] = $id;
                            $i++; 
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
                <ul>
                    <form action="posts.php" method="get">
                        <input type="text" name="tag">
                        <input type="submit" name="search" value="Search" class="index-submit">
                    </form>
                    <form action="posts.php" method="get">
                        <select name="choose">
                            <option value="abc">alphabetic</option>
                            <option value="zyx">reverse alphabetic</option>
                            <option value="big">most used</option>
                            <option value="small">least used</option>
                        </select>
                        <input type="submit" name="submitSorting" value="sorting">
                    </form>
                </ul>
                <?php

                if ($queryresult > 0) {
                    if(isset($_GET['submitSorting']) && $_GET['submitSorting']!='') {
                        $sorting = $_GET['choose'];

                        switch ($sorting) {
                            case "abc":
                                $tagsql = "SELECT tag_name FROM tags WHERE tag_name IN(
                                    SELECT tag_name FROM imagetag 
                                    WHERE image_id = ";
                                $image_id = implode($idRow, ' OR image_id = ');
                                $tagLimit = ') ORDER BY tag_name ASC LIMIT 40';
                                $tagsql = $tagsql.$image_id.$tagLimit;
                                break;
                            case "zyx":
                                $tagsql = "SELECT tag_name FROM tags WHERE tag_name IN(
                                    SELECT tag_name FROM imagetag 
                                    WHERE image_id = ";
                                $image_id = implode($idRow, ' OR image_id = ');
                                $tagLimit = ') ORDER BY tag_name DESC LIMIT 40';
                                $tagsql = $tagsql.$image_id.$tagLimit;
                                break;
                            case "big":
                                $tagsql = "SELECT tag_name, COUNT(tag_name) FROM imagetag WHERE tag_name IN(
                                    SELECT tag_name FROM imagetag 
                                    WHERE image_id = ";
                                $image_id = implode($idRow, ' OR image_id = ');
                                $tagLimit = ') GROUP BY tag_name ORDER BY COUNT(*) DESC LIMIT 40';
                                $tagsql = $tagsql.$image_id.$tagLimit;
                                break;
                            case "small":
                                $tagsql = "SELECT tag_name, COUNT(tag_name) FROM imagetag WHERE tag_name IN(
                                    SELECT tag_name FROM imagetag 
                                    WHERE image_id = ";
                                $image_id = implode($idRow, ' OR image_id = ');
                                $tagLimit = ') GROUP BY tag_name ORDER BY COUNT(*) ASC LIMIT 40';
                                $tagsql = $tagsql.$image_id.$tagLimit;
                                break;
                        }
                    } else {
                        $tagsql = "SELECT tag_name FROM tags WHERE tag_name IN(
                            SELECT tag_name FROM imagetag 
                            WHERE image_id = ";
                        $image_id = implode($idRow, ' OR image_id = ');
                        $tagLimit = ') LIMIT 40';
                        $tagsql = $tagsql.$image_id.$tagLimit;
                    }
                    //getting 40 tags
                    $tagresult = mysqli_query($conn, $tagsql);
                    $queryresult = mysqli_num_rows($tagresult);                    

                    if ($queryresult > 0) {
                        while ($row = mysqli_fetch_assoc($tagresult)){
                            $tag = $row['tag_name'];
                            $tagcount = "SELECT count(tag_name) FROM imagetag WHERE tag_name in ('$tag')";
                            $tagcountresult = mysqli_query($conn, $tagcount);
                            $countrow = mysqli_fetch_assoc($tagcountresult);
                            $count = $countrow['count(tag_name)']; ?>
                            <li class="tag">
                                <a href="posts.php?tag=<?php echo $tag; ?>"><?php echo $tag; ?></a><?php echo $count; ?>
                            </li> <?php
                            unset($tag);
                        }
                    }
                } ?>
            </div>
        </main>
    </body>
</html>
