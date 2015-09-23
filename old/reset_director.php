<?php
require_once("check_auth.php");
require_once("db.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
if(!$_GET['id']){
$committee = $_GET["committee"];
$committee_id = get_committee_id($committee);
$sql = 'SELECT `id`,`name` FROM `budget_users` WHERE 1 AND `committee_id` = \''.$committee_id.'\' AND `deleted` = \'no\' ORDER BY `name` ASC';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
?>
<html>
	<head>
		<title>Delete Director</title>
		<script type="text/javascript">
			function gourl(id, item){
				if(confirm("Reset "+item+"'s (<?php echo $_GET["committee"]; ?>) password?")){
					this.location = "reset_director.php?committee=<?php echo $committee; ?>&committee=<?php echo $_GET["committee"]; ?>&id="+id;
				}
			}
		</script>
		<style>
			a{
				color: black;
				text-decoration: none;
			}	
			a:visited{
				color: black;
			}
			a:hover{
				text-decoration: underline;
			}
		</style>
	</head>
	<body>
		<h3>Reset password (<?php echo $_GET['committee']; ?>)</h3>
		<p>
			<ul>
				<?php
				while($row = mysqli_fetch_array($result)){
					echo "<li><a href='javascript:;' onclick='gourl(".$row[0].",\"".$row[1]."\");'>".$row[1]."</a></li>";
				}
				?>
			</ul>
		</p>
	</body>
</html>
<?php
}else{
	$sql = "UPDATE directors SET `password` = '954410f8c3784f2a8c87aeab8a1f60f8' WHERE `id` = '".$_GET['id']."'";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	header("Location: committee_budget.php?committee=".$_GET['committee']);
}
?>
