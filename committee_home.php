<?php require_once("db.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require("bootstrap_head.html"); ?>
    <title>Committee Home</title>
  </head>
  <body style="padding-top:70px">
    <?php require("navbar.php") ?>
    <div><p>Committee  <?php echo get_committee_string($_SESSION["s_committee_id"]); ?></p></div>

    <?php require("bootstrap_foot.html"); ?>
  </body>
</html>
