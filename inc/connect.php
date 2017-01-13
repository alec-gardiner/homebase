<?php
define("HOSTNAME", "localhost");
define("DATABASE", "homebase");
define("USERNAME", "root");
define("PASSWORD", "");

 $db = mysqli_connect(HOSTNAME,USERNAME,PASSWORD, DATABASE);
 
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
?>