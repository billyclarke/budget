<?php
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
?>
