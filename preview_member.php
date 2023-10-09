<?php include("includes/db_connection.php"); ?>
<?php include("includes/a_config.php");?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
    <script src="js/profile-page.js"></script>
    <script src="js/search-npk.js"></script>
</head>
<body>

<?php include("includes/design-top.php");?>

<?php
    $npk = $_REQUEST['q'];
    
    $q_res = $conn->query("SELECT * FROM karyawan WHERE id = ".$npk);
	$num_results = $q_res->num_rows;

    if ($num_results == 0) {
        echo "<script>alert('NPK tidak ditemukan');</script>";
        // exit();
    }
    else {
        $karyawan = $q_res->fetch_assoc();
        $q_res = $conn->query("SELECT dept_name FROM department WHERE id = ".$karyawan['dept_id']);
        $row = $q_res->fetch_assoc();
        $karyawan['dept_name'] = $row['dept_name'];
    }
?>

<?php 
if ($num_results > 0)
	include("includes/content/profile-page.php");
else include("includes/content/not-found-page.php");
?>

</body>
</html>
