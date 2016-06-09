<?php
session_start();
if($_GET['destroy'] == "yes"){
	session_destroy();
	die("You have been logged out.");
}
require_once("db.php");
if(!$_GET['auth']){
?>
<html>
  <head>
    <title>SPEC Budget</title>
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <style>a{font-size:large}</style>
  </head>
  <body>
    <br>
    <center style="font-size:large">Select a committee</center>
    <br>
    <center><a href="?auth=Admin&comp=SPEC_OSL">Admin</a></center>
    <center><a href="?auth=Art Gallery&comp=SPEC_OSL">Art Collective</a></center>
    <center><a href="?auth=Concerts&comp=SPEC_OSL">Concerts</a></center>
    <center><a href="?auth=Connaissance&comp=SPEC_OSL">Connaissance</a></center>
    <center><a href="?auth=Film&comp=SPEC_OSL">Film</a></center>
    <center><a href="?auth=Jazz and Grooves&comp=SPEC_OSL">Jazz and Grooves</a></center>
    <center><a href="?auth=Special Events&comp=SPEC_OSL">Pop Up</a></center>
    <center><a href="?auth=Sound&comp=SPEC_OSL">Sound</a></center>
    <center><a href="?auth=SPEC-TRUM&comp=SPEC_OSL">SPEC-TRUM</a></center>
    <center><a href="?auth=Spring Fling&comp=SPEC_OSL">Spring Fling</a></center>
  </body>
</html>

<?php
} else {
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
                  $committee_id = get_committee_id($_GET['auth']);
									$sql = "SELECT `name` FROM `budget_users` WHERE 1 AND `committee_id` = '".$committee_id."' AND `deleted` = 'no' ORDER BY `name`";
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
<?php
}
?>
