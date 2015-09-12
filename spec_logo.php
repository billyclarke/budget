<?php
require_once("check_auth.php");
if($_POST['year']){
	$_SESSION['s_year'] = $_POST['year'];
	if($_SESSION['s_auth'] == "Admin"){
		$onload = " onload=\"parent.home.location = 'treasurer.php'\"";
	}else{
		$onload = " onload=\"parent.home.location = 'committee_budget.php?committee=".$_SESSION['s_auth']."'\"";
	}
}
?>
<html>
	<head>
		<title>SPEC Logo</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
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
	</head>
	<body<?php echo $onload; ?> style="overflow: hidden; padding:4px;">
		<table>
			<tr width="95%" align="center">
				<td>
					<img src="images/logo.png" alt="SPEC" />
				</td>
				<td style="vertical-align: bottom; text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3>Welcome, <?php echo $_SESSION['s_name']; ?> (<?php echo $_SESSION['s_auth']; ?> - <a href="index.php?destroy=yes" target="_parent">Logout</a>)</h3></td>
				<td style="vertical-align: middle;">
					<form action="spec_logo.php" method="post" name="changeyear">
						&nbsp;&nbsp;&nbsp;Year: 
						<?php
							require_once("db.php");
							$sql = 'SELECT `date` FROM `budget` WHERE 1 ORDER BY `date` DESC LIMIT 0, 1';
							$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
							$row = mysqli_fetch_array($result);
							$e_date = $row[0];
							$e_year = substr($e_date,0,4)+0;
							$e_month = substr($e_date,5,2)+0;
							$e_day = substr($e_date,8,2)+0;
							
							
							$sql = 'SELECT `date` FROM `budget` WHERE 1 ORDER BY `date` ASC LIMIT 0, 1';
							$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
							$row = mysqli_fetch_array($result);
							$s_date = $row[0];
							$s_year = substr($s_date,0,4)+0;
							$s_month = substr($s_date,5,2)+0;
							$s_day = substr($s_date,8,2)+0;
							
							if(($s_month == 5 && $s_day >= 16) || $s_month > 5){
								$st_year = $s_year;
							}else{
								$st_year = ($s_year-1);
							}
							if(($e_month == 5 && $e_day >= 16) || $e_month > 5){
								$en_year = $e_year;
							}else{
								$en_year = ($e_year-1);
							}
							echo "<select name='year' onchange='document.forms.changeyear.submit();'>";
							if(!$_SESSION['s_year']){
								$tmp = (date("Y")+0);
							}else{
								$tmp = ($_SESSION['s_year']+0);
							}
							for($i = 0; $i < (($en_year - $st_year)+1); $i++){
								if($tmp == ($en_year-$i+0)){
									$selected = " selected";
								}else{
									$selected = "";
								}
								echo "<option".$selected." value='".($en_year-$i)."'>".($en_year-$i)." - ".($en_year-$i+1)."</option>
								";
							}
							echo "</select>";
						?>
					</form>	
				</td>
			</tr>
		</table>
	</body>
</html>