<?php
session_start();
//setcookie("PHPSESSID",$_COOKIE['PHPSESSID'],time()+1800);
$comp_auth = $_SESSION['s_comp'];

$comp_auth ="SPEC_OSL";
if($comp_auth != "SPEC_OSL"){
	die("Not authorized - This application can only be used from computers inside of the SPEC office.");
}
$auth_com = $_SESSION['s_auth'];
if(!$auth_com){
	die("Not authorized - You need to be logged in to use this page.");
}

if($_SESSION['s_auth'] != "Admin"){
	if($_GET['committee'] != "" && $_GET['committee'] != $_SESSION['s_auth']){
		die("You are not authorized to view this page with your credentials.");
	}
}
?>