<?php include '../i18n.class.php'; $i18n = new i18n('../lang/lang_{LANGUAGE}.ini'); $i18n->init();?>
<?php
ini_set('display_errors',1);
ini_set('display_initial_errors',1);
error_reporting(E_ALL);

include '../api/server_info.php';

if (strpos('@',$_POST['mail'])){
    header('../new_user.php?info='.L::new_aroba);
}
elseif (isset($_POST['mail']) and isset($_POST['password'])){
    $conn=mysqli_connect($db_link,$db_user,$db_password,$db_name);
    $selfUrl=$_SERVER['HTTP_HOST'].preg_replace('/mailbox\/new_user.php/','',$_SERVER['PHP_SELF']);
    $query=mysqli_query($conn,'SELECT mail_user FROM mail WHERE mail_user="'.$_POST['mail'].'@'.$selfUrl.'"');
    print_r($query);
    if (mysqli_connect_error()){
        http_response_code(500);
		header('Location: new_user.php?info=<text>DB_error</text>');
    }
    elseif (mysqli_num_rows($query)==0){
        mkdir($_POST['mail']);
        mkdir($_POST['mail'].'/mails');
        mkdir($_POST['mail'].'/readed');
		touch($_POST['mail'].'/index.php');
        $query=mysqli_query($conn,'INSERT INTO mail(mail_user,mail_password) VALUES("'.$_POST['mail']."@".$selfUrl.'","'.password_hash($_POST['password'],PASSWORD_DEFAULT).'")');
        header('Location: ../login.php?info=<text>'.L::new_user.' '.$_POST['mail'].'@'.$selfUrl.'</text>');
    }
    else{
        header('Location: ../new_user.php?info=<text>'.L::new_already.' '.$_POST['mail'].'@'.$selfUrl.'</text>');
    }
}
else{
    header('Location: ../index.php');
}
?>
