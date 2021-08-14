<?php include "DB_connect.php"; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <title>Register</title>
    </head>
    <body>
        <header>
            <?php include "menu.php"?>
        </header>

        <main>
            <form action="register2..php" method="post" name="register">
                <p> name: </p>
                <input type="text" name="name">
                <p> password: </p>
                <input type="password" name="password">
                <input type="submit" name="submit" value="submit">
            </form>
        </main>
    </body>
</html>
