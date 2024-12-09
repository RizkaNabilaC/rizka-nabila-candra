<?php
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Koneksi ke database
include('config.php');

// Query untuk mengambil data penyewaan
$sql = "SELECT id_penyewaan, nama, telepon, tanggal_peminjaman, tanggal_pengembalian, 
               mobil, DATEDIFF(tanggal_pengembalian, tanggal_peminjaman) AS durasi
        FROM penyewaan";
$result = mysqli_query($conn, $sql);

// Menangani aksi hapus
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete_sql = "DELETE FROM penyewaan WHERE id_penyewaan = $id";
    if (mysqli_query($conn, $delete_sql)) {
        header("Location: penyewaan.php");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penyewaan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #cce5ff;
        }

        .actions a {
            padding: 8px 12px;
            margin: 0 5px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .actions a:hover {
            background-color: #0056b3;
        }

        .add-button {
            margin: 20px 0;
            text-align: center;
        }

        .add-button a {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Selamat datang di PT. BendiCar, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <a href="logout.php">Logout</a>
    <div class="add-button">
        <a href="tambah_penyewaan.php">Tambah Penyewaan</a>
    </div>

    <table>
        <tr>
            <th>ID Penyewaan</th>
            <th>Nama Penyewa</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Pengembalian</th>
            <th>Mobil</th>
            <th>Durasi (hari)</th>
            <th>Aksi</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id_penyewaan']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['telepon']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal_peminjaman']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal_pengembalian']) . "</td>";
                echo "<td>" . htmlspecialchars($row['mobil']) . "</td>";
                echo "<td>" . htmlspecialchars($row['durasi']) . "</td>";
                echo "<td class='actions'>
                        <a href='edit_penyewaan.php?id=" . htmlspecialchars($row['id_penyewaan']) . "'>Edit</a>
                        <a href='penyewaan.php?action=delete&id=" . htmlspecialchars($row['id_penyewaan']) . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Tidak ada data penyewaan</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
