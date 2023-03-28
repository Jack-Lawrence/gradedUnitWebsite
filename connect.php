<?php
//Connecting to SQL database and selecting the relevant database to the webpage
$conn = mysqli_connect("localhost", "root", "root");
mysqli_select_db($conn, "port_website");
?>
