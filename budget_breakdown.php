<?php
require_once("db.php");
require_once("check_auth.php");
require_once("functions.php");
$committee = $_GET['committee'];
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
			$sql = 'SELECT `cost`,`type` FROM `budget` WHERE 1 AND `committee` = \''.$committee.'\' AND `main` = \''.$_GET["main"].'\' AND `deleted` = \'no\' AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\'';
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
			
			$sql = 'SELECT `budget_category` FROM `budget_item` WHERE `committee` = \''.$committee.'\' AND `item` = \''.$_GET["main"].'\' AND `deleted` = \'no\'';
			//echo $sql;
			$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
			$budget_category = mysqli_fetch_row($result2);
			$budget_category = $budget_category[0];
			
			echo draw_expense($expenses,$budget,$_GET["main"]." - ".$budget_category,'');
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
					$sql = 'SELECT `sub` FROM `budget` WHERE 1 AND `committee` = \''.$_GET["committee"].'\' AND `main` = \''.$_GET["main"].'\'  AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\' ORDER BY `sub` ASC';
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
						$sql = 'SELECT `type`,`date`,`item`,`vendor`,`cost`,`requestor`,`id`,`note`,`treasurer_approved` FROM `budget` WHERE 1 AND `committee` = \''.$committee.'\' AND `main` = \''.$_GET["main"].'\' AND `sub` = \''.$sub[$j].'\' AND `deleted` = \'no\' AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\' ORDER BY `date` DESC';
						$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$temp_out = "";
						$credits = 0;
						$debits = 0;
						while($row = mysqli_fetch_array($result)){
							if($row[4] < 0){
								$debits = $debits + $row[4];
							}else{
								$credits = $credits + $row[4];
							}
							if($row[8] == "yes"){
								$temp_out .= "
								<tr>";
							}else{
								$temp_out .= "
								<tr style='background-color: lightskyblue;'>";
							}
							$cspan = 8;
							if($_SESSION['s_auth'] == "Admin"){
								$cspan = 9;
								if($row[2]){
									$it = $row[2];
								}else{
									$it = $row[0];
								}
								$temp_out .= "<td>[<a href='javascript:;' onclick='gourl(".$row[6].",\"".$it."\");'>X</a>]</td>";
							}
							$pc1 = "";
							$pc2 = "";
							if($row[0] == "ProCard"){
								$pc1 = "<a href='createpcard.php?id=".$row[6]."'>";
								$pc2 = "</a>";
							}
							if($row[0] == "Budget Transfer"){
								$pc1 = "<a href='createbudgetxfer.php?id=".$row[6]."'>";
								$pc2 = "</a>";
							}
							if($row[0] == "Reimbursement"){
								$pc1 = "<a href='createreimbursement.php?id=".$row[6]."'>";
								$pc2 = "</a>";
							}
							if($row[0] == "Petty Cash"){
								$pc1 = "<a href='createpettycash.php?id=".$row[6]."'>";
								$pc2 = "</a>";
							}
								$temp_out .= "<td>".$row[5]."&nbsp;</td>
								<td>".$pc1.stripslashes(ucwords($row[0])).$pc2."&nbsp;</td>
								<td>".stripslashes(ucwords($row[1]))."&nbsp;</td>
								<td>".stripslashes(ucwords($row[2]))."&nbsp;</td>
								<td>".stripslashes(ucwords($row[3]))."&nbsp;</td>";
							if($row[4] < 0){
								$temp_out .= "
								<td>$".number_format(abs($row[4]),2)."</td>
								<td>&nbsp;</td>
								";
							}else{
								$temp_out .= "
								<td>&nbsp;</td>
								<td>$".number_format(abs($row[4]),2)."</td>
								";
							}
								
							$temp_out .= "<td>".stripslashes(ucwords($row[7]))."&nbsp;</td></tr>";
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