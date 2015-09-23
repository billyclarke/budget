<?php
require_once("db.php");
require_once("check_auth.php");

$pcard_type_id = get_type_id("Purchasing Card");

$sql = 'SELECT `committee_id`, `requestor_id`, `action_date`, `item`, `vendor`, `cost`, `category_id`, `submitted_date` FROM `budget_transactions` WHERE `id` = '.$_GET["id"].' AND `type_id` = \''.$pcard_type_id.'\' AND `deleted` = \'no\'';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

while($row = mysqli_fetch_array($result)){
	$committee_id = $row[0];
	$committee = $get_committee_string($committee_id);
	$requestor_id = $row[1];
	$requestor = $get_user_string($requestor_id);
	$action_date = $row[2];
	$item = $row[3];
	$vendor = $row[4];
	$cost = number_format(abs($row[5]), 2, '.', ',');
  $category_id = $row[6];
	$submitted_date = $row[7];

	$sql = 'SELECT `budget_code` FROM `budget_categories` WHERE `category_id` = \''.$category_id.'\' AND `deleted` = \'no\'';
	$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$budget_code = mysqli_fetch_row($result2);
	$budget_code = $budget_code[0];

	$email = get_user_email($requestor_id);
}

header("Expires: 0?");
header("Cache-control: private");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0?");
header("Content-Description: File Transfer");
header("Content-Type: application/msword");
header("Content-disposition: attachment; filename=item_".$_GET['id']."_procard_form.doc");
?>
<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 12 (filtered)">
<title>ProCard <?php echo $_GET["id"]; ?></title>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;}
@font-face
	{font-family:Desdemona;}
@font-face
	{font-family:"Dom Casual";}
@font-face
	{font-family:Times;
	panose-1:2 2 6 3 5 4 5 2 3 4;}
@font-face
	{font-family:"Comic Sans MS";
	panose-1:3 15 7 2 3 3 2 2 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Arial","sans-serif";}
h1
	{margin:0in;
	margin-bottom:.0001pt;
	page-break-after:avoid;
	font-size:12.0pt;
	font-family:"Tahoma","sans-serif";}
p.MsoTitle, li.MsoTitle, div.MsoTitle
	{margin:0in;
	margin-bottom:.0001pt;
	text-align:center;
	font-size:24.0pt;
	font-family:"Comic Sans MS";
	font-weight:bold;
	font-style:italic;}
@page Section1
	{size:8.5in 11.0in;
	margin:.7in .5in .5in .7in;}
div.Section1
	{page:Section1;}
-->
</style>

</head>

<body lang=EN-US>

<div class=Section1>

<p class=MsoTitle><span style='font-size:26.0pt;font-style:normal'>TO REPORT
PCARD PURCHASES</span></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-family:Desdemona'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:18.0pt;font-family:"Tahoma","sans-serif"'>(One transaction per
page.)</span></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-family:"Dom Casual"'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:20.0pt;font-family:"Tahoma","sans-serif"'>All charges must be
reported within 48 hours.</span></p>

<p class=MsoNormal><span style='font-family:"Dom Casual"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:22.0pt;font-family:Wingdings'>M</span><span style='font-size:
18.0pt;font-family:"Dom Casual"'>   </span><span style='font-size:14.0pt;
font-family:"Tahoma","sans-serif"'>Attach original receipt, packing slip, etc.
to BACK of this form.</span></p>

<p class=MsoNormal><b><span style='font-size:14.0pt'>&nbsp;</span></b></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=288 valign=top style='width:3.0in;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt'>Cardholder’s name</span></b></p>
  </td>
  <td width=221 valign=top style='width:2.3in;border-top:solid windowtext 1.5pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt'>E-mail/phone</span></b></p>
  </td>
  <td width=202 valign=top style='width:2.1in;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt'>Date Submitted</span></b></p>
  </td>
 </tr>
 <tr style='height:26.0pt'>
  <td width=288 valign=top style='width:3.0in;border-top:none;border-left:solid windowtext 1.5pt;
  border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.0pt'>
  <p class=MsoNormal><?php echo $requestor;?> </p>
  </td>
  <td width=221 valign=top style='width:2.3in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.0pt'>
  <p class=MsoNormal><?php echo $email;?> </p>
  </td>
  <td width=202 valign=top style='width:2.1in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.0pt'>
  <p class=MsoNormal><?php echo $submitted_date;?> </p>
  </td>
 </tr>
</table>

<p class=MsoNormal>&nbsp;</p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr style='height:26.0pt'>
  <td width=709 valign=top style='width:531.9pt;border:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.0pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt'>Group to be charged: </span></b><span
  style='font-size:14.0pt'>SPEC <?php echo $committee;?> </span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b>&nbsp;</b></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=384 valign=top style='width:4.0in;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt'>Supplier</span></b></p>
  </td>
  <td width=182 valign=top style='width:1.9in;border-top:solid windowtext 1.5pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:14.0pt'>Date of Purchase</span></b></p>
  </td>
  <td width=144 valign=top style='width:1.5in;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:14.0pt'>$$ Amount</span></b></p>
  </td>
 </tr>
 <tr style='height:20.0pt'>
  <td width=384 valign=top style='width:4.0in;border-top:none;border-left:solid windowtext 1.5pt;
  border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><?php echo $vendor;?> </p>
  </td>
  <td width=182 valign=top style='width:1.9in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><?php echo $action_date;?> </p>
  </td>
  <td width=144 valign=top style='width:1.5in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal>$<?php echo $cost;?></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b>&nbsp;</b></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in;line-height:50%'><span
style='font-size:8.0pt;line-height:50%'>&nbsp;</span></p>

<p class=MsoNormal>&nbsp;</p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=413 valign=top style='width:4.3in;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt'>Description of Purchase</span></b></p>
  </td>
  <td width=296 valign=top style='width:222.3pt;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:14.0pt'>Budget Category **</span></b></p>
  </td>
 </tr>
 <tr style='height:50.0pt'>
  <td width=413 valign=top style='width:4.3in;border-top:none;border-left:solid windowtext 1.5pt;
  border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  <p class=MsoNormal><span style='font-size:14.0pt'><?php echo $item;?> </span></p>
  </td>
  <td width=296 valign=top style='width:222.3pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt;height:50.0pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt'><br>
  <?php echo $budget_code;?> </span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-size:8.0pt'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span
style='font-size:14.0pt'>          </span></p>

<p class=MsoNormal style='margin-left:.5in'><b><span style='font-size:14.0pt'>*Group
to be charged: </span></b><span style='font-size:14.0pt'>Grad groups should
specify whether this expense is from your GISAC account or GAPSA event funding. 
If event funding list the name and date of the event under Budget Category.</span></p>

<p class=MsoNormal><span style='font-size:16.0pt'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:1.0in;text-indent:-.5in'><b><span
style='font-size:14.0pt'>**Budget Categories</span></b><span style='font-size:
14.0pt'> are specific to your group’s funding and might include printing and
duplicating, honoraria, non-SAC expenses, etc.</span></p>

<p class=MsoNormal><span style='font-size:14.0pt'>          </span></p>

<p class=MsoNormal><span style='font-size:16.0pt'>*  *  *  *  *  *  *  *  *  * 
*  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  </span></p>

<p class=MsoNormal align=center style='text-align:center'><b><span
style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Office use only:</span></b></p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal><b><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></b></p>

<h1>Account #:  __________________________________________________</h1>

<p class=MsoNormal><b><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal><b><span style='font-family:"Tahoma","sans-serif"'>PCARDDR#/Date: 
_____________________</span></b></p>

<p class=MsoNormal><b><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal><b><span style='font-family:"Tahoma","sans-serif"'>SAC
Transaction #:    ___________________</span></b></p>

</div>

</body>

</html>
