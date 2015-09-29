<?php
session_start();
echo "UserID: ".$_SESSION["s_user_id"];
if (!$_SESSION["s_user_id"]){
  require("login.php");
}
else{
  require("committee_home.php");
}

?>
