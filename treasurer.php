<?php
require_once("check_auth.php");
require_once("db.php");
require_once("functions.php");
require_once("set_dates.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
$committees = get_committees();

$total_costs = 0;
$total_budget = 0;
$sub_budgets = "";
$j = 1;
for($i = 0; $i < sizeof($committees); $i++){
	$budget = 0;
	$expenses = 0;
  $committee = $committees[$i];
  $committee_id = get_committee_id($committee);
	$sql = 'SELECT `cost`,`type_id` FROM `budget_transactions` WHERE 1 AND `committee_id` = \''.$committee_id.'\' AND `deleted` = \'no\' AND `action_date` > \''.$start_date.'\' AND `action_date` < \''.$end_date.'\'';
	$result_2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	while($row_2 = mysqli_fetch_array($result_2)){
    $cost = $row_2[0];
    $type_id = $row_2[1];
		if($cost < 0){
			if($type_id == get_type_id("Internal Budget Transfer")){
				$budget = $budget + $cost;
			}else{
				$expenses = $expenses + $cost;
			}
		}else{
			$budget = $budget + $cost;
		}
	}
	if(($j/2) != floor($j/2)){
		$sub_budgets = $sub_budgets."<tr>";
	}
	$sub_budgets = $sub_budgets."<td>".draw_expense($expenses,$budget,$committee,'committee_budget.php?committee='.$committee,'yes')."</td>";
	if(($j/2) == floor($j/2)){
		$sub_budgets = $sub_budgets."</tr>";
	}
	$j++;
	$total_costs = $total_costs + $expenses;
	$total_budget = $total_budget + $budget;
}
?>
<html>
	<head>
		<title>SPEC Budget Overview</title>
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
		<script type="text/javascript">
			function changecom(committee){
				parent.nav.document.getElementById('committee').value = committee;
				parent.nav.document.getElementById("hide_home").style.visibility = "visible";
				parent.nav.document.getElementById("hide_admin").style.visibility = "visible";
			}	
		</script>
	</head>
	<body>
    <p>Type_id of Purchasing Card is <?php echo get_type_id("Purchasing Card"); ?></p>
		<table>
			<tr>
				<td valign="top">
					<table>
						<?php
							echo "<tr><td>".draw_expense($total_costs, $total_budget,"SPEC Total Budget",'')."</td>";
							echo $sub_budgets;
						?>
					</table>
					<div style="border: thin solid rgb(0,0,0); width:500px;">
						<table width="100%">
							<tr>
								<td bgcolor="lightgreen"><b>Last Database Backup</b></td>
							</tr>
							<tr>
								<td>
								<?php
									require_once('backupDB.config.php');
									require_once('backupDB.functions.php');
									if(file_exists($backupabsolutepath.$fullbackupfilename)) {
										$lastbackuptime = filemtime($backupabsolutepath.$fullbackupfilename);
										echo gmdate('F j, Y g:ia T', $lastbackuptime + date('Z'));
										echo ' (<b>'.FormattedTimeRemaining(time() - $lastbackuptime).'</b> ago)<br />';
										echo '<a href="'.str_replace(@$_SERVER['DOCUMENT_ROOT'], '', $backupabsolutepath).$fullbackupfilename.'">Download previous backup ('.FileSizeNiceDisplay(filesize($backupabsolutepath.$fullbackupfilename), 2).')</a> (right-click, Save As...)';
									}else{
										echo "<a href='backupDB.php' onclick='parent.nav.document.getElementById(\"committee\").value =\"Backup\"'>Backup has not been performed today.</a>";
									}
								?>
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td valign="top">
					<?php
					$check = 0;
						$sql = 'SELECT `warning`, `id`  FROM `warning` WHERE 1 AND `treasurer_cleared` = \'no\' ORDER BY `id` DESC LIMIT 0, 10';
						$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						if(mysqli_num_rows($result) > 0){
							$check++;
							?>
							<div style="border: thin solid rgb(0,0,0); width:500px;">
								<table width="100%">
									<tr>
										<td bgcolor="tomato">&nbsp;<b>Warnings</b></td>
									</tr>
							<?php
							while($row = mysqli_fetch_array($result)){
								echo "<tr><td>&nbsp;".$row[0]." (<a href='clear.php?id=".$row[1]."'>Clear</a>)</td></tr>";
							}
							echo "</table></div><br /><br />";
						}
					?>
					<?php
						$sql = 'SELECT `id`,`committee_id`,`requestor_id`,`action_date`,`item`,`vendor`,`cost`,`category_id`,`subcategory`,`type_id` FROM `budget_transactions` WHERE 1 AND `treasurer_approved` = \'no\' AND `deleted` = \'no\' ORDER BY `id` DESC LIMIT 0, 10';
						$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						if(mysqli_num_rows($result) > 0){
							$check++;
					?>
							<div style="border: thin solid rgb(0,0,0); width:500px;">
								<table width="100%">
									<tr>
										<td bgcolor="tomato" colspan="5">&nbsp;<b><a href='admin_approveall_page.php'>Items Awaiting Approval</a></b></td>
									</tr>
					<?php
							while($row = mysqli_fetch_array($result)){
                $id = $row[0];
                $committee_id = $row[1];
                $committee = get_committee_string($committee_id);
                $requestor_id = $row[2];
                $requestor = get_user_string($requestor_id);
                $action_date = $row[3];
                $item = $row[4];
                $vendor = $row[5];
                $cost = $row[6];
                $category_id = $row[7];
                $category = get_category_string($category_id);
                $subcategory = $row[8];
                $type_id = $row[9];
                $type = get_type_string($type_id);
								$neg = "";
								if($cost < 0){
									$neg = "-";
								}
								echo "<tr><td>[<a href='approve.php?id=".$id."'>Approve</a>]</td><td>".$action_date."</td><td>".$committee." (".$category.")</td><td>".$neg."$".number_format(abs($cost),2)."</td><td>".$vendor." - ".$item." (".$type.")</td></tr>";
							}
							echo "</table></div>";
						}
						if($check < 2){
							if($check == 0){
								$items = 12;
							}else{
								$items = 10;
							}
						?>
						<h3>Last <?php echo $items; ?> Expenses/Payments</h3>
						<table class="ex" cellspacing="0" border="1" cellpadding="3" style="border: thin solid rgb(0,0,0);">
							<tr>
								<td align="center"><b>Committee</b></td>
								<td align="center"><b>Type</b></td>
								<td align="center"><b>Date</b></td>
								<td align="center"><b>Item</b></td>
								<td align="center"><b>Debits</b></td>
								<td align="center"><b>Credits</b></td>
								<td align="center"><b>Main Category</b></td>
							</tr>
							<?php
							$sql = 'SELECT `type_id`,`action_date`,`item`,`vendor`,`cost`,`category_id`,`subcategory`,`committee_id` FROM `budget_transactions` WHERE 1 AND `deleted` = \'no\' AND `action_date` > \''.$start_date.'\' AND `action_date` < \''.$end_date.'\' ORDER BY `id` DESC LIMIT 0, '.$items;
							$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
							while($row = mysqli_fetch_array($result)){
                $type_id = $row[0];
                $type = get_type_string($type);
                $action_date = $row[1];
                $item = $row[2];
                $vendor = $row[3];
                $cost = $row[4];
                $category_id = $row[5];
                $category = get_category_string($category_id);
                $subcategory = $row[6];
                $committee_id = $row[7];
                $committee = get_committee_string($committee_id);
								echo "
								<tr>
									<td>".stripslashes(ucwords($committee))."&nbsp;</td>
									<td>".stripslashes(ucwords($type))."&nbsp;</td>
									<td>".stripslashes(ucwords($action_date))."&nbsp;</td>
									<td>".stripslashes(ucwords($item))."&nbsp;</td>";
								if($cost < 0){
									echo "
									<td>$".number_format(abs($cost),2)."</td>
									<td>&nbsp;</td>
									";
								}else{
									echo "
									<td>&nbsp;</td>
									<td>$".number_format(abs($cost),2)."</td>
									";
								}
								echo "
									<td>".stripslashes(ucwords($category))."&nbsp;</td>
								</tr>
								";
							}
						}
						?>
					</table>
				</td>
			</tr>
		</table>
		<p></p>
		<?php require_once("conf.php"); ?>
	</body>
</html>
