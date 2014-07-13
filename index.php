<?php

// Attempt to connect with credentials
$con = mysql_connect("localhost", "root", "");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
if (!mysql_select_db("pdo_samples")) {
  die('Could not select database: ' . mysql_error());
}

// Create SQL and run
$sql = "SELECT * FROM `table` WHERE 1";
mysql_query($sql,$con);

// Close the connection
mysql_close($con);