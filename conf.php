<?php
if($_SESSION['s_auth'] != "Admin"){
	$out = "the SPEC ".$_SESSION['s_auth']." Directors,";
}else{
	$out = "";
}
?>
<div style="width: 97%;">
		<p>
			<b>Confidentiality Notice:</b><br />
			The information on these pages is intended for <?php echo $out; ?> the SPEC Executive Board and the SPEC Advisors only. Distribution of this information to third-parties is strictly prohibited. If you are not an intended recipient, you must not copy, distribute or take any action in reliance on it.
		</p>
		<small>Software developed by <a href="mailto:andrewjshults@gmail.com">Andrew Shults</a> copyright 2008. Some parts developed by <a href="mailto:billyclarke94@gmail.com">Billy Clarke</a>, copyright 2013-2016</small>
	</div>
