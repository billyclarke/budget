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
	$url = "add_expense.php?paid_date=".$_POST["paid_date"]."&item=".$_POST["item"]."&vendor=".$_POST["vendor"]."&cost=".$_POST["cost"]."&expense=".$_POST["expense"]."&main=".$_POST["main"]."&sub=".$_POST["sub"]."&validate_error=".$validate_error."&committee=".$_POST['committee']."&note=".$_POST['note'];
	header("Location: ".$url);
	die();
}

require_once("check_auth.php");
require_once("functions.php");
$today = date("Y-m-d");
$date = $_POST['paid_date'];
$date = substr($date,6,4)."-".substr($date,0,2)."-".substr($date,3,2);
$committee_id = get_committee_id($_POST['committee']);
$user_id = get_user_id($_POST['requestor']);
$category_id = get_category_id($_POST['main'], $committee_id);
$type_id = get_type_id($_POST['expense']);
$sql = 'INSERT INTO `budget_transactions` (`id`, `committee_id`, `submitted_date`, `requestor_id`, `action_date`, `item`, `vendor`, `cost`, `category_id`, `subcategory`, `type_id`, `treasurer_approved`,`note`) VALUES (\'\', \''.$committee_id.'\', \''.$today.'\', \''.$user_id.'\', \''.$date.'\', \''.$_POST['item'].'\', \''.$_POST['vendor'].'\', \'-'.$_POST['cost'].'\', \''.$category_id.'\', \''.$_POST['sub'].'\', \''.$type_id.'\', \'no\',\''.$_POST['note'].'\');';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
$item_id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);


$sql = 'SELECT `cost` FROM `budget_transactions` WHERE 1 AND `committee_id` = \''.get_committee_id($_POST['committee']).'\' AND `deleted` = \'no\' AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\'';
$result_budget = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
$total_budget = 0;
$total_expenses = 0;
while($row = mysqli_fetch_array($result_budget)){
	if($row[0] > 0){
		$total_budget = $total_budget + $row[0];
	}else{
		$total_expenses = $total_expenses + $row[0];
	}
}
if($total_budget == 0){
	$total_budget = .001;
}
if(abs($total_expenses/$total_budget) > 1){
	$warning1 = $_POST['committee']." is overbudget by $".number_format(abs($total_budget+$total_expenses),2)." (".round(abs(100*$total_expenses/$total_budget)-100)."%)";
	$sql = 'INSERT INTO `warning` (`id`, `committee`, `warning`, `treasurer_cleared`, `advisor_cleared`) VALUES (\'\', \''.$_POST['committee'].'\', \''.((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $warning1) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")).'\', \'no\', \'no\');';
	$result1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	//echo mysql_result();
}elseif(abs($total_expenses/$total_budget) > .9){
	$warning1 =  $_POST['committee']." has spent ".round(abs(100*$total_expenses/$total_budget))."% of their total budget";
	$sql = 'INSERT INTO `warning` (`id`, `committee`, `warning`, `treasurer_cleared`, `advisor_cleared`) VALUES (\'\', \''.$_POST['committee'].'\', \''.((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $warning1) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")).'\', \'no\', \'no\');';
	$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	//echo mysql_result();
}else{
}
$sql = 'SELECT `cost` FROM `budget_transactions` WHERE 1 AND `committee_id` = \''.get_committee_id($_POST['committee']).'\' AND `category_id` = \''.get_category_id($_POST['main']).'\' AND `deleted` = \'no\' AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\'';
$result_sub = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
$sub_budget = 0;
$sub_expenses = 0;
while($row = mysqli_fetch_array($result_sub)){
	if($row[0] > 0){
		$sub_budget = $sub_budget + $row[0];
	}else{
		$sub_expenses = $sub_expenses + $row[0];
	}
}
if($sub_budget == 0){
	$sub_budget = .001;
}
if(abs($sub_expenses/$sub_budget) > 1){
	$warning2 = $_POST['main']." (".$_POST['committee'].") is overbudget by $".number_format(abs($sub_budget+$sub_expenses),2)." (".round(abs(100*$sub_expenses/$sub_budget)-100)."%)";
	$sql = 'INSERT INTO `warning` (`id`, `committee`, `warning`, `treasurer_cleared`, `advisor_cleared`) VALUES (\'\', \''.$_POST['committee'].'\', \''.((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $warning2) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")).'\', \'no\', \'no\');';
	$result3 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
}elseif(abs($sub_expenses/$sub_budget) > .9){
	$warning2 = $_POST['committee']." has spent ".round(abs(100*$sub_expenses/$sub_budget))."% of ".$_POST['main']."'s budget";
	$sql = 'INSERT INTO `warning` (`id`, `committee`, `warning`, `treasurer_cleared`, `advisor_cleared`) VALUES (\'\', \''.$_POST['committee'].'\', \''.((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $warning2) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : "")).'\', \'no\', \'no\');';
	$result4 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
}else{
}

$url = "";
if($_POST["expense"] == "Purchasing Card"){
	$url = "onload=\"window.location = 'createpcard.php?id=".$item_id."'\"";
}
if($_POST["expense"] == "Budget Transfer"){
	$url = "onload=\"window.location = 'createbudgetxfer.php?id=".$item_id."'\"";
}
if($_POST["expense"] == "Reimbursement"){
	$url = "onload=\"window.location = 'createreimbursement.php?id=".$item_id."'\"";
}
if($_POST["expense"] == "Petty Cash"){
	$url = "onload=\"window.location = 'createpettycash.php?id=".$item_id."'\"";
}
?>
<html>
	<head>
		<title>Thank you for your submission</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
	</head>
	<body <?php echo $url; ?>>
		<h2>Thank you for your submission</h2>
		<p>Please remember to submit the proper OSA paperwork as well.</p>
		<h2><?php echo $warning1; ?></h2>
		<h2><?php echo $warning2; ?></h2>
	</body>
</html>
