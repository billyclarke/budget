<?php
require_once("db.php");
require_once("check_auth.php");
require_once("functions.php");

$sql = 'SELECT `committee`, `requestor`, `date`, `item`, `vendor`, `cost`, `main`, `submitted` FROM `budget` WHERE `id` = '.$_GET["id"].' AND `type` = \'Budget Transfer\' AND `deleted` = \'no\'';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

$io1 = "To";
$io2 = "From";
$io3 = "Incoming";

while($row = mysqli_fetch_array($result)){
	$name = $row[1];
	$committee = $row[0];
	$vendor = $row[4];
	$purchase_date = $row[2];
	if($row[5] < 0){
		$io1 = "From";
		$io2 = "To";
		$io3 = "Outgoing";
	}
	$cost = number_format(abs($row[5]), 2, '.', ',');
	$description = $row[3];
	$main = $row[6];
	$today = $row[7];
	
	$sql = 'SELECT `budget_category` FROM `budget_item` WHERE `committee` = \''.$row[0].'\' AND `item` = \''.$row[6].'\' AND `deleted` = \'no\'';
	$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$budget_category = mysqli_fetch_row($result2);
	$budget_category = $budget_category[0];
}

header("Expires: 0?");
header("Cache-control: private");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0?");
header("Content-Description: File Transfer");
header("Content-Type: application/msword");
header("Content-disposition: attachment; filename=item_".$_GET['id']."_budget_transfer_form.doc");
?>
<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 12 (filtered)">
<title>SPEC Budget Transfer Request</title>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
@page Section1
	{size:8.5in 11.0in;
	margin:1.0in 1.25in 1.0in 1.25in;}
div.Section1
	{page:Section1;}
-->
</style>

</head>

<body lang=EN-US>

<div class=Section1>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:20.0pt;font-family:"Arial","sans-serif"'>SPEC Budget Transfer
Request (<?php echo $io3; ?>)</span></b></p>

<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"Arial","sans-serif"'><?php echo $io1; ?></span></b></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Committee:
<?php echo $committee; ?></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Budget
Category: <?php echo $main; ?></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Budget
Code: <?php echo $budget_category; ?></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"Arial","sans-serif"'><?php echo $io2; ?></span></b></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Organization:
<?php echo $vendor; ?></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Budget
Code: ___________________________________________</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Amount:
$<?php echo $cost; ?></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Reason
for Transfer: ______________________________________</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"Arial","sans-serif"'>Event Information</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:16.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Event
Name: ____________________________________________</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Event
Date(s): ___________________________________________</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Event
Location: __________________________________________</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Additional
Comments: _____________________________________</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:16.0pt;font-family:"Arial","sans-serif"'>Authorization</span></b></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Printed
Name: <?php echo $name; ?></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>Signature:
______________________________________________</span></p>

</div>

</body>

</html>
