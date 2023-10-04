<?php 
    include("../includes/db_connection.php");
    $sql_query=
        "UPDATE `karyawan` ".
        "SET ".
        "msk = ".$_POST['msk'].", ".
        "kt = ".$_POST['kt'].", ".
        "`pssp` = ".$_POST['pssp'].", ".
        "`png` = ".$_POST['png'].", ".
        "`fivejq` = ".$_POST['fivejq'].", ".
        "`kao` = ".$_POST['kao']." ".
        "WHERE `id` = ".$_GET['q'];
    $conn->query($sql_query);

    $query_string = '?q='.$_GET['q'];
    header("Location: ../preview_member.php$query_string");
?>
