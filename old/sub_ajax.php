<?php
	require_once("db.php");
	$sql = 'SELECT `sub` FROM `budget` WHERE 1 AND `committee` = \''.$_GET["committee"].'\' AND `sub` LIKE \''.$_GET["input"].'%\'  ORDER BY `sub` ASC LIMIT 0, 10';
	$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		if($row[0] != ""){
			$sub_temp[$i] = ucwords($row[0]);
			$i++;
		}
	}
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	header("Content-Type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
	//Remove duplicate entries
	if(sizeof($sub_temp) > 0){
		$sub = array_keys(array_flip($sub_temp));
	}
	for($j = 0; $j < sizeof($sub); $j++){
		echo '<rs id="'.($j+1).'" info="">'.$sub[$j].'</rs>
		';
	}
	echo "</results>";
?>
	