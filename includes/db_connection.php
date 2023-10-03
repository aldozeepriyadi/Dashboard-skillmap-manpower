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
$q_res = $conn->query("SELECT AVG(msk) as average FROM karyawan WHERE dept_id = 1");
// while ($row = $q_res->fetch_assoc()) {
  // echo "<script>console.log('".$row['average']."')</script>";
  // }
$tes = 1;
if (array_key_exists('p', $_REQUEST)) {
  $tes = $_REQUEST['p'];
}
console_log($tes);
?>
