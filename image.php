<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/image.css" type="text/css">
        <title>image</title>
    </head>
    <body>
        <header>
            <?php include "menu.php"?>
        </header>
        <main>
            <div class="tags">
                <ul class="tag">
                    <form action="posts.php" method="get">
                        <input type="text" name="tag">
                        <input type="submit" name="search" value="search" class="index-submit">
                    </form>
                    <?php
                    $id = $_GET["id"];
                    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
                        echo '<p>new tags:</p>';
                        ?>
                        <form action="tag_adder.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" name="tag" autofocus>
                            <input type="submit" name="add_tag" value="add tag"><br>
                        </form>
                        <form action="tag_adder.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" name="artist" >
                            <input type="submit" name="add_artist" value="add artist"><br>
                        </form>
                        <form action="tag_adder.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" name="link">
                            <input type="submit" name="add_link" value="add link">
                        </form>
                        <form action="tag_adder.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" name="character">
                            <input type="submit" name="add_character" value="add character">
                        </form>
                        <form action="tag_adder.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" name="copyright">
                            <input type="submit" name="add_copyright" value="add copyright">
                        </form>
                        <form action="tag_adder.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" name="world">
                            <input type="submit" name="add_world" value="add world">
                        </form>
                        <form action="safemode.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            if the image is not safe:
                            <input class="safebox" type="checkbox" name="safemode">
                            <input class="safesubmit" type="submit" name="submit" value="submit">
                        </form>
                        
                    <?php } ?>
                    <br><hr>
                    <?php

                    //LAAT ARTIEST ZIEN
                    $sql = "SELECT image_id, tag_name FROM imagetag WHERE tag_name IN (
                        SELECT artist FROM images WHERE image_id = '$id') 
                        AND image_id = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $queryResult = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);

                    if($queryResult > 0) { ?>
                        <table>
                            <br><p>artist:</p>
                            <tr> <?php
                                $artist = $row['tag_name'];
                                $tagcount = "SELECT	count(tag_name) FROM imagetag WHERE tag_name in ('$artist')";
                                $tagcountresult = mysqli_query($conn, $tagcount);
                                $countrow = mysqli_fetch_assoc($tagcountresult);
                                $count = $countrow['count(tag_name)']; ?>
                                <td class="artist-tag">
                                    <a href="posts.php?tag=<?php echo $artist; ?>"><?php echo $artist; ?> </a><?php echo $count;
                                
                                    // if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                    //     echo '<form action="delete_tags.php" method="post">';
                                    //         echo '<input type="submit" name="editArtist" value="edit">';
                                    //         echo '<input type="hidden" name="id" value="' . $id . '" >';
                                    //         echo '<input type="hidden" name="tag" value="' . $artist . '" >';
                                    //         echo '<input type="text" name="newName">';
                                    //     echo '</form>';
                                    // }
                                    ?>
                                </td>                                
                            </tr>
                        </table> <?php
                    }

                    //LAAT COPYRIGHT ZIEN
                    $sql = "SELECT image_id, tag_name FROM imagetag WHERE tag_name IN (
                            SELECT copyright FROM imagecopyright WHERE image_id = '$id') 
                            AND image_id = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $queryResult = mysqli_num_rows($result);

                    if($queryResult > 0) {
                        echo '<table>'; ?>
                            <br><p>copyright:</p> <?php
                            while ($row = mysqli_fetch_assoc($result)){
                                echo '<tr>';
                                    $copyright = $row['tag_name'];
                                    $tagcount = "SELECT	count(tag_name) FROM imagetag WHERE tag_name in ('$copyright')";
                                    $tagcountresult = mysqli_query($conn, $tagcount);
                                    $countrow = mysqli_fetch_assoc($tagcountresult);
                                    $count = $countrow['count(tag_name)']; ?>
                                    <td class="copyright-tag">
                                        <a href="posts.php?tag=<?php echo $copyright; ?>"><?php echo $copyright; ?> </a><?php echo $count; ?>
                                    </td> <?php

                                    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { ?>
                                        <td>
                                            <form action="delete_tags.php" method="post">
                                                <input type="submit" name="removeCopyright" value="remove tag">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                                                <input type="hidden" name="tag" value="<?php echo $copyright; ?>" >
                                            </form>
                                        </td> <?php
                                    }
                                echo '</tr>';
                            }
                        echo '</table>';
                    }

                    //LAAT CHARACTER_NAME ZIEN
                    $sql = "SELECT image_id, tag_name FROM imagetag WHERE tag_name IN (
                                SELECT character_name FROM imagecharacter WHERE image_id = '$id') 
                                AND image_id = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $queryResult = mysqli_num_rows($result);

                    if($queryResult > 0) {
                        echo '<table>'; ?>
                            <br><p>character:</p> <?php
                            while ($row = mysqli_fetch_assoc($result)){
                                echo '<tr>';
                                    $character = $row['tag_name'];
                                    $tagcount = "SELECT	count(tag_name) FROM imagetag WHERE tag_name in ('$character')";
                                    $tagcountresult = mysqli_query($conn, $tagcount);
                                    $countrow = mysqli_fetch_assoc($tagcountresult);
                                    $count = $countrow['count(tag_name)']; ?>
                                    <td class="character-tag"><a href="posts.php?tag=<?php echo $character; ?>"><?php echo $character; ?> </a><?php echo $count; ?></td> <?php
                                    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { ?>
                                        <td>
                                            <form action="delete_tags.php" method="post">
                                                <input type="submit" name="removeCharacter" value="remove tag">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="tag" value="<?php echo $character; ?>">
                                            </form>
                                        </td> <?php
                                    }
                                echo '</tr>';
                            }
                        echo '</table>';
                    }

                    //LAAT ZIEN BIJ WELKE WERELD DE AFBEELDING PAST
                    $sql = "SELECT image_id, tag_name FROM imagetag WHERE tag_name IN (
                        SELECT world FROM world WHERE image_id = $id) 
                        AND image_id = $id ORDER BY tag_name ASC";
                    $result = mysqli_query($conn, $sql);
                    $queryResult = mysqli_num_rows($result);

                    if($queryResult > 0) {
                        echo '<table>'; ?>
                            <br><p>world:</p> <?php
                            while ($row = mysqli_fetch_assoc($result)){
                                echo '<tr>';
                                    $world = $row['tag_name'];
                                    $tagcount = "SELECT	count(tag_name) FROM imagetag WHERE tag_name in ('$world')";
                                    $tagcountresult = mysqli_query($conn, $tagcount);
                                    $countrow = mysqli_fetch_assoc($tagcountresult);
                                    $count = $countrow['count(tag_name)']; ?>
                                    <td class="world-tag"><a href="posts.php?tag=<?php echo $world; ?>"><?php echo $world; ?> </a><?php echo $count; ?></td> <?php
                                    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { ?>
                                        <td>
                                            <form action="delete_tags.php" method="post">
                                                <input type="submit" name="removeWorld" value="remove tag">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="tag" value="<?php echo $world; ?>">
                                            </form>
                                        </td> <?php
                                    } 
                                echo '</tr>';
                            }
                        echo '</table>';
                    }
                    echo '<br><hr><br>';

                    //LAAT BLAUWE TAGS ZIEN
                    $tagsql = "SELECT * FROM imagetag WHERE tag_name NOT IN (SELECT artist FROM images)
                               AND tag_name NOT IN (SELECT uploader FROM images)
                               AND tag_name NOT IN (SELECT character_name FROM imagecharacter)
                               AND tag_name NOT IN (SELECT copyright FROM imagecopyright)
                               AND tag_name NOT IN (SELECT world FROM world)
                               AND image_id = '$id'";
                    $tagresult = mysqli_query($conn, $tagsql);
                    $querytagResult = mysqli_num_rows($tagresult);

                    if ($querytagResult > 0) {
                        echo '<table>';
                            while ($tagrow = mysqli_fetch_assoc($tagresult)){
                                echo '<tr>';
                                    $tag = $tagrow['tag_name'];
                                    $tagcount = "SELECT	count(tag_name) FROM imagetag WHERE tag_name in ('$tag')";
                                    $tagcountresult = mysqli_query($conn, $tagcount);
                                    $countrow = mysqli_fetch_assoc($tagcountresult);
                                    $count = $countrow['count(tag_name)'] ;

                                    echo '<td class="tag"><a href="posts.php?tag='.$tag.'">'.$tag.'</a> '.$count.'</td>';

                                    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { ?>
                                        <td>
                                            <form action="delete_tags.php" method="post">
                                                <input type="submit" name="remove" value="remove tag">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="hidden" name="tag" value="<?php echo $tag; ?>">
                                            </form>
                                        </td> <?php
                                    }
                                echo '</tr>';
                            }
                        echo '</table>';
                    }
                    echo '<br><hr>';

                    //LAAT UPLOADER ZIEN
                    $sql = "SELECT uploader FROM images WHERE image_id = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $queryResult = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);

                    if($row['uploader']) {
                        $tag = $row['uploader'];
                        $tagcount = "SELECT	count(tag_name) FROM imagetag WHERE tag_name in ('$tag')";
                        $tagcountresult = mysqli_query($conn, $tagcount);
                        $countrow = mysqli_fetch_assoc($tagcountresult);
                        $count = $countrow['count(tag_name)']; ?>
                        <br><p>uploader:</p>
                        <li class="uploader-tag">
                            <a href="posts.php?tag=<?php echo $tag; ?>"><?php echo $tag; ?> </a><?php echo $count; ?>
                        </li> <?php
                    }

                    //LAAT LINK ZIEN
                    $sql = "SELECT link FROM images WHERE image_id = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $queryResult = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);
                    
                    if($row['link']) {
                        $link = $row['link']; ?>
                        <br><p>link:</p>
                        <li class="link-tag">
                            <a href="<?php echo $link; ?>"><?php echo $link; ?></a>
                        </li> <?php
                    } ?>
                </ul>
            </div>

            <!-- LAAT AFBEELDING ZIEN -->
            <div id="demo" class="image-page">
                <ul class="fullSize">
                    <li>click: 
                    <a onclick="fullSize()">here </a>for full size; 
                    <a onClick="normalSize()"> here </a>to go back to small size</li>
                    <hr>
                    <?php

                    $id = $_GET['id'];
                    $sql = "SELECT * FROM images WHERE image_id = $id";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $ext = $row['extension'];
                    $image = 'uploads/' . $id . $ext; ?>
                    <li><img alt="" src=<?php echo $image; ?>></li>
                </ul>
            </div>

            <!-- COMMENTS -->
            <div class="comments">
                <?php if (isset($_SESSION['login'])) {?>
                    <div class="new_comment">
                        <form action="comment.php" method="post">
                            <input type="text" name="comment" placeholder="no single qoutes please" class="new_comment_text">
                            <input type="submit" name="submit" value="submit" class="new_comment_submit">
                            <input type="hidden" name="image_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="time" value="<?php echo date('o-m-d   H:i:s'); ?>">
                        </form>
                    </div>
                <?php }
                $result = $conn->query("SELECT user_name, comment_text, comment_time FROM comments JOIN users ON comments.user_id = users.user_id WHERE image_id = $id");
                $queryResult = mysqli_num_rows($result);
                if ($queryResult > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                        ?>
                        <br>
                        <div class="comment">
                            <div class="comment_name">
                                <?php echo $row['user_name']; ?>
                            </div>
                            <div class="comment_text">
                                <?php echo $row['comment_text']; ?>
                            </div>
                            <div class="comment_time">
                                date of post: <?php echo $row['comment_time']; ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </main>
    </body>
</html>

<script>
    function fullSize(){
        document.getElementById("demo").className = "image-page1";
    }

    function normalSize(){
        document.getElementById("demo").className = "image-page";
    }
</script>
