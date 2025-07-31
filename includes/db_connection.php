<?php
include('db_config_.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name, $db_port);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
function console_log($message) {
  echo "<script>console.log('".$message."')</script>";
}

$conn->select_db($db_name);
?>
