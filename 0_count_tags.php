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
            <br>
            <p>These are all the tags that are not in use because they are either typos or have been replaced.</p>
            <br><hr><br><br>
            <?php
            
            $sql = "SELECT * FROM tags WHERE tag_name NOT IN (SELECT tag_name FROM imagetag)";
            $result = mysqli_query($conn, $sql);
            $queryresult = mysqli_num_rows($result); ?>
            
            <div class="all_tags_per_page">
                <ul> <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tag = $row['tag_name']; ?>
                        <li class="tag"><?php echo $tag; ?></li> <?php
                    } ?>
                </ul>
            </div> 
            <br><br>
            
            <div class="delete_tags">
                <a onclick="<?php echo $no; ?>">delete </a>
            </div>
        </main>
    </body>
</html>

<?php
function delete($input){
    $input = 'yes';
    echo $input;
}

?>
