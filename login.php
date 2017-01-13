<?php
session_start();
require_once('inc/functions.php');
if(checkOnline()){
	header('Location: index.php');
} else {
?>
<form method="POST" action="loginUser.php">
<table>
<tr>
<td>Username:</td> <td><input type="text" name="username"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr><td><input type="submit" value="Login!"></td></tr>
</table>


</form>

<?php
}
?>