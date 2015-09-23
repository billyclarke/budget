<?php
function check_date($strdate){
	if((strlen($strdate)<10)OR(strlen($strdate)>10)){
		return "Enter the date in mm/dd/yyyy format. <br />";
	}else{
		if((substr_count($strdate,"/"))<1 || (substr_count($strdate,"/"))>2){
			return "Enter the date in mm/dd/yyyy format. <br />";
		}else{
			$pos=strpos($strdate,"/");
			$date=substr($strdate,0,($pos));
			$result=preg_match("/^[0-9]+$/",$date,$trashed);
			if(!($result)){
				return "Enter a valid month.<br />";
			}else{
				if(($date<=0)OR($date>12)){
					return "Enter a valid month. 2<br />";
				}
			}
			$month=substr($strdate,($pos+1),($pos));
			if(($month<=0)OR($month>31)){
				return "Enter a valid date. <br />";
			}else{
				$result=preg_match("/^[0-9]+$/",$month,$trashed);
				if(!($result)){
					return "Enter a valid date. <br />";
				}
			}
			$year=substr($strdate,($pos+4),strlen($strdate));
			$result=preg_match("/^[0-9]+$/",$year,$trashed);
			if(!($result)){
				return "Enter a valid year. <br />";
			}else{
				if(($year<2007)OR($year>2200)){
					return "Enter a year between 2007-2200. <br/>";
				}
			}
		}
	}
	return "yes";
}

function check_cost($number){
	if(preg_match('/^[0-9]+\.[0-9]{2}$/', $number)){
	return "yes";
	}else{
		return "Please format the currency in the correct format (xxxx.xx no commas or $).<br />";
	}
}
?>
