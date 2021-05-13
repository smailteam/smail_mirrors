<!-- {version:<?php echo file_get_contents('VERSION');?>} --->
<?php include 'i18n.class.php'; $i18n = new i18n(); $i18n->init();?>
<html>
    <head>
        <title>SecureMail</title>
        <link rel='stylesheet' type='text/css' href='css/index.css?v=1'>
        <link type='text/css' rel='stylesheet' href='css/all.css?v=1'/>
    </head>
    <body style='margin: 0px;'>
        <div style='color: white; background: #30303c; padding: 1%;'>
            <h1 style='margin: 0px;'><?php echo L::index_welcome;?></h1>
            <hr>
        </div>
        <div class="sitemap"><a href='map.php'>SiteMap</a> - <a href='login.php'>Login</a> - <a href='new_user.php'>Register</a> - <a href="https://reisub.nsupdate.info/git/?p=smail.git/.git">Git</a> - <a href="https://reisub.nsupdate.info/bugs/">Bugs</a></div>
        <div class="tag">
            <h1 style='margin: 0px;'><?php echo L::index_about;?></h1>
            <hr>
            <text><?php echo L::index_about_c;?></text>
        </div>
        <div class="tag">
            <h1 style='margin: 0px;'><?php echo L::index_license;?></h1>
            <hr>
            <text><?php echo L::index_license_c;?></text>
        </div>
    </body>
</html>
