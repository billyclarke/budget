<?php
include("CreateCSV.class.php");
require_once("db.php");
require_once("check_auth.php");
require_once("functions.php");

header("Expires: 0?");
header("Cache-control: private");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0?");
header("Content-Description: File Transfer");
header("Content-Type: text/csv");
header("Content-disposition: attachment; filename=SPEC_".str_replace(' ', '_',$_GET["main"])."_Budget.csv");

$sql = 'SELECT `requestor`, `date`, `item`, `vendor`, `cost`, `main`, `sub`, `type`, `note` FROM `budget` WHERE `committee` = \''.$_GET["main"].'\' AND `deleted` = \'no\' AND `date` > \''.$start_date.'\' AND `date` < \''.$end_date.'\' ORDER BY `main`,`sub`,`date` ASC';
print CreateCSV::create($sql, true, false);
?>