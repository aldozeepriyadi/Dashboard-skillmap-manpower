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
$conn->select_db("kyb_test");
$q_res = $conn->query("SELECT * FROM karyawan");
while ($row = $q_res->fetch_assoc()) {
  echo "<script>console.log('".$row['name']."')</script>";
}
?>