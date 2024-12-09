<?php 
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Penyewaan</title>
</head>
<body>
    <h1>Hapus Penyewaan</h1>
    <form method="POST" action="proses_hapus.php">
        <label>ID Penyewaan yang akan dihapus:</label>
        <input type="text" name="id_penyewaan" required><br>
        
        <button type="submit">Hapus</button>
    </form>
</body>
</html>
