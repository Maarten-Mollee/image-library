<?php include "DB_connect.php"; session_start();

//checken of er is ingelogd vanaf de inlogknop en of de velden zijn ingevult
if(isset($_POST['login'])){
    if(isset($_POST['name'])&&$_POST['name']!=''&&isset($_POST['password'])&&$_POST['password']!=''){

        //de inhoud van de velden in variabelen stoppen
        $name = $_POST['name'];
        $password = $_POST['password'];

        //SQL statement maken
        $ask = "SELECT * FROM users WHERE user_name = '".$name."' AND password = '".$password."'";
        var_dump($ask);

        //koppeling met de database maken
        $result = $conn->query( $ask);

        //checken of er gegevens in de database staan
        if ($result->num_rows > 0 ) {

            //die gegevens in een variabele stoppen
            $row = $result->fetch_assoc();

            //de gekoppelde gegevens in variabelen en meteen ook in sessions plaatsen
            $id = $row['user_id'];
            $_SESSION['login'] = $id;
            $admin = $row ['admin'];
            $_SESSION['admin'] = !!$admin;

            //deferentieren tussen admins en normale users
            if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
                header("Location: mypage.php?admin_login!");
                exit();
            }else{
                header("Location: mypage.php?user_login!");
                exit();
            }
        }else{
            header("Location: mypage.php?wrong!");
            exit();
        }
    }else{
        header("Location: mypage.php?empty_fields!");
        exit();
    }
}else{
    header("Location: mypage.php?error");
    exit();
}