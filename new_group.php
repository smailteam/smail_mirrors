<?php
include 'api/functions.php';
session_issruning();
if (isloged()==0){
    header('Location: login.php');
}

?>
<?php include 'i18n.class.php'; $i18n = new i18n(); $i18n->init();?>
<html>
    <head>
        <link type='text/css' rel='stylesheet' href='css/all.css'/>
        <link type='text/css' rel='stylesheet' href='css/send.css'/>
        <style type='text/css'>
        input{
            display: block;
        }
        </style>
    </head>
    <body>
        <form action='mailbox/new_group.php' method='POST'>
            <input type="text" name="newname" placeholder="Name">
            <input type="hidden" name="admin" value="<?php echo $_SESSION['m_user'];?>">
            <input class='submit' type="submit" value=<?php echo L::send_send;?>>
        </form>
    </body>
</html>
