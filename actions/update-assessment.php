<?php 
    include("../includes/a_config.php");
    include("../includes/db_connection.php");

    $scores = array();
    foreach ($mp_categories as $cat => $cat_name) {
        if (isset($_POST[$cat])) $scores[$cat] = $_POST[$cat];
        else $scores[$cat] = 1;
    }

    $sql_query=
        "UPDATE `karyawan` ".
        "SET ".
        "msk = ".$scores['msk'].", ".
        "kt = ".$scores['kt'].", ".
        "`pssp` = ".$scores['pssp'].", ".
        "`png` = ".$scores['png'].", ".
        "`fivejq` = ".$scores['fivejq'].", ".
        "`kao` = ".$scores['fivejq']." ".
        "WHERE `id` = ".$_GET['q'];
    $conn->query($sql_query);

    $query_string = '?q='.$_GET['q'];
    header("Location: ../preview_member.php$query_string");
?>
