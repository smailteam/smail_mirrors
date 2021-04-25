<?php
include '../api/functions.php';
if (isset($_POST['content']) and isset($_POST['mail_r'])){
    session_issruning();
    if (isloged()==1){
        $split=preg_split('/@/',$_POST['mail_r']);
        $cnt=count($split);
        if ($cnt==2){
            $query=mysqli_query($conn,'SELECT mail_password FROM mail WHERE mail_user="'.$_SESSION['m_user'].'"');
            $hash=mysqli_fetch_array($query,MYSQLI_ASSOC)['mail_password'];
            $mail=['mail'=>$_SESSION['m_user'],'html'=>$_POST['content'],'hash'=>$hash,'to'=>preg_split('/@/',$_POST['mail_r'])[0]];
            $other=array(
                CURLOPT_URL => 'https://'.$split[1].'mailbox/reicive.php',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $mail,
                CURLOPT_RETURNTRANSFER => true
            );
            echo 'Sending sm to the url '.$split[1];
            echo '<br> and to the mail id '.$split[0];
            $curl=curl_init();
            curl_setopt_array($curl, ($other));
            $out=curl_exec($curl);
            echo curl_error($curl);
            if (curl_error($curl)){
                echo json_encode('{end: 400}');
            }
            else{
                $info=curl_getinfo($curl,CURLINFO_HTTP_CODE);
				echo $info;
                if ($info==200){
                    echo json_encode('{code:200, detail=mail sended}');
                }
                else{
                    echo json_encode('{code:404, detail=error}');
                }
            }
        }
        elseif ($cnt==1){
            $selfUrl=$_SERVER['HTTP_HOST'].preg_replace('/mailbox\/send.php/','',$_SERVER['PHP_SELF']);
            $query=mysqli_query($conn,'SELECT mail_password FROM mail WHERE mail_user="'.$_SESSION['m_user'].'"');
            $hash=mysqli_fetch_array($query,MYSQLI_ASSOC)['mail_password'];
            $mail=['mail'=>$_SESSION['m_user'],'html'=>$_POST['content'],'hash'=>$hash,'to'=>$split[0]];
            $other=array(
                CURLOPT_URL => 'https://'.$selfUrl.'mailbox/reicive.php',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $mail,
                CURLOPT_RETURNTRANSFER => true
            );
            echo 'Sending sm to the url '.$selfUrl;
            echo '<br> and to the mail id '.$split[0];
            $curl=curl_init();
            curl_setopt_array($curl, ($other));
            $out=curl_exec($curl);
            echo curl_error($curl);
            if (curl_error($curl)){
                echo json_encode('{end: 400}');
            }
            else{
                echo $out;
                $info=curl_getinfo($curl,CURLINFO_HTTP_CODE);
                echo $info;
                echo $out;
                if ($info==200){
                    echo json_encode('{code:200, detail=mail sended}');
                }
                else{
                    echo json_encode('{code:404, detail=error}');
                }
            }
        }
    }
    else{
        echo json_encode('{code:500, detail=unknow login}');
    }
}

?>
