<?php
session_start();
require_once('inc/connect.php');
require_once('inc/functions.php');
if(checkOnline()){
	echo greeting();
	$username = $_SESSION['login_user'];
	$sql = "SELECT * from users WHERE userName='$username' AND userHasSch=1";
	$result = $db->query($sql);
	if(isset($_GET['update'])){
		$message = "<br>Schedule uploaded successfully";
	} else {
		$message =  "<br>Your schedule is already uploaded, <a href='profile.php?new'>click here</a> to replace schedule.
					<br />(rename your schedule a different name.)";
	}
	if(!isset($_GET['new'])){
		if($result->num_rows > 0 ){
			echo $message;
		}  else {


	 
	?>

	<form action="uploader.php" method="post" enctype="multipart/form-data" >
	<input type="file" name="schedule" value="browse files" accept="image/*">&nbsp; <input type="submit" value="upload schedule"> 
	</form>


	<?php
	}
} else {
	?>

	<form action="uploader.php" method="post" enctype="multipart/form-data" >
	<input type="file" name="schedule" value="browse files" accept="image/*">&nbsp; <input type="submit" value="upload schedule"> 
	</form>

	<?php
}
?>
<h1> Your Announcements!</h1>
<hr>

<?php
$sql = "SELECT annID,annTitle, annContent, annUser, annDate, is_visable FROM announcement WHERE annUser = '$username' ORDER BY annID DESC LIMIT 5";
$result = mysqli_query($db,$sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<h2 style='font-size:250%; margin:10px; margin-bottom:-15px; padding:5px; line-height: 0.5em;'>".ucfirst($row['annTitle'])."</h2>";
			echo "<br /><hr ><br />";
			echo $row['annContent'];
			echo "<br /><br />";
			echo "Posted by: " . ucfirst($row['annUser']);
			echo "<br /><br />";
			echo $row['annDate'];
			echo " &nbsp;|&nbsp;<a href='updateAnnouncement.php?id=".$row['annID']."'>Update</a> &nbsp;|&nbsp; <a href='delAnnounce.php?id=".$row['annID']."'>Delete</a>";
			echo "<br /><hr ><br />";
		}
	}
} else{
	//put in funny error for this responce.
	header("Location: login.php?wtf=1");
}

?>