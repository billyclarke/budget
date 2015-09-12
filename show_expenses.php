<?php
require_once("check_auth.php");
if(!isset($_GET['committee'])){
	die("No committee selected");
}
require_once("db.php");
$sql = 'SELECT `submitted`,`requestor`,`date`,`item`,`vendor`,`cost`,`main`,`sub`,`type`,`treasurer_approved`,`advisor_approved` FROM `budget` WHERE 1 AND `committee` = \''.$_GET['committee'].'\' ORDER BY `date` ASC LIMIT 0, 30';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
?>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<table>
			<tr>
				<td><b>Date Submitted</b></td>
				<td><b>Requestor</b></td>
				<td><b>Date Paid</b></td>
				<td><b>Item</b></td>
				<td><b>Vendor</b></td>
				<td><b>Cost</b></td>
				<td><b>Main Catagory</b></td>
				<td><b>Sub Catagory</b></td>
				<td><b>Expense Type</b></td>
				<td><b>Treasurer Approved</b></td>
				<td><b>Advisor Approved</b></td>
			</tr>
			<?php
			while($row = mysqli_fetch_array($result)){
			?>
			<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><?php echo $row[2]; ?></td>
				<td><?php echo $row[3]; ?></td>
				<td><?php echo $row[4]; ?></td>
				<td><?php echo $row[5]; ?></td>
				<td><?php echo $row[6]; ?></td>
				<td><?php echo $row[7]; ?></td>
				<td><?php echo $row[8]; ?></td>
				<td><?php echo $row[9]; ?></td>
				<td><?php echo $row[10]; ?></td>
			</tr>
			<?php
			}
			?>
		</table>
	</body>
</html>