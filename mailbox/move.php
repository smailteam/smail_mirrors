<?php
include '../api/functions.php';
session_issruning();
if (isloged()==1){
    if (isset($_GET['id']) and  isset($_GET['to']) and isset($_GET['from'])){
        if (is_dir($_SESSION['m_user'].'/'.$_GET['from'])){
            if (file_exists($_SESSION['m_user'].'/'.$_GET['from']).$_GET['id'] and strpos($_GET['to'],'..')==false and strpos($_GET['to'],'/')==false and strpos($_GET['to'],'\\')==false and strpos($_GET['from'],'..')==false and strpos($_GET['from'],'\\')==false and strpos($_GET['from'],'/')==false){
                rename($_SESSION['m_user'].'/'.$_GET['from'].'/'.$_GET['id'],$_SESSION['m_user'].'/'.$_GET['to'].'/'.$_GET['id']);
                echo 'Success';
            }
            else{
                http_response_code(500);
                echo 'Parameter "From" was incorrect';
            }
        }
        else{
            http_response_code(500);
            echo $_GET['from'].' box dont exists';
        }
    }
    else{
        http_response_code(500);
        echo 'We dont have all the required information';
        print_r($_GET);
    }
}
else{
    header('Location: ../login.php');
}