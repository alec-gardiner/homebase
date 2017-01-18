<?php
session_start();
require_once('inc/connect.php');
require_once('inc/functions.php');

if(checkOnline()){
	if(isset($_POST['submit'])){
$title = mysqli_real_escape_string($db, htmlentities($_POST['title']));
$content = mysqli_real_escape_string($db, htmlentities($_POST['text']));
$date = getMydate();
$sql = "UPDATE announcement set annTitle='$title', annContent='$content', annDate='$date'";

	if ($db->query($sql) === TRUE){
		header("Location: profile.php?update2");
	} else {
echo "something wrong.";
}
	}else{
		if(isset($_GET['id']) && is_numeric($_GET['id'])){
			$id =mysqli_real_escape_string($db,htmlentities($_GET['id']));
			$user = $_SESSION['login_user'];
			$sql = "SELECT * FROM announcement WHERE annID = $id AND annUser = '$user'";
			$result = mysqli_query($db,$sql);
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		?>

<form method="POST" action="updateAnnouncement.php">
Title: <input type="text" value="<?php echo $row['annTitle']; ?>" name="title"><br /><br />
<textarea cols="60" rows="15" name="text">
<?php
echo $row['annContent'];
?>
</textarea ><br /><br />
<input type="submit" name="submit" value="update Announcement">
</form>
<a href="profile.php">Back</a>


<?php
				}
			} else { header("Location: index.php?wtf=3"); }
		}
	}
}
?>