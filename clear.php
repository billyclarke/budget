<?php
require_once("check_auth.php");
require_once("db.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
$sql = "UPDATE warning SET `treasurer_cleared` = 'yes' WHERE `id` = '".$_GET['id']."'";
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
header("Location: treasurer.php");
?>