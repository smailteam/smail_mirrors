<?php include 'i18n.class.php'; $i18n = new i18n(); $i18n->init();?>
<html>
    <head>
        <title>Register Smail</title>
        <link type='text/css' rel='stylesheet' href='css/send.css?v=1'/>
        <link type='text/css' rel='stylesheet' href='css/all.css?v=2'/>
        <style type='text/css'>
        input{
            display: block;
        }
        </style>
    </head>
    <body>
        <?php
            if (isset($_GET['info'])){
                echo str_replace('_',' ',$_GET['info']);
            }
        ?>
        <form action='mailbox/new_user.php' method='POST'>
            <input type="text" name="mail" id="mail" placeholder="Mail">
            <input type="password" name="password" class='center' id="" placeholder="Password">
            <input type="submit" value=<?php echo L::reg_submit;?> class='submit'>
        </form>
    </body>
</html>