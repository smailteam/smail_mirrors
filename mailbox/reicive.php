<?php 
function string($length = 30) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);} 

if (isset($_POST['mail']) and $_POST['to'] and isset($_POST['html']) and isset($_POST['hash'])){
    $mail=['mail'=>$_POST['mail'], 'hash'=>$_POST['hash']];
    $other=array(
        CURLOPT_URL => 'https://'.preg_split('/@/',$_POST['mail'])[1].'/mailbox/user.php',
        CURLOPT_POST => true,
        CURLOPT_SSLCERT => '',
        CURLOPT_POSTFIELDS => $mail,
        CURLOPT_RETURNTRANSFER => true
    );
    $curl=curl_init();
    curl_setopt_array($curl, ($other));
    $out=curl_exec($curl);
    if (curl_error($curl)){
        http_response_code(400);
    }
    else{
        $info=curl_getinfo($curl,CURLINFO_HTTP_CODE);
  		echo $info;
	    if ($info==200){
            if (file_exists($_POST['to'].'/index.php')){
				$date=date('d/m/Y H:i:s');
                $content='<?php
$html="'.'<!version=0.1>'.str_replace('"',"'",$_POST['html']).'";
$sender="'.$_POST['mail'].'";
$date="'.$date.'";
?>';
                file_put_contents($_POST['to'].'/mails/'.string().'.php',$content);
                http_response_code(200);
            }
            else{
                http_response_code(404);
            }
        }
        else{
            echo $out;
            http_response_code(500);
        }
    }
    curl_close($curl);
}
else{
    http_response_code(404);
}
?>
