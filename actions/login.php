<?php
include ("../includes/a_config.php");
include ("../includes/db_connection.php");
include "../lib/phpPasswordHashingLib-master/passwordLib.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $status = '';
    if (isset($_POST['captcha']) || ($_POST['captcha'] != "")) {
        if (strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0) {
            echo "<script>alert('Captcha salah. Silakan coba lagi!')</script>";
            echo "<script>window.location.replace('../login_page.php');</script>";
            exit();
        }
    }

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Input password

    $stmt = $conn->prepare("SELECT username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($res_username, $hashed_password, $res_role);
    $stmt->fetch();
    $stmt->close();

    if ($res_username && password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $res_username;
        $_SESSION['role'] = $res_role;
        echo "<script>window.location.replace('../index.php');</script>";
    } else {
        echo "<script>alert('User atau password Anda salah. Silakan coba lagi!')</script>";
        echo "<script>window.location.replace('../login_page.php');</script>";
    }
}
?>