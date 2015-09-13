<?php
require_once("form_validate.php");
$validated = "yes";
$validate_error = "";
//Validate paid date
if(!$_POST["paid_date"]){
	$validate_error .= "Please enter the date this item was paid for.<br />";
	$validated = "no";
}else{
	$v = check_date($_POST["paid_date"]);
	if($v != "yes"){
		$validate_error .= $v;
		$validated = "no";
	}
}
$v = "";

//Validate item
if(!$_POST["item"]){
	$validate_error .= "Please enter the item.<br />";
	$validated = "no";
}

//Validate vendor
if(!$_POST["vendor"]){
	$validate_error .= "Please enter the item's vendor.<br />";
	$validated = "no";
}

//Validate cost
if(!$_POST["cost"]){
	$validate_error .= "Please enter the cost of the item.<br />";
	$validated = "no";
}
$v = check_cost($_POST["cost"]);
if($v != "yes"){
	$validate_error .= $v;
	$validated = "no";
}
$v = "";

//Validate expense type
if(!$_POST["expense"]){
	$validate_error .= "Please enter the expense type.<br />";
	$validated = "no";
}

//Validate expense type
if(!$_POST["main"]){
	$validate_error .= "Please enter the main category.<br />";
	$validated = "no";
}

//Validate expense type
if(!$_POST["sub"]){
	$validate_error .= "Please enter the sub category.<br />";
	$validated = "no";
}

if($validated == "no"){
	$url = "add_payment.php?paid_date=".$_POST["paid_date"]."&item=".$_POST["item"]."&vendor=".$_POST["vendor"]."&cost=".$_POST["cost"]."&expense=".$_POST["expense"]."&main=".$_POST["main"]."&sub=".$_POST["sub"]."&validate_error=".$validate_error."&committee=".$_POST['committee']."&note=".$_POST['note'];
	header("Location: ".$url);
	die();
}

require_once("check_auth.php");
require_once("db.php");
$today = date("Y-m-d");
$date = $_POST['paid_date'];
$date = substr($date,6,4)."-".substr($date,0,2)."-".substr($date,3,2);
$committee_id = get_committee_id($_POST['committee']);
$requestor_id = get_user_id($_POST['requestor']);
$category_id = get_category_id($_POST['main'], $committee_id);
$type_id = get_type_id($_POST['expense']);
$sql = 'INSERT INTO `budget` (`id`, `committee_id`, `submitted_date`, `requestor_id`, `action_date`, `item`, `vendor`, `cost`, `category_id`, `subcategory`, `type_id`, `treasurer_approved`, `note`) VALUES (\'\', \''.$committee_id.'\', \''.$today.'\', \''.$requestor_id.'\', \''.$date.'\', \''.$_POST['item'].'\', \''.$_POST['vendor'].'\', \''.$_POST['cost'].'\', \''.$category_id.'\', \''.$_POST['sub'].'\', \''.$type_id.'\', \'no\',\''.$_POST['note'].'\');';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
?>
<html>
	<head>
		<title>Thank you for your submission</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
	</head>
	<body>
		<h2>Thank you for your submission</h2>
		<p>Please remember to submit the proper OSL paperwork as well.</p>
	</body>
</html>
