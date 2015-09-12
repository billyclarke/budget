<?php
require_once("check_auth.php");
if(!isset($_GET['committee'])){
	die("No committee selected");
}
$committee = $_GET['committee'];
require_once("db.php");
if($committee == "Admin"){
	die("The Admin usergroup does not have an associated budget.");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php echo $_GET['committee']; ?> Budget - Add Payment</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
		<link type="text/css" rel="stylesheet" href="autosuggest_inquisitor.css" />
    <script language="javascript" src="bsn.AutoSuggest_2.1.3_comp.js"></script>
		<script language="javascript" src="form_validate.js"></script>
		<script type="text/javascript">
			function noenter() {
  		return !(window.event && window.event.keyCode == 13); }
		</script>
	</head>
	<body>
	<div class="ss-form-container"><h1><?php echo $_GET['committee']; ?> Budget - Add Payment</h1>
	<p></p>
	<pre class="ss-form-desc">In addition to filling out the OSL paperwork and submitting your receipts, it is necessary to fill out this form for any budget payments.</pre>
	<p></p>
	<pre class="ss-form-desc"><b bgcolor="red"><?php echo nl2br(stripslashes(stripslashes($_GET["validate_error"]))); ?></b></pre>
	<p></p>
	<form action="add_payment2.php" method="POST" onSubmit="return checkdate(this.paid_date, this)">
		<input type="hidden" name="committee" value="<?php echo $_GET['committee']; ?>" />
		<div class="ss-form-entry">
			<span class="ss-q-title">Requestor</span>
			<input type="text" name="requestor" value="<?php echo $_SESSION['s_name'];?>" readonly="true" />
		</div>
		
		<div class="ss-form-entry">
			<span class="ss-q-title">Date</span>
			<span class="ss-q-help">The date the payment was received (mm/dd/yyyy)</span>
			<input type="text" class="ss-q-short" name="paid_date" maxlength="10" value="<?php echo $_GET["paid_date"]; ?>" />
		</div>
		
		<div class="ss-form-entry">
			<span class="ss-q-title">Item</span>
			<span class="ss-q-help">Please include a specific description of what the payment is for</span>
			<input type="text" class="ss-q-short" name="item" maxlength="200" value="<?php echo $_GET["item"]; ?>" />
		</div>
		
		<div class="ss-form-entry">
			<span class="ss-q-title">Vendor/Group</span>
			<span class="ss-q-help">If this is for ticket sales (i.e. no specific group), please write ticket sales</span>
			<input type="text" class="ss-q-short" name="vendor" maxlength="100" value="<?php echo $_GET["vendor"]; ?>" />
		</div>
		
		<div class="ss-form-entry">
			<span class="ss-q-title">Amount</span>
			<span class="ss-q-help">xxxx.xx (no $ or ,)</span>
			<input type="text" class="ss-q-short" name="cost" maxlength="15" value="<?php echo $_GET["cost"]; ?>" />
		</div>
		
		<div class="ss-form-entry">
			<span class="ss-q-title">Payment Type</span>
			<span class="ss-q-help">How was the payment received</span>
			<select name="expense">
				<option>Cash Drop</option>
				<option>Check</option>
				<option>Budget Transfer</option>
				<?php
				if($_SESSION['s_auth'] == "Admin"){
					echo "<option>UA Budget</option>";
				}
				?>
			</select>
		</div>
		
		<div class="ss-form-entry">
			<span class="ss-q-title">Main Category</span>
			<span class="ss-q-help"></span>
			<select name="main">
				<?php
				$sql = "SELECT `item` FROM `budget_item` WHERE 1 AND `committee` = '".$committee."' AND `deleted` = 'no'";
				$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
				if(mysqli_num_rows($result) == 0){
					die("Either the committee does not exist or it has not been set up correctly. Please contact Andrew at andrewjshults@gmail.com");
				}
				while($row = mysqli_fetch_array($result)){
					echo "<option>".$row[0]."</option>";
				}
				?>
			</select>
		</div>
		
		<div class="ss-form-entry">
			<span class="ss-q-title">Sub Category</span>
			<span class="ss-q-help">i.e. Hospitality, Production, etc.</span>
			<input type="text" class="ss-q-short" name="sub" id="sub" maxlength="100" onkeydown="return noenter();" value="<?php echo $_GET["sub"]; ?>" />
		</div>
		
		<div class="ss-form-entry">
			<span class="ss-q-title">Notes</span>
			<span class="ss-q-help">Maximum of 255 characters</span>
			<textarea rows="2" cols="20" name="note"><?php echo $_GET["note"]; ?> </textarea>
		</div>
<p></p>
<p></p>
<input type="submit" value="Submit" /></form>
<p></p>
<p></p>
<?php require_once("conf.php"); ?>
<script>
	var options = {
			script: "sub_ajax.php?committee=<?php echo $committee; ?>&",
			delay: 10,
			varname: "input",
			maxresults: 10
		};
		var as = new bsn.AutoSuggest('sub', options);
	</script>
</body>
</html>