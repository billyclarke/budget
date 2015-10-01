<?php
session_start();
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require("bootstrap_head.html") ?>
    <title>SPEC Budget Login</title>
    <script>
function setUserOptions(committee_id){
  if (committee_id == "") {
    document.getElementById("user_id").innerHTML = "";
    return;
  } else {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
        document.getElementById("user_id").innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","get_user_id_name_for_committee_id_as_options.php?committee_id="+committee_id,true);
    xmlhttp.send();
  }
}

    </script>
  </head>
  <body>

    <div class="container">

      <form action="login_handler.php" method="post" class="form-signin" style="max-width:300px; padding: 15px; margin: 0 auto;">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="committee_id" class="sr-only">Committee</label>
        <select class="form-control" id="committee_id" name="committee_id" onchange="setUserOptions(this.value)">
          <?php $committees = get_committees_id_name();
            foreach($committees as $committee){
              $id = $committee[0];
              $name = $committee[1];
              echo'<option value="'.$id.'">'.$name.'</option>';
            }
          ?>
        </select>
        <label for="user_id" class="sr-only">Name</label>
        <select class="form-control" id="user_id" name="user_id">
        </select>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-primary btn-block" type="submit" style="max-width:100px; margin: 15px auto;">Sign in</button>
      </form>

    </div> <!-- /container -->

    <?php require("bootstrap_foot.html") ?>
  </body>
</html>
