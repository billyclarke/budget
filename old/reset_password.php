<?php
require_once("db.php");
if($_POST['old'] != ""){
	if($_POST['old'] != "SPEC Events"){
		die();
	}
	if($_POST['password'] != $_POST['password2']){
		die("Passwords do not match");
	}
  $committee = $_POST['committee'];
  $committee_id = get_committee_id($committee);
	$sql = "UPDATE budget_users SET `password` = '".md5($_POST['password'])."' WHERE `password` = '".md5($_POST['old'])."' AND `name` = '".$_POST['name']."' AND `committee_id` = '".$committee_id."'";
	//echo $sql;
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	header("Location: index.php?auth=".$_POST['committee']."&comp=SPEC_OSL");
}
?>
<html>
	<head>
		<title>Reset Password</title>
		<script>
			function checkform(what){
				if(what.password.value != what.password2.value){
					alert("Passwords do not match");
					what.password.value = "";
					what.password2.value = "";
					return false;
				}
				return true;
			}
		</script>
		<link type="text/css" rel="stylesheet" href="style.css" />
	</head>
	<body>
		<br />
		<br />
		<br />
		<form action="reset_password.php" method="post" onsubmit="return checkform(this);">
			<input type="hidden" name="name" value="<?php echo $_GET['name']; ?>" />
			<input type="hidden" name="committee" value="<?php echo $_GET['committee']; ?>" />
			<div align="center">
				<div style="border: thin solid rgb(0,0,0); width:220px; height: 80px;">
					<div style="height: 2px;"></div>
						<table>
							<tr>
								<td>Old Password</td>
								<td><input type="password" name="old" /></td>
							</tr>
							<tr>
								<td>New Password</td>
								<td><input type="password" name="password" /></td>
							</tr>
							<tr>
								<td>New Password (repeat)&nbsp;</td>
								<td><input type="password" name="password2" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" value="Submit" /></td>
							</tr>
						</table>
					</div>
				</div>
		</form>
	</body>
</html>
