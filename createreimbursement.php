<?php
require_once("db.php");
require_once("check_auth.php");
require_once("functions.php");

$reimburementTypeId = get_type_id("Reimbursement");
$sql = 'SELECT `committee_id`, `requestor_id`, `action_date`, `item`, `vendor`, `cost`, `category_id`, `submitted_date` FROM `budget_transactions` WHERE `id` = '.$_GET["id"].' AND `type_id` = \''.$reimbursementTypeId.'\'  AND `deleted` = \'no\'';
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

while($row = mysqli_fetch_array($result)){
	$committee_id = $row[0];
  $committee = get_committee_string($committee_id);
	$requestor_id = $row[1];
  $requestor = get_user_string($requestor_id);
	$purchase_date = $row[2];
	$description = $row[3];
	$vendor = $row[4];
	$cost = $row[5];
  $cost_formatted = number_format(abs($cost), 2, '.', ',');
  $category_id = $row[6];
  $category = get_category_string($category_id);
	$submitted_date = $row[7];
  $budget_code = get_budget_code($category_id);

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
header("Content-disposition: attachment; filename=item_".$_GET['id']."_reimbursement_form.doc");
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
	{font-family:"Arial Narrow";
	panose-1:2 11 6 6 2 2 2 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Arial","sans-serif";}
p.MsoTitle, li.MsoTitle, div.MsoTitle
	{margin:0in;
	margin-bottom:.0001pt;
	text-align:center;
	font-size:28.0pt;
	font-family:"Arial Narrow","sans-serif";
	font-weight:bold;
	font-style:italic;}
@page Section1
	{size:8.5in 11.0in;
	margin:.5in .75in .5in .75in;}
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

<p class=MsoTitle><span style='font-size:26.0pt;font-family:"Comic Sans MS";
font-style:normal'>REQUEST FOR REIMBURSEMENT</span></p>

<p class=MsoNormal><span style='font-family:"Dom Casual"'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:22.0pt;font-family:Wingdings'>M</span><span
style='font-size:18.0pt;font-family:"Dom Casual"'>   </span><i><span
style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>No Travel or
Entertainment (food) expenses on this form.</span></i></p>

<p class=MsoNormal style='line-height:50%'><i><span style='font-size:8.0pt;
line-height:50%;font-family:"Tahoma","sans-serif"'>&nbsp;</span></i></p>

<p class=MsoNormal><i><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>        Reimbursement
must total $25 or more.  (Under $25 = Petty Cash)</span></i></p>

<p class=MsoNormal style='line-height:50%'><i><span style='font-size:8.0pt;
line-height:50%;font-family:"Tahoma","sans-serif"'>&nbsp;</span></i></p>

<p class=MsoNormal style='margin-left:.5in'><i><span style='font-size:14.0pt;
font-family:"Tahoma","sans-serif"'>Reimbursements will be <b>directly deposited</b>
into your bank account for those who have elected direct deposit via payroll, or
by <b>check </b>for all others.</span></i></p>

<p class=MsoNormal style='line-height:50%'><i><span style='font-size:8.0pt;
line-height:50%;font-family:"Tahoma","sans-serif"'>&nbsp;</span></i></p>

<p class=MsoNormal><i><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>        Tax
will not be reimbursed.  </span></i></p>

<p class=MsoNormal style='line-height:50%'><i><span style='font-size:8.0pt;
line-height:50%;font-family:"Tahoma","sans-serif"'>&nbsp;</span></i></p>

<p class=MsoNormal><i><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>        Attach
all ORIGINAL, ITEMIZED receipts to back of form</span></i><span
style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>.</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=691
 style='width:7.2in;border-collapse:collapse;border:none'>
 <tr>
  <td width=181 valign=top style='width:135.9pt;border-top:solid black 1.5pt;
  border-left:solid black 1.5pt;border-bottom:none;border-right:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:18.0pt;font-family:"Comic Sans MS"'>Payee:
  </span></b></p>
  </td>
  <td width=510 valign=top style='width:382.5pt;border-top:solid black 1.5pt;
  border-left:none;border-bottom:none;border-right:solid black 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'><?php echo $vendor; ?>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=181 valign=top style='width:135.9pt;border:solid black 1.5pt;
  border-right:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>SS
  # (last 4 digits) and Penn ID #</span></p>
  </td>
  <td width=510 valign=top style='width:382.5pt;border:solid black 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:10.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=181 valign=top style='width:135.9pt;border:none;border-left:solid black 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Complete
  Address:</span></p>
  </td>
  <td width=510 valign=top style='width:382.5pt;border:none;border-right:solid black 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=181 valign=top style='width:135.9pt;border:none;border-left:solid black 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
  <td width=510 valign=top style='width:382.5pt;border:solid black 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=181 valign=top style='width:135.9pt;border-top:none;border-left:
  solid black 1.5pt;border-bottom:solid black 1.5pt;border-right:none;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
  <td width=510 valign=top style='width:382.5pt;border-top:none;border-left:
  none;border-bottom:solid black 1.5pt;border-right:solid black 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><b><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></b></p>

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

<p class=MsoNormal style='margin-left:.5in;text-indent:-.25in'><span
style='font-family:Symbol'>·<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><b><span style='font-family:"Comic Sans MS"'>GISAC groups:  </span></b><span
style='font-family:"Tahoma","sans-serif"'>Review GAPSA guidelines.</span></p>

<p class=MsoNormal style='margin-left:.5in'><b><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></b></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=691
 style='width:7.2in;border-collapse:collapse;border:none'>
 <tr>
  <td width=391 valign=top style='width:293.4pt;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Description
  of Purchase</span></p>
  </td>
  <td width=198 valign=top style='width:148.5pt;border-top:solid windowtext 1.5pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Budget Category </span></p>
  </td>
  <td width=102 valign=top style='width:76.5pt;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Amount</span></p>
  </td>
 </tr>
 <tr>
  <td width=391 valign=top style='width:293.4pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:solid windowtext 1.0pt;border-right:
  solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'><?php echo $item; ?></span></p>
  </td>
  <td width=198 valign=top style='width:148.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'><?php echo $budget_code; ?></span></p>
  </td>
  <td width=102 valign=top style='width:76.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>$<?php echo $cost; ?></span></p>
  </td>
 </tr>
 <tr>
  <td width=391 valign=top style='width:293.4pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:solid windowtext 1.0pt;border-right:
  solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=198 valign=top style='width:148.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=102 valign=top style='width:76.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=391 valign=top style='width:293.4pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=198 valign=top style='width:148.5pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=102 valign=top style='width:76.5pt;border:none;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=391 valign=top style='width:293.4pt;border-top:1.0pt;border-left:
  1.5pt;border-bottom:1.5pt;border-right:1.0pt;border-color:windowtext;
  border-style:solid;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=198 valign=top style='width:148.5pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=102 valign=top style='width:76.5pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-size:8.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

<p class=MsoNormal><b><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>                                                                                Total
$ <?php echo $cost; ?></span></b></p>

<p class=MsoNormal><b><span style='font-size:8.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></b></p>

<p class=MsoNormal><span style='font-size:8.0pt;font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=288 valign=top style='width:3.0in;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Requestor</span></p>
  </td>
  <td width=199 valign=top style='width:149.4pt;border-top:solid windowtext 1.5pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Organization</span></p>
  </td>
  <td width=204 valign=top style='width:153.0pt;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>E-mail/phone
  </span></p>
  </td>
 </tr>
 <tr style='height:20.0pt'>
  <td width=288 valign=top style='width:3.0in;border-top:none;border-left:solid windowtext 1.5pt;
  border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'><?php echo $requestor; ?></span></p>
  </td>
  <td width=199 valign=top style='width:149.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'>SPEC <?php echo $committee; ?></span></p>
  </td>
  <td width=204 valign=top style='width:153.0pt;border-top:none;border-left:
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
  <td width=288 valign=top style='width:3.0in;border:solid windowtext 1.5pt;
  border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Treasurer’s
  Approval (if required)</span></p>
  </td>
  <td width=245 valign=top style='width:2.55in;border-top:solid windowtext 1.5pt;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>E-mail/phone</span></p>
  </td>
  <td width=158 valign=top style='width:1.65in;border:solid windowtext 1.5pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:14.0pt;font-family:"Tahoma","sans-serif"'>Date
  Submitted</span></p>
  </td>
 </tr>
 <tr style='height:20.0pt'>
  <td width=288 valign=top style='width:3.0in;border-top:none;border-left:solid windowtext 1.5pt;
  border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=245 valign=top style='width:2.55in;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>
  </td>
  <td width=158 valign=top style='width:1.65in;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  padding:0in 5.4pt 0in 5.4pt;height:20.0pt'>
  <p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'><?php echo $submitted_date; ?></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span style='font-family:"Tahoma","sans-serif"'>&nbsp;</span></p>

</div>

</body>

</html>
