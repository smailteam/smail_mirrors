<?php
ini_set('display_errors',0);
ini_set('display_initial_errors',0);
header('Content-type: application/xml');
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
    echo '<xml>';
    if (isset($_GET['box'])){
        if (strpos($_GET['box'],'/')==True or strpos($_GET['box'],'.')==True or strpos($_GET['box'],'\\')==True){echo 'Dont make this hard';}
        else{
            if ($_GET['box']==''){$_GET['box']=='mails';}
            foreach (scan_dir(getcwd().'\\'.preg_split('/@/',$_SESSION['m_user'])[0].'\\'.$_GET['box'].'\\') as $d){
                include preg_split('/@/',$_SESSION['m_user'])[0].'\\'.$_GET['box'].'\\'.$d;
                echo '  <id id="'.$d.'">';
                echo '      <box>'.$_GET['box'].'</box>';
                echo '      <date>'.$date.'</date>';
                echo '      <sender>'.$sender.'</sender>';
                echo '  </id>';
            }
        }
    }
    else{
        foreach (scan_dir(getcwd().'\\'.preg_split('/@/',$_SESSION['m_user'])[0]) as $d){
            foreach (scan_dir(getcwd().'\\'.preg_split('/@/',$_SESSION['m_user'])[0].'\\'.$d.'\\') as $i){
                include preg_split('/@/',$_SESSION['m_user'])[0].'\\'.$d.'\\'.$i;
                echo '  <id id="'.$i.'">';
                echo '      <box>'.$d.'</box>';
                echo '      <date>'.$date.'</date>'; 
                echo '      <sender>'.$sender.'</sender>';
                echo '  </id>';
            }
        }
    }
    echo '</xml>';
}
else{
    header('Location: ../login.php');
}