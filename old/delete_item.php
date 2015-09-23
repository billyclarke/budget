<?php
require_once("check_auth.php");
require_once("db.php");
require_once("functions.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
$sql = "UPDATE budget_transactions SET `deleted` = 'yes' WHERE `id` = '".$_GET['id']."'";
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

$sql = 'SELECT `vendor` FROM `budget_transactions` WHERE 1 AND `id` = '.$_GET["id"].' AND `type` = \'Internal Budget Transfer\' LIMIT 0, 1';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
if(mysqli_num_rows($result) == 1){
	$row = mysqli_fetch_array($result);
	$sql = "UPDATE budget_transactions SET `deleted` = 'yes' WHERE `id` = '".$row[0]."'";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
}
header("Location: budget_breakdown.php?committee=".$_GET['committee']."&main=".$_GET['main']);
?>
