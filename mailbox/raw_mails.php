<?php
function scan_dir($dir) {
    $ignored = array('.', '..', '.htaccess','index.php','getmail.php');
    $files = array();    
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
            $files[$file] = filemtime($dir . '/' . $file);
        }
        arsort($files);
        $files = array_keys($files);
        return ($files) ? $files : false;
}
include '../api/functions.php';
session_issruning();
if (isloged()==1){
    if (isset($_GET['box'])){
        if (strpos($_GET['box'],'/') or strpos($_GET['box'],'..') or strpos($_GET['box'],'\\')){}
        else{
            if ($_GET['box']==''){$_GET['box']=='mails';}
            echo 'Raw Box of '.preg_split('/@/',$_SESSION['m_user'])[0].'\\'.$_GET['box'].'\\<br>';
            foreach (scan_dir(getcwd().'\\'.preg_split('/@/',$_SESSION['m_user'])[0].'\\'.$_GET['box'].'\\') as $d){
                include preg_split('/@/',$_SESSION['m_user'])[0].'\\'.$_GET['box'].'\\'.$d;
                try{echo '<a href="getmail.php?box='.$_GET['box'].'&id='.$d.'">'.$sender.'</a> '.$date.'<br>';}catch (Exception $e){echo '<a href="getmail.php?id='.$d.'">'.$sender.'</a> <br>';}
            }
        }
    }
    else{
        foreach (scan_dir(getcwd().'\\'.preg_split('/@/',$_SESSION['m_user'])[0]) as $d){
            foreach (scan_dir(getcwd().'\\'.preg_split('/@/',$_SESSION['m_user'])[0].'\\'.$d.'\\') as $i){
                include preg_split('/@/',$_SESSION['m_user'])[0].'\\'.$d.'\\'.$i;
                echo '<a href="getmail.php?id='.$i.'">'.$sender.'</a> '.$date.' '.$d.'<br> ';
            }
        }
    }
}
else{
    header('Location: ../login.php');
}
?>