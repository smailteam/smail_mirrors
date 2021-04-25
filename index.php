<!-- {instance:Smail,version:0.3} --->
<?php include 'i18n.class.php'; $i18n = new i18n(); $i18n->init(); include 'api/server_info.php';?>
<html>
    <head>
        <title>SecureMail</title>
        <link rel='stylesheet' type='text/css' href='css/index.css'>
        <link type='text/css' rel='stylesheet' href='css/all.css'/>
    </head>
    <body style='margin: 0px;'>
        <div style='color: white; background: #30303c; padding: 1%;'>
            <h1 style='margin: 0px;'><?php echo L::index_welcome; echo " ". $instance_name;?></h1>
            <hr>
        </div>
        <div style='color: white; background: #30303c; padding: 1%;'>
            <h1 style='margin: 0px;'><?php echo L::index_register;?></h1>
            <hr>
            <text><?php echo L::index_register_c;?></text>
        </div>
        <div style='color: white; background: #30303c; padding: 1%;'>
            <h1 style='margin: 0px;'><?php echo L::index_about;?></h1>
            <hr>
            <text><?php echo L::index_about_c;?></text>
        </div>
        <div style='color: white; background: #30303c; padding: 1%;'>
            <h1 style='margin: 0px;'><?php echo L::index_how;?></h1>
            <hr>
            <text><?php echo L::index_how_c;?></text>
        </div>
        <div style='color: white; background: #30303c; padding: 1%;'>
            <h1 style='margin: 0px;'><?php echo L::index_where;?></h1>
            <hr>
            <text><?php echo L::index_where_c;?></text>
        </div>
        <div style='color: white; background: #30303c; padding: 1%;'>
            <h1 style='margin: 0px;'><?php echo L::index_license;?></h1>
            <hr>
            <text><?php echo L::index_license_c;?></text>
        </div>
    </body>
</html>