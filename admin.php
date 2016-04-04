<?php
require_once("check_auth.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>Treasurer Budget</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
body  {font-family: arial, helvetica, geneva, sans-serif; font-size: small}
//-->
</style>
</head>
<frameset rows="46,*">
	<frame src="spec_logo.php?sid=<?php echo $_GET['sid']; ?>&auth=<?php echo $_SESSION['s_auth']; ?>" frameborder=0 noresize>
	<frameset cols="165,*">
		<frame src="admin_nav.php?sid=<?php echo $_GET['sid']; ?>" name="nav" frameborder=0 noresize>
		<frame src="treasurer.php?sid=<?php echo $_GET['sid']; ?>" name="home" frameborder=0 noresize>
	</frameset>
</frameset>
</html>
