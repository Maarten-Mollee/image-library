<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/index.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php include "menu.php"?>
        </header>
        <main>
            <br><br><br>
            <div class="index">
                <h1>This is Library</h1>
                <br>
                <form action="posts.php" method="get">
                    <input type="text" name="tag" class="index-search" placeholder="search for a tag: 1boy blue_hair ect.">
                    <input type="submit" name="search" class="index-submit" value="Search">
                </form>
                <br>
                <?php
                $sql = "SELECT count(image_id) FROM images";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $count = $row['count(image_id)'];
                ?>
                image count: <?php echo $count; ?>
                
                <br><br>

                <p>to do list:</p>
                <p>2.1. fix css for navbar (make it like in gelbooru)</p>
                <p>2.2. when searching with a tag, remove search=Search if possible</p>
                <p>2.3. tags not showing on post page</p>
                <br>
                <p>3.1. make delete all tags button with script on 0_count_tags</p>
                <p>3.2. make new sorting with javascript</p>
                <br>
                <p>extra: find missing artists</p>
                <br>

                <?php $here = 'cat'; ?>

                <div id="click" class="test">
                    <p><?php echo $here; ?></p>
                </div>

                <a onclick="hello()">here </a>

            </div>
        </main>
    </body>
</html>


<script>
    function hello(){
        document.getElementById("click").className = "test2";
    }
</script>

<style> a{cursor: pointer; } </style>
