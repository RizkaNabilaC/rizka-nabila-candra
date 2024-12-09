<?php 
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "nama_database"); // Ganti "nama_database" sesuai dengan nama database Anda
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses hapus data jika ada permintaan
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Mengambil ID dari URL
    $query = "DELETE FROM penyewaan WHERE id = $id"; // Query untuk menghapus data
    mysqli_query($conn, $query); // Eksekusi query
    header("Location: hapus_penyewaan.php"); // Redirect untuk mencegah refresh menyebabkan penghapusan ulang
    exit();
}

// Ambil semua data penyewaan
$query = "SELECT * FROM penyewaan";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Penyewaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .table-container {
            background: #fff;
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .btn-hapus {
            background-color: #FF0000;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-hapus:hover {
            background-color: #CC0000;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #007BFF;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2>Data Penyewaan</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Mobil</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_peminjaman']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal_pengembalian']); ?></td>
                    <td><?php echo htmlspecialchars($row['mobil']); ?></td>
                    <td>
                        <a href="hapus_penyewaan.php?id=<?php echo $row['id']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="back-link">
            <a href="admin_dashboard.php">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
