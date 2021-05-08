<?php

/**
 * Create Channel Script
 * Internal Module
 * Version: 0.1
 * 
 * Requisites:
 * MYSQL TABLE CALLED
 * mail_lists
*/

$about='
The groupd are mailing 
list, you can create one,
you can join, see a exacly
message etc...
';

include '../api/server_info.php';
include '../api/functions.php';

session_issruning();

$conn=mysqli_connect($db_link,$db_user,$db_password,$db_name);
$query=mysqli_query($conn,'CREATE TABLE mail_lists(channel_name VARCHAR(20), channel_admin VARCHAR(150), channel_users VARCHAR(10000))');

if (isLoged()==1){
	if (isset($_POST['newname'])){
		$query=mysqli_query($conn,'SELECT channel_name FROM mail_lists WHERE channel_name="'.$_POST['newname'].'"');
		if (mysqli_num_rows($query)==0){
			echo 'Name Avaible';
			if (isset($_POST['admin'])){
				if (is_dir(preg_split('/@/',$_POST['admin'])[0])){
					echo '<br>All Ok';
					mysqli_query($conn,'INSERT INTO mail_lists(channel_name,channel_admin,channel_users) values("'.$_POST['newname'].'","'.$_POST['admin'].'","")');
					echo '<br>Created';
					mkdir($_POST['newname']);
					mkdir($_POST['newname'].'/mails');
					touch($_POST['newname'].'/index.php');
					file_put_contents($_POST['newname'].'/index.php','<?php $type="GROUP"; ?>');
				}
				else{
					header('Location: ../login.php');
				}
			}
		}
		else{
			echo 'Name is already using';
		}
	}
	else{
		header('Location: ../new_channel.php?info=<text>Please_provide_a_name</text>');
	}
}
else{
	header('Location: ../login.php');
}

?>
