<?php
include 'functions.php';
include 'server_info.php';
session_issruning();
if (isset($_POST['mail']) and isset($_POST['password'])){
    $conn=mysqli_connect($db_link,$db_user,$db_password,$db_name);
    $query=mysqli_query($conn,'SELECT mail_user,mail_password FROM mail');
    $cnt=mysqli_num_rows($query);
    $count=0;
    $selfUrl=$_SERVER['HTTP_HOST'].preg_replace('/api\/login.php/','',$_SERVER['PHP_SELF']);
    while ($i=mysqli_fetch_array($query,MYSQLI_ASSOC)){
        if($_POST['mail'].'@'.$selfUrl==$i['mail_user']){
            if (password_verify($_POST['password'],$i['mail_password'])){
                echo json_encode('{password:200}');
                $_SESSION['m_user']=$_POST['mail'].'@'.$selfUrl;
                $_SESSION['m_password']=$_POST['password'];
                header('Location: ../mailbox/mailb.php?info=<text>Succefully_Loged</text>');
            }
            else{
                http_response_code(404);
                echo json_encode('{password:404}');
                header('Location: ../login.php?info=<text>The_user_or_password_was_incorrect</text>');
            }
        }
        elseif ($_POST['mail']==$i['mail_user']){
            if (password_verify($_POST['password'],$i['mail_password'])){
                echo json_encode('{password:200}');
                $_SESSION['m_user']=$_POST['mail'];
                $_SESSION['m_password']=$_POST['password'];
				header('Location: ../mailbox/mailb.php?info=<text>Succefully_Loged</text>');
            }
            else{
                http_response_code(404);
                echo json_encode('{password:404}');
                header('Location: ../login.php?info=<text>The_user_or_password_was_incorrect</text>');
            }
        }
        else{
            $count=$count+1;
            if ($count==$cnt){
                http_response_code(500);
                echo json_encode('{user: 500}');
                break;
                header('Location: ../login.php?info=<text>The_user_or_password_was_incorrect</text>');
            }
        }
    }
}
else{
    echo json_encode('{code: 400}');
}
?>
