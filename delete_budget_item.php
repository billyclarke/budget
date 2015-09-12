<?php
require_once("check_auth.php");
require_once("db.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
if($_GET['committee'] == "Admin"){
	die("The Admin usergroup does not have an associated budget.");
}
if(!$_GET['id']){
$sql = 'SELECT `id`,`item` FROM `budget_item` WHERE 1 AND `committee` = \''.$_GET["committee"].'\' AND `deleted` = \'no\' ORDER BY `item` ASC';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
?>
<html>
	<head>
		<title>Delete Budget Item</title>
		<script type="text/javascript">
			function gourl(id, item){
				if(confirm("Delete "+item+" from <?php echo $_GET["committee"]; ?>?")){
					this.location = "delete_budget_item.php?committee=<?php echo $committee; ?>&committee=<?php echo $_GET["committee"]; ?>&id="+id;
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
		<h3>Delete budget item (<?php echo $_GET['committee']; ?>)</h3>
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
	$sql = "UPDATE budget_item SET `deleted` = 'yes' WHERE `id` = '".$_GET['id']."'";
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	header("Location: committee_budget.php?committee=".$_GET['committee']);
}
?>