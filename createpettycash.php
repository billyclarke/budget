<?php
require_once("db.php");
//require_once("check_auth.php");
require_once("functions.php");

$pettycash_type_id = get_type_id("Petty Cash");

$sql = 'SELECT `committee_id`, `requestor_id`, `item`, `vendor`, `cost`, `category_id`, `submitted_date` FROM `budget_transactions` WHERE `id` = '.$_GET["id"].' AND `type_id` = \''.$pettycash_type_id.'\'  AND `deleted` = \'no\'';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

while($row = mysqli_fetch_array($result)){
	$committee_id = $row[0];
  $committee = get_committee_string($committee_id);
	$requestor_id = $row[1];
	$requestor = get_user_string($requestor_id);
	$item = $row[2];
	$vendor = $row[3];
	$cost = number_format(abs($row[4]), 2, '.', ',');
  $category_id = $row[5];
	$submitted_date = $row[6];

	$sql = 'SELECT `budget_code` FROM `budget_categories` WHERE `category_id` = \''.$category_id.'\' AND `deleted` = \'no\'';
	$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$budget_code = mysqli_fetch_row($result2);
	$budget_code = $budget_code[0];

	$sql = 'SELECT `email` FROM `directors` WHERE `name` =\''.$row[1].'\' AND `deleted` = \'no\'';
	$result3 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
	$email = mysqli_fetch_row($result3);
	$email = $email[0];
}

header("Expires: 0?");
header("Cache-control: private");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0?");
header("Content-Description: File Transfer");
header("Content-Type: application/msword");
header("Content-disposition: attachment; filename=item_".$_GET['id']."_petty_cash_form.doc");
?>
<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 12 (filtered)">
<title>REQUEST FOR REIMBURSEMENT</title>
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
	{font-family:"Comic Sans MS";
	panose-1:3 15 7 2 3 3 2 2 2 4;}
@font-face
	{font-family:"Dom Casual";}
@font-face
	{font-family:Times;
	panose-1:2 2 6 3 5 4 5 2 3 4;}
@font-face
	{font-family:Chicago;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Arial","sans-serif";}
p.MsoBodyText, li.MsoBodyText, div.MsoBodyText
	{margin:0in;
	margin-bottom:.0001pt;
	text-align:center;
	font-size:26.0pt;
	font-family:"Comic Sans MS";
	font-weight:bold;}
@page Section1
	{size:8.5in 11.0in;
	margin:63.0pt .75in .5in .75in;}
div.Section1
	{page:Section1;}
 /* List Definitions */
 ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
-->
</style>

</head>

<body lang=EN-US>

<div class=Section1>

<p class=MsoBodyText>REQUEST FOR PETTY CASH REIMBURSEMENT</p>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:16.0pt;font-family:Chicago'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-size:22.0pt;font-family:Wingdings'>M</span><span style='font-size:
18.0pt;font-family:"Dom Casual"'>   </span><b><i><u><span style='font-size:
18.0pt;font-family:"Tahoma","sans-serif"'>Total</span></u></i></b><b><i><span
style='font-size:18.0pt;font-family:"Tahoma","sans-serif"'> reimbursement must
be under $25.</span></i></b></p>

<p class=MsoNormal><span style='font-size:8.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><b><i><span
style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Bring directly to Rozell</span></i></b></p>

<p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><b><span
style='font-size:14.0pt;font-family:"Comic Sans MS"'>List all expenses below.</span></b><span
style='font-family:"Tahoma","sans-serif"'>   Be specific. ‘Office supplies,’
‘copies,’ etc. is not sufficient.  The description must fully explain the
expense; e.g., ‘duplicating agendas for Sept. general meeting.’ </span></p>

<p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"Comic Sans MS"'>Budget
Categories</span></b><b><span style='font-family:"Comic Sans MS"'> </span></b><span
style='font-family:"Tahoma","sans-serif"'>are specific to your group’s funding.</span></p>

<p class=MsoNormal style='margin-left:.5in;text-indent:-.25in'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span style='font-family:"Comic Sans MS"'>SAC groups:</span></b><span
style='font-family:"Tahoma","sans-serif"'>  Check your budget for the
appropriate category.</span></p>

<p class=MsoNormal style='margin-left:.5in'><span style='font-size:14.0pt;
font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal style='margin-left:.5in'><span style='font-size:14.0pt;
font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=373 valign=top style='width:279.9pt;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Description
  of Purchase</span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;border-top:solid windowtext 1.5pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Budget Category </span></p>
  </td>
  <td width=120 valign=top style='width:1.25in;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Amount</span></p>
  </td>
 </tr>
 <tr>
  <td width=373 valign=top style='width:279.9pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:solid windowtext 1.0pt;border-right:
  solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'><?php echo $item; ?></span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'><?php echo $budget_code; ?></span></p>
  </td>
  <td width=120 valign=top style='width:1.25in;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'><?php echo $cost; ?></span></p>
  </td>
 </tr>
 <tr>
  <td width=373 valign=top style='width:279.9pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
  <td width=120 valign=top style='width:1.25in;border:none;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=373 valign=top style='width:279.9pt;border-top:1.0pt;border-left:
  1.5pt;border-bottom:1.5pt;border-right:1.0pt;border-color:windowtext;
  border-style:solid;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
  <td width=186 valign=top style='width:139.5pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
  <td width=120 valign=top style='width:1.25in;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b><span style='font-size:8.0pt'>&nbsp;</span></b></p>

<p class=MsoNormal><b><span style='font-size:14.0pt'>                                                                                                </span></b><b><span
style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Total $ <?php echo $cost; ?></span></b></p>

<p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=265 valign=top style='width:198.9pt;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Requestor</span></p>
  </td>
  <td width=234 valign=top style='width:175.5pt;border-top:solid windowtext 1.5pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Organization</span></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>E-mail/phone
  </span></p>
  </td>
 </tr>
 <tr style='height:20.0pt'>
  <td width=265 valign=top style='width:198.9pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:solid windowtext 1.5pt;border-right:
  solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'><?php echo $requestor; ?></span></p>
  </td>
  <td width=234 valign=top style='width:175.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'>SPEC <?php echo $committee; ?></span></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'><?php echo $email; ?></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-size:8.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=265 valign=top style='width:198.9pt;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Treasurer’s
  Approval (if required)</span></p>
  </td>
  <td width=234 valign=top style='width:175.5pt;border-top:solid windowtext 1.5pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>E-mail/phone</span></p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Date
  Submitted</span></p>
  </td>
 </tr>
 <tr style='height:20.0pt'>
  <td width=265 valign=top style='width:198.9pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:solid windowtext 1.5pt;border-right:
  solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal>&nbsp;</p>
  </td>
  <td width=234 valign=top style='width:175.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal>&nbsp;</p>
  </td>
  <td width=180 valign=top style='width:135.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><?php echo $submitted_date; ?></p>
  </td>
 </tr>
</table>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=481 valign=top style='width:360.9pt;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Cash
  picked up by (signature):</span></b></p>
  </td>
  <td width=198 valign=top style='width:148.5pt;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Date</span></b></p>
  </td>
 </tr>
 <tr style='height:20.0pt'>
  <td width=481 valign=top style='width:360.9pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:solid windowtext 1.5pt;border-right:
  solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=198 valign=top style='width:148.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal align=center style='text-align:center'><i><span
style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></i></p>

<p class=MsoNormal align=center style='text-align:center'><i><span
style='font-family:"Tahoma","sans-serif"'>Office use:  PC #_________   date
___________</span></i></p>

<p class=MsoNormal align=center style='text-align:center'><i><span
style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></i></p>

<p class=MsoNormal align=center style='text-align:center'><i><span
style='font-family:"Tahoma","sans-serif"'>Org/Obj/Cref:  
_____________________________</span></i></p>

</div>

</body>

</html>
