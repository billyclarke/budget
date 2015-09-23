<?php
require_once("check_auth.php");
require_once("functions.php");
if($_SESSION['s_auth'] != "Admin"){
	die("You are not authorized to view this page with your credentials.");
}

?>
<html>
	<head>
		<title>SPEC Budget Database transfer</title>
	</head>
	<body>
		<table>
    <?php
    ?>
    </table>
<!--
      $newsql = 'INSERT INTO `budget_transactions` (`id`, `committee_id`, `requestor_id`, `submitted_date`, `action_date`, `execution_date`, `item`, `vendor`, `cost`, `category_id`, `subcategory`, `type_id`, `treasurer_approved`, `deleted`, `note`) VALUES (\''.$id.'\',\''.$committee_id.'\',\''.$requestor_id.'\',\''.$submitted_date.'\',\''.$action_date.'\',\''.$execution_date.'\',\''.$item.'\',\''.$vendor.'\',\''.$cost.'\',\''.$category_id.'\',\''.$subcategory.'\',\''.$type_id.'\',\''.$treasurer_approved.'\',\''.$deleted.'\',\''.$note.'\');';
      echo "
      <tr>
        <td>".stripslashes(ucwords($id))."&nbsp;</td>
        <td>".stripslashes(ucwords($committee))."&nbsp;</td>
        <td>".$committee_id."&nbsp;</td>
        <td>".stripslashes(ucwords($main_category))."&nbsp;</td>
        <td>".$category_id."&nbsp;</td>
        <td>".stripslashes(ucwords($requestor))."&nbsp;</td>
        <td>".$requestor_id."&nbsp;</td>
        <td>".stripslashes(ucwords($type))."&nbsp;</td>
        <td>".$type_id."&nbsp;</td>
      </tr>";
    }

    ?>
      $sql = 'INSERT INTO `budget_categories` (`id`, `committee_id`, `name`, `budget_code`, `deleted`) VALUES (\'\',\''.get_committee_id(stripslashes(ucwords($row[1]))).'\',\''.$row[2].'\',\''.$row[3].'\',\''.$row[4].'\');';
      $newddresult = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    $sql = 'SELECT `id`,`committee`,`submitted`,`requestor`,`date`,`item`,`vendor`,`cost`,`main`,`sub`,`type`,`treasurer_approved`,`advisor_approved`,`deleted`,`note` FROM `budget` ORDER BY `id`';
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    while($row = mysqli_fetch_array($result)){
      echo "
      <tr>
        <td>".stripslashes(ucwords($row[0]))."&nbsp;</td>
        <td>".stripslashes(ucwords($row[1]))."&nbsp;</td>
        <td>".get_committee_id(stripslashes(ucwords($row[1])))."&nbsp;</td>
      </tr>";
    }



    $sql = 'SELECT `id`,`committee`,`position`, `name`, `password`, `email`, `deleted` FROM `directors` ORDER BY `id`';
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    while($row = mysqli_fetch_array($result)){
      $id = $row[0];
      $committee = $row[1];
      $position = $row[2];
      $name = $row[3];
      $password = $row[4];
      $email = $row[5];
      $deleted = $row[6];
      $committee_id = get_committee_id($committee);
      $newsql = 'INSERT INTO `budget_users` (`id`, `committee_id`, `name`, `password`, `deleted`) VALUES (\''.$id.'\',\''.$committee_id.'\',\''.$name.'\',\''.$password.'\',\''.$deleted.'\');';
      echo "
      <tr>
        <td>".stripslashes(ucwords($id))."&nbsp;</td>
        <td>".stripslashes(ucwords($committee))."&nbsp;</td>
        <td>".$committee_id."&nbsp;</td>
        <td>".stripslashes(ucwords($name))."&nbsp;</td>
        <td>".stripslashes(ucwords($deleted))."&nbsp;</td>
        <td>".$newsql."&nbsp;</td>
      </tr>";
      //mysqli_query($GLOBALS["___mysqli_ston"], $newsql);
    }








function get_committee_id($committee_name){
  switch($committee_name){
    case "Admin":
      return 0;
    case "Art Gallery":
      return 1;
    case "Concerts":
      return 2;
    case "Connaissance":
      return 3;
    case "Film":
      return 4;
    case "Jazz and Grooves":
      return 5;
    case "SPEC-TRUM":
      return 6;
    case "Special Events":
      return 7;
    case "Spring Fling":
      return 8;
    case "Sound":
      return 9;
    case "sound":
      return 9;
    case "Exec":
      return 10;
    case "Fully Planned":
      return 11;
    case "Contingency":
      return 12;
    default:
      die("Unknown committee: ".$committee_name);
  }
}

function get_category_id($category_name, $committee_id){
  $sql = 'SELECT `id` FROM `budget_categories` WHERE 1 AND `committee_id` = \''.$committee_id.'\' AND `name` = \''.$category_name.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_user_id($user_name){
  if ($user_name == "Jenny"){
    return 119;
  }
  if ($user_name == "AJ"){
    return 118;
  }
  $sql = 'SELECT `id` FROM `directors` WHERE 1 AND `name` = \''.$user_name.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}

function get_type_id($type){
  if ($type == "ProCard"){
    return 1;
  }
  if ($type == "UA Budget"){
    return 0;
  }
  if ($type == "Reembursment"){
    return 2;
  }
  if ($type == "Contingency"){
    return 4;
  }
  $sql = 'SELECT `id` FROM `transaction_types` WHERE 1 AND `name` = \''.$type.'\' LIMIT 1';
  $result = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
  $row = mysqli_fetch_array($result);
  return $row[0];
}



-->
  </body>
</html>



