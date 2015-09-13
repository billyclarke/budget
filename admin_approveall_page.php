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
		<title>SPEC Budget: Approve Items</title>
		<style>
			a{
				color: black;
				text-decoration: none;
			}	
			a:visited{
				color: black;
			}
			a:hover{
				text-decoration: underline;
			}
		</style>
		<script type="text/javascript">
			function changecom(committee){
				parent.nav.document.getElementById('committee').value = committee;
				parent.nav.document.getElementById("hide_home").style.visibility = "visible";
				parent.nav.document.getElementById("hide_admin").style.visibility = "visible";
			}
		</script>
	</head>
	<body>
    <?php
      $sql = 'SELECT `id`,`committee_id`,`requestor_id`,`action_date`,`item`,`vendor`,`cost`,`category_id`,`subcategory`,`type_id` FROM `budget_transactions` WHERE 1 AND `treasurer_approved` = \'no\' AND `deleted` = \'no\' ORDER BY `id` DESC';
      $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
      if(mysqli_num_rows($result) > 0){
    ?>
        <div style="border: thin solid rgb(0,0,0);">
          <table width="100%">
            <tr>
              <td bgcolor="tomato" colspan="5">&nbsp;<b>Items Awaiting Approval</b></td>
            </tr>
    <?php
        while($row = mysqli_fetch_array($result)){
          $neg = "";
          if($row[6] < 0){
            $neg = "-";
          }
          echo "<tr><td>[<a href='approve.php?id=".$row[0]."'>Approve</a>]</td><td>".$row[3]."</td><td>".get_committee_string($row[1])." (".get_category_string($row[7]).")</td><td>".get_user_string($row[2])."</td><td>".$neg."$".number_format(abs($row[6]),2)."</td><td>".get_type_string($row[9])."</td><td>".$row[5]." - ".$row[4]."</td></tr>";
        }
        echo "</table></div>";
      }
      ?>
    </table>
		<p></p>
		<?php require_once("conf.php"); ?>
	</body>
</html>
