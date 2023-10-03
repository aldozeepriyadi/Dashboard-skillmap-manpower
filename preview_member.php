<?php include("includes/db_connection.php"); ?>
<?php include("includes/a_config.php");?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
</head>
<body>

<?php include("includes/design-top.php");?>

<?php
    $npk = $_REQUEST['q'];
    
    $q_res = $conn->query("SELECT * FROM karyawan WHERE id = ".$npk);
	$num_results = $q_res->num_rows;
    $karyawan = $q_res->fetch_assoc();
?>

<?php 
if ($num_results > 0)
	include("includes/content/profile-page.php");
else include("includes/content/not-found-page.php");
?>

</body>
</html>
