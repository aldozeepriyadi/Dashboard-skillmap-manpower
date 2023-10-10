<?php
include("../includes/a_config.php");
include("../includes/db_connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($res);
    $stmt->fetch();
    $stmt->close();

    if ((isset($res) === false)) {
        echo "<script>alert('User atau password Anda salah. Silakan coba lagi!')</script>";
        echo "<script>window.location.replace('../login_page.php');</script>";  
    }
    
    $_SESSION['username'] = $res;
    echo "<script>window.location.replace('../index.php');</script>";  
    
}
?>
