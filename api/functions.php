<?php
include 'server_info.php';

function session_issruning(){
    if ((isset($_SESSION['m_user']))==False){
        session_start();
    }
}

function isloged(){
    global $conn;global $db_name,$db_user,$db_password,$db_link;
    if (isset($_SESSION['m_user']) and isset($_SESSION['m_password'])){
        $conn=mysqli_connect($db_link,$db_user,$db_password,$db_name);
        $query=mysqli_query($conn,'SELECT mail_user,mail_password FROM mail');
        $cnt=mysqli_num_rows($query);
        $count=0;
        $count=0;
        $selfUrl=$_SERVER['HTTP_HOST'].preg_split('/mailbox|send_m.php/',$_SERVER['PHP_SELF'])[0];
        while ($i=mysqli_fetch_array($query,MYSQLI_ASSOC)){
            if ($_SESSION['m_user']==$i['mail_user'] or $_SESSION['m_user'].'@'.$selfUrl==$i['mail_user']){
                if (password_verify($_SESSION['m_password'],$i['mail_password'])){
                    return 1;
                }
                else{
                    return 0;
                }
            }
            else{
                $count=$count+1;
                if ($count==$cnt){
                    return 0;
                    break;
                }
            }
        }
    }
    else{
        return 0;
    }
}
?>
