<?php
require_once("db.php");
require_once("check_auth.php");
require_once("functions.php");
if($_GET['committee'] == "Admin"){
	die("The Admin usergroup does not have an associated budget.");
}
if(!$_POST['committee']){
?>
<html>
	<head>
		<title>Search</title>
	</head>
	<body>
		<h3>Build <?php echo $_GET['committee']; ?> Seach Query</h3>
		<form action="search.php" method="post">
			<input type="hidden" name="committee" value="<?php echo $_GET['committee']; ?>" />
			<table>
				<?php
					for($i = 0; $i < 3; $i++){
				?>
				<tr>
					<td>Where</td>
					<td>
						<select name="f<?php echo $i; ?>">
							<option value="item">Item</option>
							<option value="vendor">Vendor</option>
							<option value="type">Type</option>
						</select>	
					</td>
					<td> is like </td>
					<td><input type="text" name="in<?php echo $i; ?>" /></td>
				<td><select name="ao<?php echo $i; ?>"><option>OR</option><option>AND</option></select></td>
				</tr>
				<?php
					}
				?>
				<tr><td colspan="4">Use % for a wildcard</td><td><input type="submit" value="Submit" /></td></tr>
			</table>
		</form>
<?php
}else{
	$sql = 'SELECT `type`,`date`,`item`,`vendor`,`cost`,`main`,`sub` FROM `budget` WHERE 1 AND `committee` = \''.$_POST["committee"].'\'';
	if(!($_POST['in0'] == "" && $_POST['in1'] == "" && $_POST['in2'] == "")){
		$sql .= " AND ";
	}
	for($i = 0; $i < 3; $i++){
		if($_POST['in'.$i] != ""){
			$sql .= "`".$_POST['f'.$i]."` LIKE '".$_POST['in'.$i]."' ";
			$temp_var = 'in'.($i+1);
			if($_POST[$temp_var] != ""){
				$sql .= " ".$_POST['ao'.$i]." ";
			}
		}
	}
	$sql .= ' AND `deleted` = \'no\' AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\' ORDER BY `date` DESC';
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	?>
	<html>
		<head>
			<title>Search Results</title>
		</head>
		<body>
			<h3>Search Results</h3>
			<table class="ex" cellspacing="0" border="1" cellpadding="3">
					<tr>
						<td align="center"><b>Type</b></td>
						<td align="center"><b>Date</b></td>
						<td align="center"><b>Item</b></td>
						<td align="center"><b>Vendor</b></td>
						<td align="center"><b>Debits</b></td>
						<td align="center"><b>Credits</b></td>
						<td align="center"><b>Main Catagory</b></td>
						<td align="center"><b>Sub Catagory</b></td>
					</tr>
		<?php
				while($row = mysqli_fetch_array($result)){
					echo "
					<tr>
						<td>".$row[0]."&nbsp;</td>
						<td>".$row[1]."&nbsp;</td>
						<td>".$row[2]."&nbsp;</td>
						<td>".$row[3]."&nbsp;</td>";
					if($row[4] < 0){
						echo "
						<td>$".number_format(abs($row[4]),2)."</td>
						<td>&nbsp;</td>
						";
					}else{
						echo "
						<td>&nbsp;</td>
						<td>$".number_format(abs($row[4]),2)."</td>
						";
					}
						
					echo "
						<td>".$row[5]."&nbsp;</td>
						<td>".$row[6]."&nbsp;</td>
					</tr>
					";
				}
				echo "</table>";
		}
		?>
		<p></p>
		<?php require_once("conf.php"); ?>
	</body>
</html>