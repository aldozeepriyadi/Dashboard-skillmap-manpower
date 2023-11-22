<?php 
include("../includes/a_config.php");
include("../includes/db_connection.php");
include("../includes/redirect_session.php");

if(isset($_POST['update']))
{
    $certifications = trim($_POST['s-certifications']);
    $q_arr = explode(" ", $certifications);

    $conn->query("
        DELETE FROM `s_process_certification` 
        WHERE npk = '".$_GET['q']."'
    ");

    foreach ($q_arr as $q) {
        $conn->query("
            INSERT INTO `s_process_certification` 
            (npk, s_process_id)
            VALUES (
            '".$_GET['q']."',
            ".strval($q)."
            )
        ");
    }

    $query_string = '?q='.$_GET['q'];
    header("Location: ../preview_member.php$query_string");
}
?>
