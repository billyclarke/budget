<?php
require_once("check_auth.php");
require_once("db.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
if($_GET['committee'] == "Admin"){
	die("The Admin usergroup does not have an associated budget.");
}
if(!$_POST['committee']){
?>
<html>
	<head>
		<title>Add Budget Item</title>
	</head>
	<body>
		<h3>Add budget item (<?php echo $_GET['committee']; ?>)</h3>
		<p>
			<form action="add_budget_item.php" method="POST">
				<input type="hidden" name="committee" value="<?php echo $_GET['committee']; ?>" />
				Item Name: <input type="text" name="item" /> Budget Code: <input type="text" name="bc" /> <input type="submit" value="Submit" />
			</form>
		</p>
	</body>
</html>
<?php
}else{
$sql = 'INSERT INTO `budget_categories` (`id`, `committee_id`, `name`, `budget_code` , `deleted`) VALUES (\'\', \''.get_committee_id($_POST["committee"]).'\', \''.$_POST["item"].'\',\''.$_POST["bc"].'\' , \'no\');';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
header("Location: committee_budget.php?committee=".$_POST['committee']);
}
?>
