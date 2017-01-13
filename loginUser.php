<?php
session_start();
require_once('inc/connect.php');
require_once('inc/functions.php');
if(isset($_POST['username']) && isset($_POST['password'])){

login($_POST['username'], $_POST['password'], $db);

}

$db->close();




//echo $username . ":" . $password;
?>