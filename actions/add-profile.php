<?php
include("../includes/a_config.php");
include("../includes/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errMsg = "";
    $name = $npk = $workstation = $role = "";

    if (empty($_POST["name"])) {
        $errMsg .= "Name is required\n";
    } else {
        $name = $_POST["name"];
    }

    if (empty($_POST["npk"])) {
        $errMsg .= "NPK is required\n";
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

    $target_dir = "../img/profile_pictures/";
    $target_file = $target_dir . $npk .'.jpg';
    $uploadOk = 1;
    
    if (move_uploaded_file($_FILES["ap-form-photo"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } 
    else {
    echo "Sorry, there was an error uploading your file.";
    }

    $workstation = $_POST["workstation"];
    $role = $_POST["role"];

    try {
        $stmt = $conn->prepare("INSERT INTO karyawan (id, name, dept_id, member_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $npk, $name, $workstation, $role);
        $stmt->execute();
        $stmt->close();
        echo "<script>window.location.replace('../index.php');</script>";  
      } catch(Exception $e) {
        if($conn->errno === 1062) $errMsg .= "NPK already exists\n";
        else $errMsg .= "Error: " . $e->getMessage() . "\n";
      }
      echo "<script>alert('".$errMsg."');</script>";
      if(isset($_SERVER["HTTP_REFERER"])) {
        echo "<script>window.location.replace('".$_SERVER["HTTP_REFERER"]."');</script>";
      } else {
        echo "<script>window.location.replace('index.php');</script>";
      }
}
?>
