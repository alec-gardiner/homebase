<?php
session_start();
require_once('inc/connect.php');
require_once('inc/functions.php');

if(checkOnline()){
	echo greeting();
//if user is logged in then execute this html.
?>

<br />
<br />
<br />
<h1>Announcements</h1>
<?php

echo announce($db);

$db->close();
//otherwise do this execute this html.
}else {
 

?>


<a href="login.php">Login</a><br>
<a href="register.php">Register</a>
<?php

}

?>