<?php
require_once("check_auth.php");
require_once("db.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
if(!$_POST['name']){
?>
<html>
	<head>
		<title>Add Director</title>
	</head>
	<body>
		<h3>Add director (<?php echo $_GET['committee']; ?>)</h3>
		<p>
			<form action="add_director.php" method="POST">
				<input type="hidden" name="committee" value="<?php echo $_GET['committee']; ?>" />
				Name: <input type="text" name="name" /> <input type="submit" value="Submit" />
			</form>
		</p>
		<p>
			All new users are created with the default password of "SPEC Events" (without the quotes) which must be changed upon their first login.
		</p>
	</body>
</html>
<?php
}else{
  $committee_id = get_committee_id($_POST["committee"]);
	$sql = 'INSERT INTO `budget_users` (`id`, `committee_id`, `name`, `password`, `deleted`) VALUES (\'\', \''.$committee_id.'\', \''.$_POST["name"].'\', \'954410f8c3784f2a8c87aeab8a1f60f8\', \'no\');';
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	header("Location: committee_budget.php?committee=".$_POST['committee']);
}
?>
