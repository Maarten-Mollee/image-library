<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <title>Index</title>
    </head>
    <body>
        <header>
            <?php include "menu.php"?>
        </header>
        <main>
            <?php
            if (isset($_GET['safe'])){
                if ($_GET['safe'] == 1){
                    $_SESSION['explicit'] = 1;
                }else if ($_GET['safe'] == 0){
                    $_SESSION['explicit'] = 0;
                }
            }
            ?>

            <?php $safe = 0 ?>
            if you're aged 18 or above click
            <a href="safemodepage.php?safe=1"><?php echo 'here';?></a>
             to enter explicit mode

            <br><br>
            if you wish to go back to safe mode, then click
            <a href="safemodepage.php?safe=0"><?php echo 'here';?></a>
            <br><br>
            <?php
            if (isset($_SESSION['explicit']) && $_SESSION['explicit'] == 1){
                echo 'safemode off';
            }elseif (isset($_SESSION['explicit']) && $_SESSION['explicit'] == 0){
                echo 'safemode on';
            }else{
                echo 'safemode on';
            }
            ?>
        </main>
    </body>
</html>