<?php

/**
 * Is my Channel?
 * Internal Module
 * Version: 0.1
 * 
 * Requisites:
 * MYSQL TABLE CALLED
 * mail_lists
 * 
 * AND ALL THE 
 * CHANNELS MODULES
*/

/** Basic Start */
include '../api/server_info.php';
include '../api/functions.php';
/** Finish */

/** Create $conn var */
$conn=mysqli_connect($db_link,$db_user,$db_password,$db_name);

/** Verifyng the sended data */
if (isset($_POST['mail']) and isset($_POST['channel']) and isset($_POST['hash'])){
    /** Query */
    $query=mysqli_query($conn,'SELECT * FROM mail_lists WHERE channel_name="'.$_POST['channel'].'" AND channel_admin="'.$_POST['mail'].'"');
    /** Verifyng the query */
    if (!(gettype($query)=='boolean')){
        if (!(mysqli_num_rows($query)==0)){
            /** Extracting the data */
            $data=mysqli_fetch_array($query,MYSQLI_ASSOC);
            if ($data['channel_name']==$_POST['channel']){
                http_response_code(200);
                echo '200';
            }
            else{
                http_response_code(500);
            }
        }
        else{
            http_response_code(500);
        }
    }
    else{
        http_response_code(500);
    }
}
else{
    http_response_code(500);
}

/** ALL THE 500 RESPONSES ARE RECOGNIZED AT reicive.php */
?>