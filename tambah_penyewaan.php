<?php  
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penyewaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .form-container, .table-container {
            background: #fff;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
        }

        input, button {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Formulir Tambah Penyewaan</h2>
        <form method="POST" action="proses_tambah.php">
            <label>Id_penyewaan:</label>
            <input type="text" name="id_penyewaan" required>

            <label>Nama Penyewa:</label>
            <input type="text" name="nama" placeholder="Masukkan nama penyewa" required>

            <label>Telepon:</label>
            <input type="text" name="telopon" required>
            
            <label>Tanggal Peminjaman:</label>
            <input type="date" name="tanggal_peminjaman" required>
            
            <label>Tanggal Pengembalian:</label>
            <input type="date" name="tanggal_pengembalian" required>
            
            <label>Mobil yang Disewa:</label>
            <input type="text" name="mobil" placeholder="Masukkan jenis mobil" required>
            
            <button type="submit">Tambah Penyewaan</button>
        </form>
        <a href="admin_dashboard.php">Kembali ke Dashboard</a>
    </div>
</body>
</html>
