<?php
session_start();
require_once('inc/functions.php');
if(checkOnline()){
?>
<form method="POST" action="mkAnnounce.php">
Title: <input type="text" name="title"><br /><br />
<textarea cols="60" rows="15" name="text">


</textarea ><br /><br />
<input type="submit" name="submit" value="Post Announcement">
</form>
<a href="index.php">Back</a>
<?php
}else{
	//craft funny responce for this.
	header('location: index.php?wtf=1');
}
?>