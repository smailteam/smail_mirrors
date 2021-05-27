<?php
$mysqli=new mysqli('localhost', 'user', 'user_password', 'bd_name');
$mysqli->query("SET NAMES 'utf8'");
echo "Usuarios SMail Stable\n";
$q=$mysqli->query("SELECT mail_user FROM mail WHERE mail_user LIKE '%smail.%'");
while($r=$q->fetch_assoc()) {
    print_r($r);
}
echo "Usuarios SMail Dev\n";
$q=$mysqli->query("SELECT mail_user FROM mail WHERE mail_user LIKE '%reisub.%'");
while($r=$q->fetch_assoc()) {
    print_r($r);
}
echo "Canales/Grupos SMail Stable\n";
$q=$mysqli->query("SELECT * FROM mail_lists WHERE channel_admin LIKE '%smail.%'");
while($r=$q->fetch_assoc()) {
    print_r($r);
}
echo "Canales/Grupos SMail Dev\n";
$q=$mysqli->query("SELECT * FROM mail_lists WHERE channel_admin LIKE '%reisub.%'");
while($r=$q->fetch_assoc()) {
    print_r($r);
}
mysql_close($mysqli);
?>
