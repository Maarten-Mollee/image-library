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
            <form id="form1" name="form1" method="post" action="phpmailer/index.php">
                <table width="600" align="center" cellpadding="0" cellspacing="0" id="buiten">
                    <tr>
                        <td>
                            <table width="600" border="0" cellpadding="0" cellspacing="0" id="binnen">
                                <tr>
                                    <td width="50%" height="30">Your Name</td>
                                    <td width="50%" height="30"><input type="text" name="name" id="name" /></td>
                                </tr>
                                <tr>
                                    <td width="50%" height="30">Your mail</td>
                                    <td width="50%" height="30"><input type="text" name="email" id="email" /></td>
                                </tr>

                                <tr>
                                    <td width="50%" height="30">Subject</td>
                                    <td width="50%" height="30"><input type="text" name="subject" id="subject" /></td>
                                </tr>
                                <tr>
                                    <td width="50%" height="30">Message</td>
                                    <td width="50%" height="30"><textarea name="message" id="message" cols="45" rows="5"></textarea></td>
                                </tr>
                                <tr>
                                    <td width="50%" height="30"><div align="center">
                                            <input type="submit" name="Verzenden" id="Verzenden" value="Verzenden" />
                                        </div></td>
                                    <td width="50%" height="30"><div align="center">
                                            <input type="reset" name="Wissen" id="Wissen" value="Wissen" />
                                        </div></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </main>
    </body>
</html>