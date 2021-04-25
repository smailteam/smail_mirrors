<?php
include '../api/server_info.php';
include '../api/functions.php';
session_issruning();
if (isset($_POST['old']) and isset($_POST['new'])){
    $conn=mysqli_connect($db_link,$db_user,$db_password,$db_name);
    $query=mysqli_query($conn,'SELECT mail_password FROM mail WHERE mail_user="'.$_SESSION['m_user'].'"');
    $i=mysqli_fetch_array($query,MYSQLI_ASSOC);
    print_r($i);
    if (password_verify($_POST['old'],$i['mail_password'])){
        $query=mysqli_query($conn,'UPDATE mail SET mail_password="'.password_hash($_POST['new'],PASSWORD_DEFAULT).'" where mail_user="'.$_SESSION['m_user'].'"');
        header('Location: ../login.html');
    }
    else{
        echo 'F';
        http_response_code(404);
    }
}
else{
    http_response_code(404);
}

?>