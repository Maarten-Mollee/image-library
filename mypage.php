<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/mypage.css" type="text/css">
        <title>mypage</title>
    </head>
    <body>
        <header>
            <?php include "menu.php"?>
        </header>
        <main>
            <?php
            if (isset($_SESSION['login'])) {
                $id = $_SESSION['login'];
                $sql = "SELECT * FROM users WHERE user_id = $id ";
                $result = mysqli_query($conn, $sql);
                $queryResult = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
                $name = $row['user_name'];
                $pic = $row['pic'];
                $extention = $row['extention'];
                $description = ['description'];
                $i = $pic.$extention;

                if ($i == false){
                    $i = '0.png';
                }

                ?>
               <!-- <form action="delete_account.php" method="post">
                   <input type="submit" name="delete_account" value="delete account">
               </form> -->

                <form action="mypage_update.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" value="">
                    <input type="submit" name="submit" value="submit">
                </form>

                <div class="profile_image">
                    <img src="profile_photos/<?php echo $i; ?>">
                </div>

                <?php
            }
            ?>
        </main>
    </body>
</html>
