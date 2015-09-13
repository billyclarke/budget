<?php
session_start();
require_once("db.php");
$sql = 'SELECT `id` FROM `budget_users` WHERE 1 AND `name` = \''.$_POST["name"].'\' AND `password` = \''.md5($_POST["password"]).'\' AND `deleted` = \'no\' LIMIT 0, 1';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
if(mysqli_num_rows($result) == 0){
	die("Incorrect password");
}
if(md5($_POST["password"]) == md5("SPEC Events")){
	header("Location: reset_password.php?name=".$_POST["name"]."&committee=".$_POST['auth']);
}
$_SESSION['s_name'] = $_POST['name'];
$_SESSION['s_comp'] = $_POST['comp'];
$_SESSION['s_auth'] = $_POST['auth'];
?>
<html>
	<head>
		<title>SPEC Budget Login</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
	</head>
	<body onload="<?php
		if($_POST['auth'] != "Admin"){
			echo "top.location = 'home.php";
		}else{
			echo "top.location = 'admin.php";
		}
		?>'">
	<a href="home.php">Click here if you are not automaticly forwarded</a>
	</body>
</html>
