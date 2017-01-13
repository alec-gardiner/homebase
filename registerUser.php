<?php
session_start();
if(!isset($_SESSION['login_user'])){
	require_once('inc/connect.php');
	require_once('inc/functions.php');

	register($_POST['username'], $_POST['password'], $_POST['passwordConfirm'], $db);
} else {
	header('location: index.php');
}
?>