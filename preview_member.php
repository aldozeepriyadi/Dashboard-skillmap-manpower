<?php include("includes/db_connection.php"); ?>
<?php include("includes/a_config.php");?>
<?php include("includes/redirect_session.php");?>
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
    
    $q_res = $conn->query("
        SELECT 
            karyawan.name as name,
            karyawan.npk as npk,
            department.dept_name as dept_name,
            karyawan.role as role,
            karyawan.msk as msk,
            karyawan.kt as kt,
            karyawan.pssp as pssp,
            karyawan.png as png,
            karyawan.fivejq as fivejq,
            karyawan.kao as kao,
            roles.name as role_name
        FROM karyawan 
        LEFT JOIN department ON karyawan.workspace_id = department.id 
        LEFT JOIN roles ON karyawan.role = roles.id
        WHERE npk = '".$npk."'"
    );
	$num_results = $q_res->num_rows;

    if ($num_results == 0) {
        echo "<script>alert('NPK tidak ditemukan');</script>";
        // exit();
    } else {
        $karyawan = $q_res->fetch_assoc();
    }
?>

<?php 
if ($num_results > 0)
	include("includes/content/profile-page.php");
else include("includes/content/not-found-page.php");
?>

</body>
</html>
