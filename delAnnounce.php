<?php
session_start();
require_once('inc/connect.php');
require_once('inc/functions.php');

if(checkOnline()){

//if user is logged in then execute this html.
if(isset($_GET['id']) && is_numeric($_GET['id'])){
	$user = $_SESSION['login_user'];
	$id =mysqli_real_escape_string($db,htmlentities($_GET['id']));
	$sql = "DELETE FROM announcement WHERE annID='$id' AND annUser='$user'";
	$result = $db->query($sql);
	if (mysqli_num_rows($result) > 0 ) {
   		header("Location: index.php");
	} else {
	    header("Location: index.php?wtf=3");
	}
}

}
?>