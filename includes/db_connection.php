<?php
$servername = "localhost";
$username = "admin";
$password = "admin123";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
function console_log($message) {
  echo "<script>console.log('".$message."')</script>";
}

$conn->select_db("kyb_test");
?>
