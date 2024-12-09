<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
    include('login.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna</title>
</head>
<body>
    <h1>Selamat Datang, Pengguna <?php echo $_SESSION['username']; ?>!</h1>
    <a href="tambah_penyewaan.php">Tambah Penyewaan</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>
