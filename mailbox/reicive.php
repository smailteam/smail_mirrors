<?php 
/** CREATES THE STRING ID */
function string($length = 30) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}
/** INTERNAL MODULE */

/** INCLUDING THE USER INFO */
require $_POST['to'].'/index.php';

/** Verifing the posted data */
if (isset($_POST['mail']) and $_POST['to'] and isset($_POST['html']) and isset($_POST['hash']) and $type=='GROUP'){
        /** Creating an array for send the data to the supposed server */
    $mail=['mail'=>$_POST['mail'], 'hash'=>$_POST['hash'],'channel'=>preg_split('/@/',$_POST['to'])[0]];
    /** Configuring cURL with an array */
    $other=array(
        CURLOPT_URL => 'https://'.preg_split('/@/',$_POST['mail'])[1].'/mailbox/user.php',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $mail,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false
    );
    /** INIT CURL */
    $curl=curl_init();
    /** SETTING THE ARRAY */
    curl_setopt_array($curl, ($other));
    /** RUN */
    $out=curl_exec($curl);
    /** CHEKING RESPONSE */
    if (curl_error($curl)){
        http_response_code(400);
    }
    else{
        /** GETTING CODE */
        $info=curl_getinfo($curl,CURLINFO_HTTP_CODE);
	    if ($info==200){
            if (file_exists($_POST['to'].'/index.php')){
                /** SAVING FILE */
				$date=date('d/m/Y H:i:s');
                $content=$date=date('d/m/Y H:i:s');
                file_put_contents(preg_split('/@/',$_POST['to'])[0].'/mails/'.(string()).'.php','<?php
$date="'.$date.'";
$chname="'.preg_split('/@/',$_POST['mail'])[0].'";
$content="'.$_POST['html'].'";
if (basename(__FILE__)==basename($_SERVER["SCRIPT_FILENAME"])){
    include "../../../api/functions.php";
    return_plant_group($content,$date,$chname);
}
?>');
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
    /** CLOSING */
    curl_close($curl);
}
elseif (isset($_POST['mail']) and $_POST['to'] and isset($_POST['html']) and isset($_POST['hash']) and $type=='CHANNEL'){
    /** Creating an array for send the data to the supposed server */
    $mail=['mail'=>$_POST['mail'], 'hash'=>$_POST['hash'],'channel'=>preg_split('/@/',$_POST['to'])[0]];
    /** Configuring cURL with an array */
    $other=array(
        CURLOPT_URL => 'https://'.preg_split('/@/',$_POST['mail'])[1].'/mailbox/ismch.php',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $mail,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false
    );
    /** INIT CURL */
    $curl=curl_init();
    /** SETTING THE ARRAY */
    curl_setopt_array($curl, ($other));
    /** RUN */
    $out=curl_exec($curl);
    /** CHEKING RESPONSE */
    if (curl_error($curl)){
        http_response_code(400);
    }
    else{
        /** GETTING CODE */
        $info=curl_getinfo($curl,CURLINFO_HTTP_CODE);
	    if ($info==200){
            if (file_exists($_POST['to'].'/index.php')){
                /** SAVING FILE */
				$date=date('d/m/Y H:i:s');
                $content=$date=date('d/m/Y H:i:s');
                file_put_contents(preg_split('/@/',$_POST['to'])[0].'/mails/'.(string()).'.php','<?php
$date="'.$date.'";
$chname="'.preg_split('/@/',$_POST['mail'])[0].'";
$content="'.$_POST['html'].'";
if (basename(__FILE__)==basename($_SERVER["SCRIPT_FILENAME"])){
    include "../../../api/functions.php";
    return_plant($content,$date,$chname);
}
?>');
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
    /** CLOSING */
    curl_close($curl);
}
elseif (isset($_POST['mail']) and $_POST['to'] and isset($_POST['html']) and isset($_POST['hash'])){
    /** Creating an array for send the data to the supposed server */
    $mail=['mail'=>$_POST['mail'], 'hash'=>$_POST['hash']];
    /** Configuring cURL with an array */
    $other=array(
        CURLOPT_URL => 'https://'.preg_split('/@/',$_POST['mail'])[1].'/mailbox/user.php',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $mail,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false
    );
    /** INIT CURL */
    $curl=curl_init();
    /** SETTING THE ARRAY */
    curl_setopt_array($curl, ($other));
    /** RUN */
    $out=curl_exec($curl);
    /** CHEKING RESPONSE */
    if (curl_error($curl)){
        http_response_code(400);
    }
    else{
        /** GETTING CODE */
        $info=curl_getinfo($curl,CURLINFO_HTTP_CODE);
  		echo $info;
	    if ($info==200){
            if (file_exists($_POST['to'].'/index.php')){
                /** SAVING FILE */
				$date=date('d/m/Y H:i:s');
                $content='<?php
$html="'.str_replace('"',"'",$_POST['html']).'";
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
    /** CLOSING */
    curl_close($curl);
}
else{
    http_response_code(404);
}
?>
