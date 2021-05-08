<?php
include '../api/server_info.php';
if (isset($_POST['mail'])){
    if (file_exists(preg_split('/@/',$_POST['mail'])[0].'/index.php')){
		$conn=mysqli_connect($db_link,$db_user,$db_password,$db_name);
        echo $_POST['mail'];
		$query=mysqli_query($conn,'SELECT mail_password FROM mail where mail_user="'.$_POST['mail'].'"');
		$i=mysqli_fetch_array($query,MYSQLI_ASSOC);
        if ($_POST['hash']==$i['mail_password']){
            http_response_code(200);
        }
        else{
			$query=mysqli_query($conn,'SELECT channel_name FROM mail_lists WHERE channel_name="'.$_POST['mail'].'"');
			if (gettype($query=='boolean')){
				http_response_code(400);
			}
			else{
				http_response_code(200);
			}
        }
    }
    else{
        http_response_code(500);
    }
}
else{
    http_response_code(400);
}

?>
