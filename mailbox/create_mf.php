<?php
include '../api/functions.php';
session_issruning();
$log=isloged();
if ($log==1 and isset($_GET['folder'])){
    if (!is_dir(preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['folder'])){
        mkdir(preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['folder']);
    }
    else{
        echo 'Folder already exists';
    }
}
else{
    if ($log==0){
        header('Location: ../login.php');
    }
    else{}
}