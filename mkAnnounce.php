<?php
session_start();
require_once("inc/connect.php");
require_once("inc/functions.php");
if(isset($_POST['submit']) && isset($_SESSION['login_user'])){
		$date = getMyDate();
		$curUser   = $_SESSION['login_user'];
		if(mkAnnouncement($_POST['title'], $_POST['text'],$curUser, $date, $db)) {
			header('Location: index.php');
		} else {
			header('Location: index.php?wtf=2');
		}

} 
	$db->close();

?>