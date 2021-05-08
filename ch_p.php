<?php
include 'api/functions.php';
session_issruning();
if (isLoged()==0){
    header('Location: login.php');
}
?><html>
    <head>
        <title>Login Smail</title>
        <link type='text/css' rel='stylesheet' href='css/all.css'/>
        <link type='text/css' rel='stylesheet' href='css/send.css'/>
        <style type='text/css'>
        input{
            display: block;
        }
        </style>
    </head>
    <body>
        <form action='mailbox/change_p.php' method='POST'>
            <input type="text" name="old" id="old" placeholder="Old">
            <input type="text" name="new" id="new" placeholder="New" class="center">
            <input type="submit" value="Change" class="submit">
        </form>
    </body>
</html>
