<?php
$servername = "localhost";
$username = "user";
$password = "pass";
$dbname = "mybd";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$mysqli) {
  die("Connection failed: " . mysqli_connect_error());
}

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

$mysqli->close();
?>

