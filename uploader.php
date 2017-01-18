<?php
session_start();
require_once("inc/connect.php");
require_once("inc/functions.php");
if(checkOnline()){
	$current_user = $_SESSION['login_user'];
	$target_dir = "images/userSchedules/";
	$target_file = $target_dir . basename($_FILES["schedule"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	
	$check = getimagesize($_FILES["schedule"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
	}
 // Check file size
	if ($_FILES["schedule"]["size"] > 1024000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	if($imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
	&& $imageFileType != "GIF" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif") {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["schedule"]["tmp_name"], $target_file)) {
	        $sql = "UPDATE users SET userSchLocation='$target_file', userHasSch=1 where userName = '$current_user'";
	        if ($db->query($sql) === TRUE) {
	        		header('Location: profile.php?update=1');
			} else {
    				header('Location: profile.php?wtf=1');
			}

			$db->close();
	    } else {
	       			header('Location: profile.php?wtf=2');
	    }
	}
} else {
					header('Location: index.php?wtf=1');
}
?>