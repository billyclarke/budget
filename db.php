<?php
	// CONFIGURE THE DB ACCESS
require_once("dbpass.php");
$dbhost = 'localhost';
$dbuser = 'speceven_budget';
$dbname = "speceven_budget";
$dbConnect = ($GLOBALS["___mysqli_ston"] = mysqli_connect($dbhost,  $dbuser,  $dbpass, $dbname));
if (!$dbConnect) {
   die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
}

?>
