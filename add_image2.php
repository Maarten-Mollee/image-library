<?php include "DB_connect.php"; session_start();


//LIST OF UPLOAD CONDITIONS
$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with succes',
    1 => 'the uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'the uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'the uploaded file was only partially uploaded',
    4 => 'no file was uploaded',
    6 => 'missing a temporary folder',
    7 => 'failed to white file to disk.',
    8 => 'a php extension stopped the file upload',
);

//IF AN IMAGE WAS UPLOADED
if(isset($_FILES['image'])) {
    //REARRANGE THE FILE(S)
    $file_array = reArrayFiles($_FILES['image']);
    print_this($file_array);
    //GO TROUGH THE ARRAY
//    var_dump($file_array);
    for ($i = 0; $i < count($file_array); $i++) {
        if ($file_array[$i]['error']) {
            echo '<div class="alert alert-danger">';
                echo $file_array[$i]['name']. ' - ' . $phpFileUploadErrors[$file_array[$i]['error']];
            echo '</div>';
        } else {
            $extensions = array('jpg', 'png', 'gif', 'jpeg');
            $file_ext = explode('.', $file_array[$i]['name']);
            $file_ext = end($file_ext);

            if (!in_array($file_ext, $extensions)) {
                echo '<div class="alert alert-danger">';
                    echo "{$file_array[$i]['name']} - Invalid file extensions!";
                echo '</div>';
            }else{

                //CATCH THE ADMIN OF THE CURRENT $_SESSION
                $id = $_SESSION['login'];
                $sqlname = "SELECT user_name FROM users WHERE user_id = '$id'";
                $resultname = mysqli_query($conn, $sqlname);
                $rowname = mysqli_fetch_assoc($resultname);
                $uploadername = $rowname['user_name'];

                $sql = "INSERT INTO images (extension, uploader) VALUES('.$file_ext','$uploadername')";
                $result = mysqli_query($conn, $sql);

                $sqlmax = "SELECT MAX(image_id) FROM images";
                $resultmax = mysqli_query($conn, $sqlmax);
                $queryresultmax = mysqli_fetch_assoc($resultmax);
                $new_id = implode($queryresultmax);

                move_uploaded_file($file_array[$i]['tmp_name'], 'uploads/'.$new_id.'.'.$file_ext);
                echo '<div class="alert alert-succes">';
                    echo $new_id.' - '.$phpFileUploadErrors[$file_array[$i]['error']];
                echo '</div>';

                $sql = "INSERT INTO imagetag (image_id, tag_name) VALUES('$new_id','$uploadername')";
                $result = mysqli_query($conn, $sql);
            }
        }
    }
}

function reArrayFiles($file_post)

{

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}


function print_this($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
