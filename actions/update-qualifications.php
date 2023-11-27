<?php 
include("../includes/a_config.php");
include("../includes/db_connection.php");
include("../includes/redirect_session.php");

if(isset($_POST['update']))
{
    $qualifications = trim($_POST['qualifications']);
    $q_arr = explode(" ", $qualifications);

    $conn->query("
        DELETE FROM `qualifications` 
        WHERE npk = '".$_GET['q']."'
    ");
    foreach ($q_arr as $q) {
        $q = explode("-", $q);
        $q_id = $q[0];
        $q_val = $q[1];
        $conn->query("
            INSERT INTO `qualifications` 
            (npk, process_id, value)
            VALUES (
            '".$_GET['q']."',
            ".$q_id.",
            ".$q_val."
            )
        ");
    }

    $query_string = '?q='.$_GET['q'];
    header("Location: ../preview_member.php$query_string");
}
?>
