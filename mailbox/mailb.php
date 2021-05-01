<?php
ini_set('display_errors',1);
ini_set('display_initial_errors',1);
error_reporting(E_ALL);
require '../api/functions.php';
session_issruning();
if (isloged()==0){
    header('Location: ../login.php');
    die();
}
?>
<?php include '../i18n.class.php'; $i18n = new i18n('../lang/lang_{LANGUAGE}.ini'); $i18n->init();?>
<html>
    <head>
        <link type='text/css' rel='stylesheet' href='../css/all.css'/>
        <link type='text/css' rel='stylesheet' href='../css/mailbox.css?v=1'/>
    </head>
    <body>
        <h1>Mail Box <?php if(isset($_GET['box'])==true){echo $_GET['box'];}?></h1>
        <?php
        if (isset($_GET['info'])){
            echo str_replace('_',' ',$_GET['info']);
			echo '<br>';
        }
        function scan_dir($dir) {
            $ignored = array('.', '..', '.htaccess','mailb.php','getmail.php');
            $files = array();
            foreach (scandir($dir) as $file) {
                if (in_array($file, $ignored)) continue;
                    $files[$file] = filemtime($dir . '/' . $file);
                }
                arsort($files);
                $files = array_keys($files);
                return ($files) ? $files : false;
        }
        if (isloged()==1){
            if (isset($_GET['box'])){
                if (is_dir(preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['box']) and strpos($_GET['box'],'/')==false and strpos($_GET['box'],'..')==false or strpos($_GET['box'],'\\')==false){
                    $dirs=scan_dir(getcwd().'/'.preg_split('/@/',$_SESSION['m_user'])[0].'/'.$_GET['box']);
                    if (($dirs==false)==false){
                        foreach ($dirs as $i){
                            $date='';
                            include preg_split('/@/',$_SESSION['m_user'])[0].'/mails/'.$i;
                            echo '<span class="mail"><a href="getmail.php?box='.$_GET['box'].'&id='.$i.'">'.$sender.'</a> <text>'.str_replace('-','/',$date).'</text> <a href="getmail.php?delthem='.$i.'">Delete</a></span><br>
';
                        }
                    }
                }
            }
            else{
                $dirs=scan_dir(getcwd().'/'.preg_split('/@/',$_SESSION['m_user'])[0].'/mails/');
                if (($dirs==false)==false){
                    foreach ($dirs as $i){
                        $date='';
                        include preg_split('/@/',$_SESSION['m_user'])[0].'/mails/'.$i;
                        echo '<span class="mail"><a href="getmail.php?id='.$i.'">'.$sender.'</a> <div class="go"><text>'.str_replace('-','/',$date).'</text> <a href="getmail.php?delthem='.$i.'">Delete</a></div></span><br>
';
                    }
                }
                else{
                    echo '<text>'.L::mbox_dhave.'<br></text>';
                }
            }
        }
        else{
            http_response_code(404);
        }

        ?>
	<text><?php echo L::mbox_note;?></text>
    <br><a href='../send_m.php'><?php echo L::mbox_send;?></a><text> <?php echo L::mbox_or;?> </text><a href='../ch_p.php'><?php echo L::mbox_change;?></a>
	</body>
</html>
