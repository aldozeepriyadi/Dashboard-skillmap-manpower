<?php
include ("../includes/a_config.php");
include ("../includes/db_connection.php");
include ("../includes/redirect_session.php");

if (isset($_POST['update'])) {
    // Mengatur zona waktu ke Jakarta
    date_default_timezone_set('Asia/Jakarta');

    $qualifications = trim($_POST['qualifications']);
    $q_arr = explode(" ", $qualifications);
    $conn->query("
        DELETE FROM `qualifications` 
        WHERE npk = '" . $_GET['q'] . "'");
    foreach ($q_arr as $q) {
        $q = explode("-", $q);
        $q_id = $q[0];
        $q_val = $q[1];
        $process_mandatory = $_POST["mandatory_value-{$q_id}"];
        $jadwal_training = $_POST["jadwal_training-{$q_id}"];

        // Format tanggal jadwal training
        $dateTime = new DateTime($jadwal_training);
        $formattedDate = $dateTime->format("Y-m-d");

        // Ambil tanggal dan waktu sekarang dalam format Indonesia
        $tanggalWaktuSekarang = new DateTime();

        $conn->query("
            INSERT INTO `qualifications` 
            (npk, process_id, value, jadwal_training_process, status, created_at)
            VALUES (
            '" . $_GET['q'] . "',
            " . $q_id . ",
            " . $q_val . ",
            '" . $formattedDate . "',
            " . $process_mandatory . ",
            '" . $tanggalWaktuSekarang->format('Y-m-d H:i:s') . "'
            )
        ");
    }

    $query_string = '?q=' . $_GET['q'];
    header("Location: ../preview_member.php$query_string");
}
?>