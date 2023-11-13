<?php
include("../includes/a_config.php");
include("../includes/db_connection.php");
include("../includes/redirect_session.php");
// error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errMsg = "";
    $name = $npk = $dept = $role = $ws = "";

    if (empty($_POST["npk"])) {
        $errMsg .= "NPK is required\\n";
    } else {
        $npk = $_POST["npk"];
    }

    if ($errMsg != "") {
        echo "<script>alert('".$errMsg."');</script>";
        if(isset($_SERVER["HTTP_REFERER"])) {
            echo "<script>window.location.replace('".$_SERVER["HTTP_REFERER"]."');</script>";
        } else {
            echo "<script>window.location.replace('../index.php');</script>";
        }
    }

    if (empty($_POST["ws"])) {
        $errMsg .= "Workstation has not been selected\\n";
    } else {
        $ws = $_POST["ws"];
    }
    $role = $_POST["role"];

    $stmt = $conn->prepare("SELECT npk FROM karyawan WHERE npk = ?");
    $stmt->bind_param("s", $npk);
    $stmt->execute();
    $stmt->bind_result($res);
    $stmt->fetch();
    $stmt->close();

    if (isset($res) === false) {
        $errMsg .= "NPK does not exists.\\n";   
    }

    if ($errMsg == '') 
    {
        $ws = trim($ws);
        $ws_arr = explode(" ", $ws);
        try {
            $stmt = $conn->prepare("UPDATE karyawan SET role = ? WHERE npk = ?");
            $stmt->bind_param("is", $role, $npk);
            $stmt->execute();
            $stmt->close();

            $stmt = $conn->prepare("DELETE FROM karyawan_workstation WHERE npk = ?");
            $stmt->bind_param("s", $npk);
            $stmt->execute();
            $stmt->close();

            foreach($ws_arr as $ws)
            {
                $stmt = $conn->prepare("INSERT INTO karyawan_workstation (npk, workstation_id) VALUES (?, ?)");
                $stmt->bind_param("si", $npk, $ws);
                $stmt->execute();
                $stmt->close();
            }
            echo "<script>window.location.replace('../preview_member.php?q=$npk');</script>";  
        } catch(Exception $e) {
    
        }
    }
    echo "<script>alert('".$errMsg."');</script>";
    if(isset($_SERVER["HTTP_REFERER"])) {
    echo "<script>window.location.replace('".$_SERVER["HTTP_REFERER"]."');</script>";
    } else {
    echo "<script>window.location.replace('index.php');</script>";
    }
}
?>
