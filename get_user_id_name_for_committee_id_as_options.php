<?php require_once("db.php")  ?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
<?php
$committee_id = $_GET['committee_id'];
$users = get_user_id_name_for_committee_id($committee_id);
foreach($users as $user){
  $id = $user[0];
  $name = $user[1];
  echo'<option value="'.$id.'">'.$name.'</option>';
}
?>
</body>
</html>
