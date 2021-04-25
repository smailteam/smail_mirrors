<?php include '../i18n.class.php'; $i18n = new i18n('../lang/lang_{LANGUAGE}.ini'); $i18n->init();?>
<html>
    <head>
        <link type='text/css' rel='stylesheet' href='../css/all.css'/>
        <link type='text/css' rel='stylesheet' href='../css/mailbox.css'/>
    </head>
    <body>
        <?php

        require '../api/functions.php';
        session_issruning();
        if (isloged()==1){
            if (isset($_GET['box']) and strpos($_GET['box'],'..')==false and strpos($_GET['box'],'\\')==false and strpos($_GET['box'],'/')==false){
                if (isset($_GET['delthem'])){
                    if (strpos($_GET['delthem'],'/') or strpos($_GET['delthem'],'..') or strpos($_GET['delthem'],'\\')){}
                    else{
                        try{unlink(preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['box'].'/'.$_GET['delthem']);echo '<text>'.L::gmail_success.', </text><a href="mailb.php">'.L::gmail_return.'</a>';}catch(Exception $e){echo '<a href="mailb.php">'.L::gmail_return.'</a>';}
                    }
                }
                elseif(isset($_GET['id'])){
                    try{include preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['box'].'/'.$_GET['id'];echo '<text>'.L::gmail_sender.': '.$sender.'</text><br>';echo '<text>'.L::gmail_content.': '.$html;echo '</text><br><a href="mailb.php">'.L::gmail_return.'</a><text> or </text><a href="move.php?&from='.$_GET['box'].'&to=readed&id='.$_GET['id'].'">'.L::gmail_read.'</a>';}catch (Exception $e){echo L::gmail_invalid_id;}
                }
            }
            else{
                if (isset($_GET['delthem'])){
                    if (strpos($_GET['delthem'],'/') or strpos($_GET['delthem'],'..') or strpos($_GET['delthem'],'\\')){}
                    else{
                        try{unlink(preg_split('/@/',$_SESSION['m_user'])[0].'/mails/'.$_GET['delthem']);echo '<text>'.L::gmail_success.', </text><a href="mailb.php">'.L::gmail_return.'</a>';}catch(Exception $e){echo '<a href="mailb.php">'.L::gmail_return.'</a>';}
                    }
                }
                elseif(isset($_GET['id'])){
                    try{include preg_split('/@/',$_SESSION['m_user'])[0].'/mails/'.$_GET['id'];echo '<text>'.L::gmail_sender.': '.$sender.'</text><br>';echo '<text>'.L::gmail_content.': '.$html;echo '</text><br><a href="mailb.php">'.L::gmail_return.'</a><text> '.L::gmail_or.' </text><a href="move.php?&from=mails&to=readed&id='.$_GET['id'].'">'.L::gmail_read.'</a>';}catch (Exception $e){echo L::gmail_invalid_id;}
                }
            }
        }
        else{
            http_response_code(404);
        }

        ?>
    </body>
</html>
