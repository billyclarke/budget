<?php
require_once("check_auth.php");
require_once("db.php");
require_once("functions.php");

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
	$sub_budgets = $sub_budgets."<td>".draw_expense($expenses,$budget,$committees[$i],'')."</td>";
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
		<!--<link type="text/css" rel="stylesheet" href="style.css" />-->
	</head>
	<body>
		<table>
			<?php
				echo "<tr><td>".draw_expense($total_costs, $total_budget, $committee." Total Budget",'')."</td>";
				echo $sub_budgets;
			?>
		</table>
		<p></p>
		<?php require_once("conf.php"); ?>
	</body>
</html>