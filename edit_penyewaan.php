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
    <title>Edit Penyewaan</title>
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
    <h1>Edit Penyewaan</h1>
    <form method="POST" action="proses_edit.php">
        <label>ID Penyewaan:</label>
        <input type="text" name="id_penyewaan" required><br>
        
        <label>Nama Penyewa:</label>
        <input type="text" name="nama" required><br>
        
        <label>Tanggal Peminjaman:</label>
        <input type="date" name="tanggal_peminjaman" required><br>
        
        <label>Tanggal Pengembalian:</label>
        <input type="date" name="tanggal_pengembalian" required><br>
        
        <label>Mobil yang Disewa:</label>
        <input type="text" name="mobil" required><br>
        
        <button type="submit">Edit</button>
    </form>
</body>
</html>
