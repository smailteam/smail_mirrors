    <head>
        <link rel='stylesheet' type='text/css' href='css/all.css'>
    </head>
    <body>
        <?php
        $xmlDoc=simplexml_load_file('sitemap.xml');
        foreach ($xmlDoc as $node){
            echo '<a href="'.$node->link.'">'.$node->name.'</a><br>';
        }
        ?>
    </body>
</html>