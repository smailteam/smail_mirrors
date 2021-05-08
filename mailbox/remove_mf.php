<?php
/** BASIC INIT */
include '../api/functions.php';
session_issruning();
$log=isloged();
if ($log==1 and isset($_GET['folder'])){
    if ($_GET['folder']=='mails' or $_GET['folder']=='readed'){
        /** Protected Folders */
        echo 'You cannot delete the mailbox '.$_GET['folder'];
    }
    elseif (is_dir(preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['folder'])){
        /** Recursive deletion to the folder */
        $dir=preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['folder'];
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
                    RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dir);
        echo 'Folder deleted';
    }
    else{
        /** Informs to the user, what that folder not exists */
        echo 'Folder not exists';
    }
}
else{
    if ($log==0){
        /** If you not are login redirect or more knowledge with 301-302 HTTP ERROR*/
        header('Location: ../login.php');
    }
    else{}
}