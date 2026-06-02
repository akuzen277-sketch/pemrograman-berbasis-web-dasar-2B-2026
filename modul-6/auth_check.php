<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

function checkAdmin() {
    if ($_SESSION['role'] !== 'admin') {
        die("Akses Ditolak: Anda bukan Admin.");
    }
}
?>