<?php
require_once("check_auth.php");
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
	</head>
	<body>
		<p>
			<br />
			<br />
		</p>
		<p style="padding: 2px;">
			<ul style="font-size: 11pt;">
				<li><a href="committee_budget.php?committee=<?php echo $_SESSION['s_auth']; ?>" target="home">Home</a></li>
				<li><a href="add_expense.php?committee=<?php echo $_SESSION['s_auth']; ?>" target="home">Add Expense</a></li>
				<li><a href="add_payment.php?committee=<?php echo $_SESSION['s_auth']; ?>" target="home">Add Payment</a></li>
				<li><a href="search.php?committee=<?php echo $_SESSION['s_auth']; ?>" target="home">Search</a></li>
				<li><a href="overview.php" target="home">SPEC Overview</a></li>
				<li><a href="help.php" target="home">Help</a></li>
			</ul>
		</p>
	</body>
</html>