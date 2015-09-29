<?php
require_once("check_auth.php");
require_once("db.php");
require_once("functions.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
?>
<html>
	<head>
		<title>Internal Transfer</title>
	</head>
	<body>
		<h2>Internal Budget Transfer</h2>
		<?php
		if(!$_POST['from_committee']){
		?>
		<form action="internal_transfer.php" method="POST">
			<table>
				<tr>
					<td>From:</td>
					<td>
						<select name="from_committee" style="width:120px;">
							<?php
								$committees = get_committees();
								for($i = 0; $i < sizeof($committees); $i++){
									echo "<option>".$committees[$i]."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>To:</td>
					<td>
						<select name="to_committee" style="width:120px;">
							<?php
								$committees = get_committees();
								for($i = 0; $i < sizeof($committees); $i++){
									echo "<option>".$committees[$i]."</option>";
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Submit" /></td>
				</tr>
			</table>
		</form>
		<?php
			}elseif(!$_POST['from_sub']){
        $from_committee = $_POST['from_committee'];
        $from_committee_id = get_committee_id($from_committee);
        $to_committee = $_POST['to_committee'];
        $to_committee_id = get_committee_id($to_committee);
		?>
				<form action="internal_transfer.php" method="POST">
					<input type="hidden" name="from_committee" value="<?php echo $from_committee; ?>" />
					<input type="hidden" name="to_committee" value="<?php echo $to_committee; ?>" />
					<table>
						<tr>
							<td>From:</td>
							<td><?php echo $from_committee; ?></td>
							<td>
								<select name="from_sub">
								<?php
									$sql = 'SELECT `name` FROM `budget_categories` WHERE 1 AND `committee_id` = \''.$from_committee_id.'\' AND `deleted` = \'no\' ORDER BY `name` ASC LIMIT 0, 30';
									$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
									while($row = mysqli_fetch_array($result)){
										echo "<option>".$row[0]."</option>";
									}
								?>
								</select>	
							</td>
						</tr>
						<tr>
							<td>To:</td>
							<td><?php echo $to_committee; ?></td>
							<td>
								<select name="to_sub">
								<?php
									$sql = 'SELECT `name` FROM `budget_categories` WHERE 1 AND `committee_id` = \''.$to_committee_id.'\' AND `deleted` = \'no\' ORDER BY `name` ASC LIMIT 0, 30';
									$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
									while($row = mysqli_fetch_array($result)){
										echo "<option>".$row[0]."</option>";
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td><input type="submit" value="Submit" /></td>
						</tr>
					</table>
				</form>
				<?php
					}elseif(!$_POST['amount']){
						if($from_committee == $to_committee && $_POST['from_sub'] == $_POST['to_sub']){
							die("You cannot transfer to and from the same budget item.");
						}
            $from_category = $_POST['from_sub'];
            $from_category_id = get_category_id($from_category);
            $to_category = $_POST['to_sub'];
            $to_category_id = get_category_id($to_category);
            $sql = 'SELECT SUM(`cost`) FROM `budget_transactions` WHERE 1 AND `committee_id` = \''.$from_committee_id.'\' AND `category_id` = \''.$from_category_id.'\' AND `deleted` = \'no\'';
						$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$row =  mysqli_fetch_array($result);
				?>
						<script type="text/javascript">
							function checkForm(){
								if(document.getElementById('amount').value > <?php echo $row[0]; ?>){
									alert('Over allowed limit ($<?php echo $row[0]; ?>)'); 
									return false;
								}
								if(document.getElementById('amount').value < 0.01){
									alert('Amount must be at least 0.01');
									return false;
								}
							}
						</script>
						<form action="internal_transfer.php" method="POST" onsubmit="return checkForm();">
							<input type="hidden" name="from_committee" value="<?php echo $from_committee; ?>" />
							<input type="hidden" name="to_committee" value="<?php echo $to_committee; ?>" />
							<input type="hidden" name="from_sub" value="<?php echo $_POST['from_sub']; ?>" />
							<input type="hidden" name="to_sub" value="<?php echo $_POST['to_sub']; ?>" />
							<input type="hidden" name="max" value="<?php echo $row[0]; ?>" />
							Transfer $<input type="text" name="amount" id="amount" value="0.00" /> (max of $<?php echo $row[0]; ?>) from <?php echo $_POST['from_sub']; ?> (<?php echo $from_committee; ?>) to <?php echo $_POST['to_sub']; ?> (<?php echo $to_committee; ?>)<br />
							<input type="submit" value="Submit" />
						</form>
						<?php
					}else{
						if(round($_POST['amount'],2) > $_POST['max']){
							die("Transfer amount exceeds the maximum.");
						}
						$today = date("Y-m-d");
						$transfer = "Transfer to ".$to_committee;
						$sql = 'INSERT INTO `budget_transactions` (`id`, `committee_id`, `submitted_date`, `requestor_id`, `action_date`, `item`, `vendor`, `cost`, `category_id`, `subcategory`, `type_id`, `treasurer_approved`) VALUES (\'\', \''.$from_committee_id.'\', \''.$today.'\', \''.get_user_id("Treasurer").'\', \''.$today.'\', \''.$transfer.'\', \'\', \'-'.$_POST['amount'].'\', \''.$from_category_id.'\', \'\', \''.get_type_id("Internal Budget Transfer").'\', \'no\');';
						$result1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$first_id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

						$transfer = "Transfer from ".$from_committee;
						$sql = 'INSERT INTO `budget_transactions` (`id`, `committee_id`, `submitted_date`, `requestor_id`, `action_date`, `item`, `vendor`, `cost`, `category_id`, `subcategory`, `type_id`, `treasurer_approved`) VALUES (\'\', \''.$to_committee_id.'\', \''.$today.'\', \''.get_user_id("Treasurer").'\', \''.$today.'\', \''.$transfer.'\', \''.$first_id.'\', \'-'.$_POST['amount'].'\', \''.$to_category_id.'\', \'\', \''.get_type_id("Internal Budget Transfer").'\', \'no\');';
						$result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						$second_id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

						$sql = "UPDATE budget_transactions SET `vendor` = '".$second_id."' WHERE `id` = '".$first_id."'";
						$result3 = mysqli_query($GLOBALS["___mysqli_ston"], $sql);

						echo "$".$_POST['amount']." was moved from ".$from_committee." (".$_POST['from_sub'].") to ".$to_committee." (".$_POST['to_sub'].")<br />";
						echo "<a href='treasurer.php'>Click to continue</a>";
					}
				?>
				<?php require_once("conf.php"); ?>
	</body>
</html>
