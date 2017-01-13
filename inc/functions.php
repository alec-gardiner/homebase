<?php

function getMyDate(){
	$weekDay   = date("l");
	$monthNum  = date("m");
	$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
	$monthDay  = date('d');
	$date      = $weekDay . ", " . $monthName . " " . $monthDay;

	return $date;
}

function greeting(){
	$username = ucfirst($_SESSION['login_user']);
$nav = ' &nbsp;|&nbsp;<a href="profile.php"> My Profile</a> &nbsp;| &nbsp;<a href="announcement.php">Make Announcement</a>&nbsp;| &nbsp;<a href="logout.php">Logout</a>';
$greeting = "Welcome, " . $username . $nav;
return $greeting;
}

function checkOnline(){
if(isset($_SESSION['login_user'])){
	return true;
} else {
	return false;
}

}



function login($username, $password, $db){

	$username = mysqli_real_escape_string($db, htmlspecialchars($username));
	$password = mysqli_real_escape_string($db, htmlspecialchars($password));
	//$salt = "semzPsurN8FZJfaEWYFLp4AKRtxwRw==";
	//$hash = crypt($password, '$2y$10$'.$salt.'$');
	$sql = "SELECT * FROM users WHERE userName = '$username' LIMIT 1";
	$result = $db->query($sql);
	$result = mysqli_query($db,$sql);

	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$salt = $row['userSalt'];
	$userPassword = $row['userPassword'];

	$count = mysqli_num_rows($result);

	if($count == 1) {
		$hash = crypt($password, '$2y$10$'.$salt.'$');

		$sql = "SELECT * FROM users WHERE userPassword = '$hash'";
		$result = $db->query($sql);
		$result = mysqli_query($db,$sql);

		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);

		if($count == 1){
			$_SESSION['login_user']= $row['userName'];
			header("Location: index.php");
		}
	}
}
function logout(){
	if(isset($_SESSION['login_user'])){
unset($_SESSION['login_user']);

header('Location: index.php?logout');
}
}
function mkAnnouncement($title, $content, $curUser, $date, $db){

	$title     =  mysqli_real_escape_string($db, htmlspecialchars($_POST['title']));
	$content   =  mysqli_real_escape_string($db, htmlspecialchars($_POST['text']));


//echo $curUser;

	$sql = "INSERT INTO announcement (annTitle, annContent, annUser, annDate, is_visable)
	VALUES ('$title', '$content', '$curUser', '$date', 1)";

	if ($db->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $db->error;
	}



}

function register($username, $password, $confPassword, $db){
	$username = mysqli_real_escape_string($db,	$username);
	$password = mysqli_real_escape_string($db, $password);
	$confPassword = mysqli_real_escape_string($db, $confPassword);
	if($password === $confPassword){
	$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
	$salt = base64_encode($salt);
	$salt = str_replace('+', '.', $salt);
	$hash = crypt($password, '$2y$10$'.$salt.'$');

	$sql = "INSERT INTO users (userName, userPassword, userSalt)
	VALUES ('$username', '$hash', '$salt')";

	if ($db->query($sql) === TRUE) {
	    echo "New record created successfully";
	    $_SESSION['login_user'] = $username;
	    header('location: index.php');

	} else {
	    echo "Error: " . $sql . "<br>" . $db->error;
	}
	$db->close();

	}else{
		//error 1 === Passwords dont match
		header('Location: register.php?error=1');

	}
}

function announce($db){
	$sql = "SELECT annID,annTitle, annContent, annUser, annDate, is_visable FROM announcement WHERE is_visable = 1 ORDER BY annID DESC LIMIT 5";
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
			echo "<br /><hr ><br />";
		}

	}

}

?>