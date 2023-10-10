<?php 
include("../includes/a_config.php");
include("../includes/db_connection.php");

$q_res = $conn->query("SELECT id FROM karyawan WHERE id = ".$_GET['q']);
$num_results = $q_res->num_rows;

if ($num_results == 0) {
    echo "<script>alert('NPK tidak ditemukan');</script>";
    if(isset($_SERVER["HTTP_REFERER"])) {
        echo "<script>window.location.replace('".$_SERVER["HTTP_REFERER"]."');</script>";
    } else {
        echo "<script>window.location.replace('index.php');</script>";
    }
}

$karyawan = $q_res->fetch_assoc();
$query_string = '?q='.$karyawan['id'];
header("Location: ../preview_member.php$query_string");
?>
