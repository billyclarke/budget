<?php
require_once("check_auth.php");
require_once("db.php");
require_once("functions.php");
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
	$sql = 'SELECT `cost`,`type` FROM `budget` WHERE 1 AND `committee` = \''.$committees[$i].'\' AND `deleted` = \'no\' AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\'';
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
	if(($j/2) != floor($j/2)){
		$sub_budgets = $sub_budgets."<tr>";
	}
	$sub_budgets = $sub_budgets."<td>".draw_expense($expenses,$budget,$committees[$i],'committee_budget.php?committee='.$committees[$i],'yes')."</td>";
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
		<title>SPEC Budget Committee Breakdown</title>
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
		<table>
			<?php
				echo "<tr><td>".draw_expense($total_costs, $total_budget, $committee." Total Budget",'')."</td>";
				echo $sub_budgets;
			?>
		</table>
	</body>
</html>