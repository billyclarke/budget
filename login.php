<?php
session_start();
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPEC Budget Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form action="login_handler.php" method="post" class="form-signin" style="max-width:300px; padding: 15px; margin: 0 auto;">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="user_id" class="sr-only">Name</label>
        <select class="form-control" id="user_id" name="user_id">
          <?php $users = get_user_id_name_for_committee_id($comittee_id);
            foreach($users as $user){
              $id = $user[0];
              $name = $user[1];
              echo'<option value="'.$id.'">'.$name.'</option>';
            }
          ?>
        </select>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-primary btn-block" type="submit" style="max-width:100px; margin: 15px auto;">Sign in</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>
