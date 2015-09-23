<?php
class CreateCSV{
	function create($sql, $isPrintFieldName = false, $isQuoted = true){

		$q = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die("Error: ".((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
		
		$csv = $head = $ctn = '';
		$hasPrintHead = false;

		while($r = mysqli_fetch_assoc($q)){
			
			if(!$hasPrintHead && $isPrintFieldName == true){
				$csv_value = array();
				foreach($r as $field => $value){
					$csv_value[] = $field;
				}
				$hasPrintHead = true;
				$csv .= implode(',', $csv_value)."\n";
			}
			
			//Print the content...
			$aOpts_text = $csv_value = array();
			foreach($r as $field => $value){
				$csv_value[] = $isQuoted == true ? '"'.$value.'"' : $value;
			}
			$csv .= implode(',', $csv_value)."\n";
		}
		return $csv;
	}
}
?>