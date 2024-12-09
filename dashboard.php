<?php
session_start();

// Periksa jika pengguna tidak login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Periksa peran pengguna
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        a {
            display: inline-block;
            margin: 10px 0;
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    
    <?php if ($role == 'admin') : ?>
        <!-- Dashboard Admin -->
        <h2>Admin Dashboard</h2>
        <a href="tambah_penyewaan.php">Tambah Penyewaan</a><br>
        <a href="edit_penyewaan.php">Edit Penyewaan</a><br>
        <a href="hapus_penyewaan.php">Hapus Penyewaan</a><br>
        <a href="logout.php">Logout</a>
    <?php elseif ($role == 'user') : ?>
        <!-- Dashboard User -->
        <h2>User Dashboard</h2>
        <a href="tambah_penyewaan.php">Tambah Penyewaan</a><br>
        <a href="logout.php">Logout</a>
    <?php else : ?>
        <p>Peran Anda tidak dikenal.</p>
    <?php endif; ?>
</body>
</html>
