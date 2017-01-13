<?php
session_start();
require_once("inc/connect.php");
require_once("inc/functions.php");
if(isset($_POST['submit']) && isset($_SESSION['login_user'])){
		$date = getMyDate();
		$curUser   = $_SESSION['login_user'];
mkAnnouncement($_POST['title'], $_POST['text'],$curUser, $date, $db);
} 
	$db->close();

?>