<xml>
        <?php
        header('Content-type: application/xml');
        require '../api/functions.php';
        session_issruning();
        if (isloged()==1){
            if (isset($_GET['box']) and strpos($_GET['box'],'..')==false and strpos($_GET['box'],'\\')==false and strpos($_GET['box'],'/')==false){
                if (isset($_GET['delthem'])){
                    if (strpos($_GET['delthem'],'/') or strpos($_GET['delthem'],'..') or strpos($_GET['delthem'],'\\')){}
                    else{
                        try{unlink(preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['box'].'/'.$_GET['delthem']);echo '   <info>Deleted</info>';}catch(Exception $e){echo '   <info>ID Invalid</info>';}
                    }
                }
                elseif(isset($_GET['id'])){
                    try{include preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['box'].'/'.$_GET['id']; echo '<box>'.$_GET['box'].'</box>';echo '   <data>'.str_replace('<','&lt;',$html).'</data>';echo '  <sender>'.$sender.'</sender>';echo '  <date>'.$date.'</date>';}catch (Exception $e){echo '   <info>ID Invalid</info>';}
                }
            }
            else{
                if (isset($_GET['delthem'])){
                    if (strpos($_GET['delthem'],'/') or strpos($_GET['delthem'],'..') or strpos($_GET['delthem'],'\\')){}
                    else{
                        try{unlink(preg_split('/@/',$_SESSION['m_user'])[0].'/mails/'.$_GET['delthem']);echo '  <info>Succes</info>';}catch(Exception $e){echo '    <info>ID Invalid</info>';}
                    }
                }
                elseif(isset($_GET['id'])){
                    try{include preg_split('/@/',$_SESSION['m_user'])[0].'/mails/'.$_GET['id'];echo '   <data>'.str_replace('<','&lt;',$html).'</data>';echo '  <sender>'.$sender.'</sender>';echo '  <date>'.$date.'</date>';}catch (Exception $e){echo '  <info>ID Invalid</info>';}
                }
            }
        }
        else{
            http_response_code(404);
        }

        ?>
</xml>
