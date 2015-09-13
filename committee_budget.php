<?php
require_once("check_auth.php");
require_once("db.php");
$committee = $_GET['committee'];
require_once("functions.php");
if($committee == "Admin"){
	die("The Admin usergroup does not have an associated budget.");
}
?>
<html>
	<head>
		<title><?php echo $committee; ?> Budget</title>
		<style type="text/css">
			a{
				color: black;
				text-decoration: none;
			}
			a:hover{
				color: black;
				text-decoration: underline;
			}
			a:visited{
				color: black;
			}
			table.ex{
				color:#000000;
				background-color:#ffffff;
				font-size: 100%;
				padding:0px;
				border-top: 1px solid black;
				border-left: 1px solid black;
				border-bottom: 1px solid black;
				border-right: 1px solid black;
			}
		</style>
	</head>
	<body>
		<?php
			$sql = 'SELECT `warning` FROM `warning` WHERE 1 AND `committee` = \''.$committee.'\' AND `treasurer_cleared` = \'no\' AND `advisor_cleared` = \'no\' ORDER BY `id` DESC LIMIT 0, 5';
			$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			if(mysqli_num_rows($result) > 0){
				?>
				<div style="border: thin solid rgb(0,0,0); width:400px;">
					<table width="100%">
						<tr>
							<td bgcolor="red">&nbsp;<b>Warnings</b></td>
						</tr>
				<?php
				while($row = mysqli_fetch_array($result)){
					echo "<tr><td>&nbsp;".$row[0]."</td></tr>";
				}
				echo "</table></div>";
			}
		?>
		<table>
		<?php
		$item_count = 1;
		$sub_budgets = "";
		$total_budget = 0;
		$total_costs = 0;
		$sql = 'SELECT `item` FROM `budget_item` WHERE 1 AND `committee` = \''.$committee.'\' AND `deleted` = \'no\' ORDER BY `item` ASC';
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		while($row = mysqli_fetch_array($result)){
			$item_count++;
			$budget = 0;
			$expenses = 0;
			$sql = 'SELECT `cost`,`type` FROM `budget` WHERE 1 AND `committee` = \''.$committee.'\' AND `main` = \''.$row[0].'\' AND `deleted` = \'no\' AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\'';
			$result_2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			while($row_2 = mysqli_fetch_array($result_2)){
				if($row_2[0] < 0){
					if($row_2[1] == "Internal Budget Transfer"){
						$budget = $budget + $row_2[0];
					}else{
						$expenses = $expenses + $row_2[0];
					}
				}else{
					$budget = $budget + $row_2[0];
				}
			}
			$sub_budgets = $sub_budgets."<tr><td>".draw_expense($expenses,$budget,$row[0],'budget_breakdown.php?committee='.$committee.'&main='.$row[0])."</td></tr>";
			$total_costs = $total_costs + $expenses;
			$total_budget = $total_budget + $budget;
		}
		echo "<tr><td height='100px'>".draw_expense($total_costs, $total_budget, $committee." Total Budget",'')."</td>";
		$sql = 'SELECT `type`,`date`,`item`,`vendor`,`cost`,`main`,`sub` FROM `budget` WHERE 1 AND `committee` = \''.$committee.'\' AND `deleted` = \'no\' AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\' ORDER BY `date` DESC LIMIT 0, 15';
		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		echo "<td rowspan='".$item_count."' valign='top'>";
		?>
		<div style="height: 0px;"></div>
		<h3>Last 15 Expenses/Payments</h3>
		<table class="ex" cellspacing="0" border="1" cellpadding="3">
			<tr>
				<td align="center"><b>Type</b></td>
				<td align="center"><b>Date</b></td>
				<td align="center"><b>Item</b></td>
				<td align="center"><b>Vendor</b></td>
				<td align="center"><b>Debits</b></td>
				<td align="center"><b>Credits</b></td>
				<td align="center"><b>Main Category</b></td>
				<td align="center"><b>Sub Category</b></td>
			</tr>
		<?php
		while($row = mysqli_fetch_array($result)){
			echo "
			<tr>
				<td>".stripslashes(ucwords($row[0]))."&nbsp;</td>
				<td>".stripslashes(ucwords($row[1]))."&nbsp;</td>
				<td>".stripslashes(ucwords($row[2]))."&nbsp;</td>
				<td>".stripslashes(ucwords($row[3]))."&nbsp;</td>";
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
				<td>".stripslashes(ucwords($row[5]))."&nbsp;</td>
				<td>".stripslashes(ucwords($row[6]))."&nbsp;</td>
			</tr>
			";
		}
		echo "</table></td>";
		echo "<td rowspan='".$item_count."' valign='top'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
		echo $sub_budgets;
		?>
	</table>
	<p><a href="generate_excel.php?main=<?php echo $committee; ?>">Download Excel Budget File</a></p>
	<br />
	<?php require_once("conf.php"); ?>
	</body>
</html>
