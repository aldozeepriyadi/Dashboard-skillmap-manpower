<?php
include("../includes/a_config.php");
include("../includes/db_connection.php");
include("../includes/redirect_session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npk = $_GET['q'];
    $cat = $_GET['cat'];

    $path = $_FILES['mp-file-input']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);

    $target_dir = "../files/";
    $filename = date('YmdHis').$npk.'.'.$ext;
    $target_file = $target_dir . $filename;

    if (!move_uploaded_file($_FILES["mp-file-input"]["tmp_name"], $target_file)) {
        $errMsg .= "Sorry, there was an error uploading your file.\\n";
    }

    $conn->query(
        "INSERT INTO mp_file_proof (npk, mp_category, filename) VALUES ('".$npk."', '".$cat."', '".$filename."')"
    );

    if(isset($_SERVER["HTTP_REFERER"])) {
        echo "<script>window.location.replace('".$_SERVER["HTTP_REFERER"]."');</script>";
        } else {
        echo "<script>window.location.replace('index.php');</script>";
    }
}

?>