<?php include "DB_connect.php"; session_start();


if(isset($_POST['submit'])){
    if(isset($_POST["name"])&&$_POST["name"]!=''&&isset($_POST['password'])&&$_POST['password']!=''){
        $name = $_POST['name'];
        $password = $_POST['password'];

        $result = $conn->query("INSERT INTO users (user_name, password)
        VALUES ('$name', '$password') ");

        $ask = "SELECT user_id FROM users WHERE user_name = '".$name."' AND password = '".$password."'";

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
        header("Location: register.php?no empty fields!");
        exit();
    }
}else{
    header("Location: register.php?no hacking!!");
    exit();
}
?>