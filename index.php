<?php
session_start();
if($_GET['destroy'] == "yes"){
	session_destroy();
	die("You have been logged out.");
}
require_once("db.php");
if($_GET['comp'] != "SPEC_OSL"){
	die("Not authorized - This application can only be used from computers inside of the SPEC office.");
}
if(!$_GET['auth']){
	die("No committee specified.");
}
?>
<html>
	<head>
		<title>SPEC Budget Login</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
	</head>
	<body>
		<br />
		<br />
		<br />
		<form action="login.php" method="post" target="_top">
			<input type="hidden" name="comp" value="<?php echo $_GET['comp']; ?>" />
			<input type="hidden" name="auth" value="<?php echo $_GET['auth']; ?>" />
			<div align="center">
				<div style="border: thin solid rgb(0,0,0); width:170px; height: 60px;">
					<div style="height: 2px;"></div>
				<table>
					<tr>
						<td>User</td>
						<td>
							<select name="name" style="width: 110px">
								<?php
									$sql = "SELECT `name` FROM `directors` WHERE 1 AND `committee` = '".$_GET['auth']."' AND `deleted` = 'no' ORDER BY `name`";
									$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
									while($row = mysqli_fetch_array($result)){
										echo "<option>".$row[0]."</option>";
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Password&nbsp;&nbsp;</td>
						<td><input type="password" name="password" style="width: 110px" /></td>
					</tr>
				</table>
				<input type="submit" value="Submit" />
				</div>
		</div>
			</form>
	</body>
</html>