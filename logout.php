<?php
  session_start();

  //Log user out then send them back to the log in page
  session_destroy();
  header("location: index.php")
?>