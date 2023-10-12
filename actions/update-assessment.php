<?php 
include("../includes/a_config.php");
include("../includes/db_connection.php");
include("../includes/redirect_session.php");

if(isset($_POST['update']))
{
    $scores = array();
    foreach ($mp_categories as $cat => $cat_name) {
        if (isset($_POST[$cat])) $scores[$cat] = $_POST[$cat];
        else $scores[$cat] = 1;
    }

    $sql_query=
        "
        INSERT INTO `mp_scores` 
        (npk, msk, kt, pssp, png, fivejq, kao)
        VALUES (
        '".$_GET['q']."',
        ".$scores['msk'].", 
        ".$scores['kt'].", 
        ".$scores['pssp'].", 
        ".$scores['png'].", 
        ".$scores['fivejq'].", 
        ".$scores['kao']." 
        ) 
        ON DUPLICATE KEY UPDATE 
        msk = ".$scores['msk'].",
        kt = ".$scores['kt'].",
        pssp = ".$scores['pssp'].",
        png = ".$scores['png'].",
        fivejq = ".$scores['fivejq'].",
        kao = ".$scores['kao']."
        ";
    $conn->query($sql_query);

    $query_string = '?q='.$_GET['q'];
    header("Location: ../preview_member.php$query_string");
} else if (isset($_POST['delete'])) {
    $npk = $_GET['q'];

    $sql_query=
        "DELETE FROM `karyawan` ".
        "WHERE npk = '".$npk."'";
    $conn->query($sql_query);

    $target_dir = "../img/profile_pictures/";
    $target_file = $target_dir . $npk .'.jpg';
    unlink($target_file);
    header("Location: ../index.php");
}
?>
