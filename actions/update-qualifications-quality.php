<?php 
include("../includes/a_config.php");
include("../includes/db_connection.php");
include("../includes/redirect_session.php");

if(isset($_POST['update']))
{
    date_default_timezone_set('Asia/Jakarta');
    $qualifications = trim($_POST['qualificationsquality']);
    $q_arr = explode(" ", $qualifications);

    $conn->query("
        DELETE FROM `qualifications_quality` 
        WHERE npk = '".$_GET['q']."'
    ");
    foreach ($q_arr as $q) {
        $q = explode("-", $q);
        $q_id = $q[0];
        $q_val = $q[1];
        $quality_mandatory = $_POST["mandatory_value-quality-{$q_id}"];
        $jadwal_training =$_POST["jadwal_training_quality-{$q_id}"];
        $dateTime = new DateTime($jadwal_training); 
        $formattedDate = $dateTime->format("Y-m-d");
        $tanggalWaktuSekarang = new DateTime();
        $conn->query("
            INSERT INTO `qualifications_quality` 
            (npk, quality_id,value,jadwal_training_quality,status,created_at)
            VALUES (
            '".$_GET['q']."',
            ".$q_id.",
            ".$q_val." ,
            '".$formattedDate."',
            ".$quality_mandatory.",
            '".$tanggalWaktuSekarang->format('Y-m-d H:i:s')."'

            )
        ");
    }

    $query_string = '?q='.$_GET['q'];
    header("Location: ../preview_member.php$query_string");
}
?>
