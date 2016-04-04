<?php
require_once("check_auth.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title><?php echo $_SESSION['s_auth']; ?> Budget</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
body  {font-family: arial, helvetica, geneva, sans-serif; font-size: small}
//-->
</style>
</head>
<frameset rows="62,*">
	<frame src="spec_logo.php?auth=<?php echo $_SESSION['s_auth']; ?>" frameborder=0>
	<frameset cols="140,*">
		<frame src="nav.php" frameborder=0>
		<frame src="committee_budget.php?committee=<?php echo $_SESSION['s_auth']; ?>" name="home" frameborder=0>
	</frameset>
</frameset>
</html>
