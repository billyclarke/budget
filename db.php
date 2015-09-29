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

//================================================
// Category
//================================================

function get_category_id($category_name, $committee_id){
  $sql = 'SELECT `id` FROM `budget_categories` WHERE 1 AND `committee_id` = \''.$committee_id.'\' AND `name` = \''.$category_name.'\' AND `deleted` = \'no\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_category_string($category_id){
  $sql = 'SELECT `name` FROM `budget_categories` WHERE 1 AND `id` = \''.$category_id.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

//================================================
// Committee
//================================================

function get_committee_id($committee_name){
  $sql = 'SELECT `id` FROM `budget_committees` WHERE 1 AND `fullname` = \''.$committee_name.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  if ($row[0] === ""){
    die("Could not get ID for committee: ".$committee_id);
  }
  return $row[0];
}

function get_committee_string($committee_id){
  $sql = 'SELECT `fullname` FROM `budget_committees` WHERE 1 AND `id` = \''.$committee_id.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_committees(){
	$sql = 'SELECT `fullname` FROM `budget_committees` ORDER BY `fullname` ASC';
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$committees_temp[$i] = $row[0];
		$i++;
	}
	//Remove duplicate entries
	$committees = array_keys(array_flip($committees_temp));
	return $committees;
}

//================================================
// User
//================================================

function get_user_id($user_name){
  $sql = 'SELECT `id` FROM `budget_users` WHERE 1 AND `name` = \''.$user_name.'\' AND `deleted` = \'no\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_user_string($user_id){
  $sql = 'SELECT `name` FROM `budget_users` WHERE 1 AND `id` = \''.$user_id.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_user_email($user_id){
  //TODO(wclarke): Implement
  return '';
}

function get_committee_id_for_user_id($user_id){
  $sql = 'SELECT `committee_id`, FROM `budget_users` WHERE `id` = \''.$user_id.'\' AND `deleted` = \'no\' LIMIT 0,1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_user_id_name_for_committee_id($committee_id){
  $sql = 'SELECT `id`, `name` FROM `budget_users` WHERE `committee_id` = \''.$committee_id.'\' AND `deleted` = \'no\' ORDER BY `name`';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  return to_2d_array($result);
}

function to_2d_array($result){
  $rows = array();
  $i = 0;
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
    $rows[$i++] = $row;
  }
  return $rows;
}


function check_user_password($user_id, $password){
  $sql = 'SELECT `id` FROM `budget_users` WHERE `id` = \''.$user_id.'\' AND `password` = \''.encrypt_user_password($password).'\' AND `deleted` = \'no\' LIMIT 0,1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  return (mysqli_num_rows($result) == 1);
}

function encrypt_user_password($password){
  return md5($password);
}

//================================================
// Type
//================================================

function get_type_id($type_string){
  if ($type_string == "ProCard"){
    return 1;
  }
  $sql = 'SELECT `id` FROM `budget_transaction_types` WHERE 1 AND `name` = \''.$type_string.'\' LIMIT 1'; 
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_type_string($type_id){
  $sql = 'SELECT `name` FROM `budget_transaction_types` WHERE 1 AND `id` = \''.$type_id.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

?>
