<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Cek role pengguna
if ($_SESSION['role'] == 'admin') {
    header("Location: admin_dashboard.php");
    exit();
} else if ($_SESSION['role'] == 'user') {
    header("Location: user_dashboard.php");
    exit();
} else {
    // Jika role tidak valid, logout dan kembali ke login
    session_destroy();
    header("Location: login.php");
    exit();
}
$conn = mysqli_connect("localhost", "root", "", "nama_database");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>