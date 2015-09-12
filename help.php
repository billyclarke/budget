<?php
require_once("check_auth.php");
?>
<html>
	<head>
		<title>SPEC Budget Help</title>
	</head>
	<body>
		<h2>Help</h2>
		<h3>Our budget isn't what we expected it to be</h3>
		<p>
			The most likely reason for this is due to an "Internal Budget Transfer". Rather than showing up as an expense, this money is deducted from that line item and transferred to the other committee's budget. The item will still show up on your budget, but whatever money was transferred will no longer be there.
		</p>
		<h3>I put in an incorrect expense/payment</h3>
		<p>
			To keep data from being accidently removed, only the treasurer or advisor can remove expenses. To have an expense removed, please contact one of them.
		</p>
		<h3>I cannot transfer money to another committee</h3>
		<p>
			Only the treasurer or advisor can perform an "Internal Budget Transfer". Please do not try to use the "Budget Transfer" option for internal transfers as this will cause a discrepancy in the accounting.
		</p>
		<h3>I want to change my password</h3>
		<p>
			Please contact the treasurer or advisor who will reset your password to "SPEC Events". The next time you login you will be required to select a new password.
		</p>
		<h3>The pages look weird or do not work as expected</h3>
		<p>
			This application was developed and tested in Firefox 2 and 3, if you are not using Firefox, please switch to it and see if the problem persists.
		</p>
		<h3>There is a warning on our main page</h3>
		<p>
			If you go over your total budget or an individual event budget a warning is automatically generated. This does not keep you from adding addition expenses, but it will remain until it is cleared by the treasurer or advisor.
		</p>
		<h3>Some items are highlighted in blue</h3>
		<p>
			These items are awaiting approval from the treasurer/advisor and they should clear within a day or so. If they do not, please make sure you have submitted the correct OSL paperwork.
		</p>
		
		<br />
		<?php require_once("conf.php"); ?>
	</body>
</html>