<?php
session_start();
require_once('inc/connect.php');
require_once('inc/functions.php');
if(checkOnline()){
	echo greeting();


}else{
	//put in funny error for this responce.
	header("Location: login.php?wtf=1");
}

?>