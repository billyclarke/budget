<?php
  session_start();
  $_SESSION = array();
  session_destroy();
  session_destroy();
  session_destroy();
  header("Location: ./");
?>
