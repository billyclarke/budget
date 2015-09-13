<?php
require_once("db.php");

//Get the budget start and end dates
if(!$_SESSION['s_year']){
	if(((0 + date("m")) == 7 && (0 + date("d")) >= 1) || (0 + date("m")) > 7){
		$start_date = date("Y")."-07-01";
		$end_date = (date("Y")+1)."-06-31";
	}else{
		$start_date = (date("Y")-1)."-07-01";
		$end_date = date("Y")."-06-31";
	}
}else{
	$start_date = $_SESSION['s_year']."-07-01";
	$end_date = ($_SESSION['s_year']+1)."-06-31";
}


function get_category_id($category_name, $committee_id){
  $sql = 'SELECT `id` FROM `budget_categories` WHERE 1 AND `committee_id` = \''.$committee_id.'\' AND `name` = \''.$category_name.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_category_string($category_id){
  $sql = 'SELECT `name` FROM `budget_categories` WHERE 1 AND `id` = \''.$category_id.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_committee_id($committee_name){
  $sql = 'SELECT `id` FROM `budget_committees` WHERE 1 AND `fullname` = \''.$committee_name.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  if ($row[0] === ""){
    die("Could not get ID for committee: ".$committee_id);
  }
  return $row[0];
}

function get_committee_string($committee_id){
  $sql = 'SELECT `fullname` FROM `budget_committees` WHERE 1 AND `id` = \''.$committee_id.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_user_id($user_name){
  $sql = 'SELECT `id` FROM `directors` WHERE 1 AND `name` = \''.$user_name.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_user_string($user_id){
  $sql = 'SELECT `name` FROM `directors` WHERE 1 AND `id` = \''.$user_id.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_type_id($type_string){
  if ($type == "ProCard"){
    return 1;
  }
  $sql = 'SELECT `id` FROM `budget_transaction_types` WHERE 1 AND `name` = \''.$type_string.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_type_string($type_id){
  $sql = 'SELECT `name` FROM `budget_transaction_types` WHERE 1 AND `id` = \''.$type_id.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function draw_expense($spent, $total ,$item, $link, $override = 'no'){
	//Config
	$height = 20;
	$mult = 2.4;
	$spent = abs($spent);
	$total = abs($total);
	if($total == 0){
		$total = .0001;
	}
	$percentage = round(($spent/$total)*100,1);
	if($total == .0001 && $spent != 0){
		$total = 0;
		$percentage = 100;
		$overbudget = "<b>Overbudget</b>";
	}
	$p = $percentage;
	if($percentage > 100){
		$overbudget = "<b>Overbudget</b>";
		$percentage = 100;
	}
	$sp = $percentage*$mult;
	$le = (100*$mult)-($percentage*$mult);
	
	$c = round($percentage/10);
	$color[0] = "lightgreen";
	$color[1] = "lightgreen";
	$color[2] = "lightgreen";
	$color[3] = "lightgreen";
	$color[4] = "lightgreen";
	$color[5] = "lightgreen";
	$color[6] = "lightgreen";
	$color[7] = "lightgreen";
	$color[8] = "gold";
	$color[9] = "salmon";
	$color[10] = "tomato";
	
	$percentage = $p;
	
	if($link && $override == "no"){
		$item = "<a href='".$link."'>".$item."</a>";
	}
	if($link && $override == "yes"){
		$item = "<a href='".$link."' onclick=\"changecom('".$item."');\">".$item."</a>";
	}
	$width = 100*$mult+50;
	return '
	<div style="position: relative;" title="$'.number_format($total-$spent,2).' remaining">
		<div style="top: 0px; left: 0px; height: 20px; width: '.$width.'px;"><h3>'.$item.'</h3></div>
		<div style="top: 20px; left: 0px; height: 20px; width: '.$width.'px;">$'.number_format($spent,2).' / $'.number_format($total,2).' ('.number_format($percentage,1).'%)</div>
		<div style="text-align: center; font-family: arial; font-variant: small-caps; top: 40px; left: 0px; height: '.$height.'px; width: '.$sp.'px; background-color: '.$color[$c].';"> '.$overbudget.' </div><div style="position: absolute; top: 40px; left: '.$sp.'px; height: '.$height.'px; width: '. $le .'px; background-color: #999999;"></div>   
		<div style="top: 60px; left: 0px; height: 20px; width: '.$width.'px;"> </div>
	</div>
	';
}

function get_committees(){
	$sql = 'SELECT `committee` FROM `budget_item` WHERE 1 AND `deleted` = \'no\' ORDER BY `committee` ASC';
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$committees_temp[$i] = $row[0];
		$i++;
	}
	//Remove duplicate entries
	$committees = array_keys(array_flip($committees_temp));
	return $committees;
}
?>
