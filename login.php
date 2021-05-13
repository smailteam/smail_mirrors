<?php
ini_set('display_errors',1);
ini_set('display_initial_errors',1);
error_reporting(E_ALL);?>
<?php include 'i18n.class.php'; $i18n = new i18n(); $i18n->init();?>
<html>
    <head>
        <title>Login Smail</title>
        <!-----Alls------>
        <link type='text/css' rel='stylesheet' href='css/all.css?v=4'/>
        <!--Sends Pages-->
        <link type='text/css' rel='stylesheet' href='css/send.css?v=2'/>
        <style type='text/css'>
        input{
            display: block;
        }
        </style>
    </head>
    <body>
        <?php
            if (isset($_GET['info'])){
                echo "<text>".str_replace('_',' ',$_GET['info'])."</text>";
            }
        ?>
        <form action='api/login.php' method='POST'>
            <input type="text" name="mail" id="mail" placeholder="Mail">
            <input type="password" name="password" class='center' id="" placeholder="Password">
            <input type="submit" value=<?php echo L::login_submit;?> class='submit'>
        </form>
        <text style="text-align:center;display:block"><?php echo L::login_or_nu ?></text>
    </body>
</html>
