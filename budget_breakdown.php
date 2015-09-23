<?php
require_once("db.php");
require_once("check_auth.php");
require_once("functions.php");
require_once("set_dates.php");
$committee = $_GET['committee'];
$committee_id = get_committee_id($committee);
?>
<html>
	<head>
		<title>Budget Breakdown</title>
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
		<?php
		if($_SESSION['s_auth'] == "Admin"){
		?>
		<script type="text/javascript">
			function gourl(id, item){
				if(confirm("Delete "+item+"?")){
					this.location = "delete_item.php?committee=<?php echo $committee; ?>&main=<?php echo $_GET["main"]; ?>&id="+id;
				}
			}
		</script>
		<?php
		}
		?>
	</head>
	<body>
		<h3><a href="committee_budget.php?committee=<?php echo $committee; ?>"><?php echo $committee; ?> Budget</a></h3>
		<div>
		<?php
			$budget = 0;
			$expenses = 0;
      $category_id = get_category_id($_GET["main"],$committee_id);
			$sql = 'SELECT `cost`,`type_id` FROM `budget_transactions` WHERE 1 AND `committee_id` = \''.$committee_id.'\' AND `category_id` = \''.$category_id.'\' AND `deleted` = \'no\' AND `action_date` > \''.$start_date.'\' AND `action_date` < \''.$end_date.'\'';
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
			$sql = 'SELECT `budget_code` FROM `budget_categories` WHERE 1 AND `id` = \''.$category_id.'\' AND `deleted` = \'no\'';
			//echo $sql;
			$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$budget_code = mysqli_fetch_row($result2);
			$budget_code = $budget_code[0];
			echo draw_expense($expenses,$budget,get_category_string($category_id)." - ".$budget_code,'');
		?>
		</div>
		<table class="ex" cellspacing="0" border="1" cellpadding="3" width="95%">
			<tr>
				<?php
				if($_SESSION['s_auth'] == "Admin"){
					echo "<td align='center'><b>Delete?</b></td>";
				}
				?>
				<td align="center"><b>Requestor</b></td>
				<td align="center"><b>Type</b></td>
				<td align="center"><b>Date</b></td>
				<td align="center"><b>Item</b></td>
				<td align="center"><b>Vendor</b></td>
				<td align="center"><b>Debits</b></td>
				<td align="center"><b>Credits</b></td>
				<td align="center"><b>Notes</b></td>
			</tr>
				<?php
					$sql = 'SELECT `subcategory` FROM `budget_transactions` WHERE 1 AND `committee_id` = \''.$committee_id.'\' AND `category_id` = \''.$category_id.'\'  AND `action_date` > \''.$start_date.'\' AND `action_date` < \''.$end_date.'\' ORDER BY `subcategory` ASC';
					$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
					$i = 0;
					while($row = mysqli_fetch_array($result)){
						if($row[0] != ""){
							$sub_temp[$i] = ucwords($row[0]);
							$i++;
						}
					}
					//Remove duplicate entries
					if(sizeof($sub_temp) > 0){
						$sub = array_keys(array_flip($sub_temp));
					}
					for($j = 0; $j < sizeof($sub)+1; $j++){
						$sql = 'SELECT `type_id`,`action_date`,`item`,`vendor`,`cost`,`requestor_id`,`id`,`note`,`treasurer_approved` FROM `budget_transactions` WHERE 1 AND `committee_id` = \''.$committee_id.'\' AND `category_id` = \''.$category_id.'\' AND `subcategory` = \''.$sub[$j].'\' AND `deleted` = \'no\' AND `action_date` > \''.$start_date.'\' AND `action_date` < \''.$end_date.'\' ORDER BY `action_date` DESC';
						$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$temp_out = "";
						$credits = 0;
						$debits = 0;
						while($row = mysqli_fetch_array($result)){
              $type_id = $row[0];
              $type_string = get_type_string($type_id);
              $action_date = $row[1];
              $item = $row[2];
              $vendor = $row[3];
              $cost = $row[4];
              $requestor_id = $row[5];
              $requestor = get_user_string($requestor_id);
              $id = $row[6];
              $note = $row[7];
              $treasurer_approved = $row[8];
							if($cost < 0){
								$debits = $debits + $cost;
							}else{
								$credits = $credits + $cost;
							}
							if($treasurer_approved == "yes"){
								$temp_out .= "
								<tr>";
							}else{
								$temp_out .= "
								<tr style='background-color: lightskyblue;'>";
							}
							$cspan = 8;
							if($_SESSION['s_auth'] == "Admin"){
								$cspan = 9;
								if($item){
									$it = $item;
								}else{
									$it = $type;
								}
								$temp_out .= "<td>[<a href='javascript:;' onclick='gourl(".$id.",\"".$it."\");'>X</a>]</td>";
							}
							$pc1 = "";
							$pc2 = "";
							if($type_id == get_type_id("Purchasing Card")){
								$pc1 = "<a href='createpcard.php?id=".$id."'>";
								$pc2 = "</a>";
							}
							if($type_id == get_type_id("Budget Transfer")){
								$pc1 = "<a href='createbudgetxfer.php?id=".$id."'>";
								$pc2 = "</a>";
							}
							if($type_id == get_type_id("Reimbursement")){
								$pc1 = "<a href='createreimbursement.php?id=".$id."'>";
								$pc2 = "</a>";
							}
							if($type_id == get_type_id("Petty Cash")){
								$pc1 = "<a href='createpettycash.php?id=".$id."'>";
								$pc2 = "</a>";
							}
								$temp_out .= "<td>".$requestor."&nbsp;</td>
								<td>".$pc1.stripslashes(ucwords($type)).$pc2."&nbsp;</td>
								<td>".stripslashes(ucwords($action_date))."&nbsp;</td>
								<td>".stripslashes(ucwords($item))."&nbsp;</td>
								<td>".stripslashes(ucwords($vendor))."&nbsp;</td>";
							if($row[4] < 0){
								$temp_out .= "
								<td>$".number_format(abs($cost),2)."</td>
								<td>&nbsp;</td>
								";
							}else{
								$temp_out .= "
								<td>&nbsp;</td>
								<td>$".number_format(abs($cost),2)."</td>
								";
							}
							$temp_out .= "<td>".stripslashes(ucwords($note))."&nbsp;</td></tr>";
						}
						if($budget == 0){
							$budget = .0001;
						}
						if($expenses == 0){
							$expenses = .0001;
						}
						if(($credits == 0) && ($debits == 0)){
							echo "";
						}else{
							if($budget != .0001){
								$pcredit = round(($credits*100)/$budget,1);
							}else{
								$pcredit = 0;
							}
							if($expenses != .0001){
								$pdebit = abs(round(($debits*100)/$expenses,1));
							}else{
								$pdebit = 0;
							}
							if($sub[$j] == ""){
								echo "<tr><td colspan='".$cspan."' bgcolor='DodgerBlue'><b>No Sub Catagory</b> - Credits: $".number_format(abs($credits),2)." (".$pcredit."%) &nbsp; Debits: $".number_format(abs($debits),2)." (".$pdebit."%)</td></tr>".$temp_out;
							}else{
								echo "<tr><td colspan='".$cspan."' bgcolor='DodgerBlue'><b>".$sub[$j]."</b> - Credits: $".number_format(abs($credits),2)." (".$pcredit."%) &nbsp; Debits: $".number_format(abs($debits),2)." (".$pdebit."%)</td></tr>".$temp_out;
							}
						}
					}
				?>
		</table>
		<p></p>
		<?php require_once("conf.php"); ?>
	</body>
</html>
