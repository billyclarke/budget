<?php
session_start();
require_once("db.php");
$user_id = $_POST["user_id"];
if(!check_user_password($user_id, $_POST["password"])){
	header("Location: ./?loginretry=y");
  die("Incorrect Password");
}

$_SESSION['s_user_id'] = $user_id;
$_SESSION['s_committee_id'] = get_committee_id_for_user_id($user_id);

if(md5($_POST["password"]) == md5("SPEC Events")){
	header("Location: reset_password.php?name=".$_POST["name"]."&committee=".$_POST['auth']);
}

	header("Location: ./");
?>

<a href="index.php">Click here if you are not automaticly forwarded</a>
