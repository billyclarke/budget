<?php
require_once("check_auth.php");
require_once("db.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
?>
<html>
	<head>
		<title>SPEC Budget Navigation</title>
		<link type="text/css" rel="stylesheet" href="style.css" />
		<style>
			a{
				color: blue;
				text-decoration: none;
			}	
			a:visited{
				color: blue;
			}
			a:hover{
				text-decoration: underline;
			}
		</style>
		<script type="text/javascript">
			function gocommittee(url,override){
				if(document.getElementById("committee").value == "Home"){
					parent.home.location = "treasurer.php";
					document.getElementById("hide_admin").style.visibility = "hidden";
					document.getElementById("hide_home").style.visibility = "hidden";
				}else if(document.getElementById("committee").value == "Internal Transfer"){
					parent.home.location = "internal_transfer.php";
					document.getElementById("hide_admin").style.visibility = "hidden";
					document.getElementById("hide_home").style.visibility = "hidden";
				}else if(document.getElementById("committee").value == "Help"){
					parent.home.location = "help.php";
					document.getElementById("hide_admin").style.visibility = "hidden";
					document.getElementById("hide_home").style.visibility = "hidden";
				}else if(document.getElementById("committee").value == "Backup"){
					parent.home.location = "backupDB.php";
					document.getElementById("hide_admin").style.visibility = "hidden";
					document.getElementById("hide_home").style.visibility = "hidden";
				}else{
					if(document.getElementById("committee").value != "Admin" || override == 'yes'){
						if(override != 'yes'){
							document.getElementById("hide_home").style.visibility = "visible";
							document.getElementById("hide_admin").style.visibility = "visible";
						}
						parent.home.location = url+"?committee="+document.getElementById("committee").value; 
					}else{
						parent.home.location = "treasurer.php";
						document.getElementById("hide_admin").style.visibility = "hidden";
						document.getElementById("hide_home").style.visibility = "visible";
					}
				}
			}
		</script>
	</head>
	<body style="padding: 4px;">
			<br />
		<p>
			<form name="com">
				<select style="font-size:11pt;" name="committee" id="committee" style="width:136px;" onchange="gocommittee('committee_budget.php');">
					<optgroup label="Administration">
						<option selected>Home</option>
						<option value="Admin">Admin Group</option>
						<!--<option>Create Committee</option>-->
						<option value="Backup">Backup Database</option>
						<option>Internal Transfer</option>
						<option>Help</option>
					</optgroup>
					<optgroup label="Committees">
						<?php
							$committees = get_committees();
							for($i = 0; $i < sizeof($committees); $i++){
								echo "<option>".$committees[$i]."</option>";
							}
						?>
					</optgroup>
				</select>
			</form>
			
			<br />
				<ul style="font-size: 11pt;">
					<div id="hide_home" style="visibility: hidden;">
						<li><a href="javascript:;" onclick="gocommittee('add_director.php','yes');">Add Director</a></li>
						<li><a href="javascript:;" onclick="gocommittee('delete_director.php','yes');">Delete Director</a></li>
						<li><a href="javascript:;" onclick="gocommittee('reset_director.php','yes');">Reset Password</a></li>
					</div>
					<div id="hide_admin" style="visibility: hidden;">
						<li><a href="javascript:;" onclick="gocommittee('committee_budget.php','no');">Budget</a></li>
						<li><a href="javascript:;" onclick="gocommittee('add_expense.php','no');">Add Expense</a></li>
						<li><a href="javascript:;" onclick="gocommittee('add_payment.php','no');">Add Payment</a></li>
						<li><a href="javascript:;" onclick="gocommittee('search.php','no');">Search</a></li>
						<li><a href="javascript:;" onclick="gocommittee('add_budget_item.php','no');">Add Budget Category</a></li>
						<li><a href="javascript:;" onclick="gocommittee('delete_budget_item.php','no');">Delete Budget Category</a></li>
					</div>
				</ul>
		</p>
	</body>
</html>
