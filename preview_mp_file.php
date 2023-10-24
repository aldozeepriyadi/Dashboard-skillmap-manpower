<?php include("includes/db_connection.php"); ?>
<?php include("includes/a_config.php");?>
<?php include("includes/redirect_session.php");?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
</head>
<body>
<?php include("includes/design-top.php");?>
<?php
    $q_res = $conn->query("
        SELECT 
            karyawan.name as name,
            karyawan.npk as npk,
            sub_workstations.id as sub_ws_id,
            sub_workstations.name as sub_ws_name,
            workstations.id as ws_id,
            workstations.name as ws_name,
            department.id as dept_id,
            department.dept_name as dept_name,
            karyawan.role as role,
            IFNULL(mp_scores.msk,0) as msk,
            IFNULL(mp_scores.kt,0) as kt,
            IFNULL(mp_scores.pssp,0) as pssp,
            IFNULL(mp_scores.png,0) as png,
            IFNULL(mp_scores.fivejq,0) as fivejq,
            IFNULL(mp_scores.kao,0) as kao,
            roles.name as role_name
        FROM karyawan 
        LEFT JOIN karyawan_workstation ON karyawan_workstation.npk = karyawan.npk 
        LEFT JOIN sub_workstations ON karyawan_workstation.workstation_id = sub_workstations.id
        LEFT JOIN workstations ON sub_workstations.workstation_id = workstations.id 
        LEFT JOIN department ON workstations.dept_id = department.id 
        LEFT JOIN roles ON karyawan.role = roles.id
        LEFT JOIN mp_scores on karyawan.npk = mp_scores.npk
        WHERE karyawan.npk = '".$_GET['q']."'"
    );

    $num_results = $q_res->num_rows;
    if ($num_results == 0) {
        echo "<script>alert('NPK tidak ditemukan');</script>";
    } else {
        $karyawan = $q_res->fetch_assoc();
    }
?>

<?php 
if ($num_results <= 0)
	include("includes/content/not-found-page.php");
else include("includes/content/mp-files.php")
?>

</body>
</html>
