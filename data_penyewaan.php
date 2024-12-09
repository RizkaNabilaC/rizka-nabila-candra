<?php
session_start();

// Pastikan pengguna telah login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
include('user_dashboard.php'); // Koneksi database
// Koneksi ke database
$host = "localhost"; // Ganti dengan host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "pt_bendicar"; // Ganti dengan nama database Anda

$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi database
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Ambil data penyewaan dari database
$sql = "SELECT id_penyewaan, nama, tanggal_peminjaman, tanggal_pengembalian FROM penyewaan";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyewaan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            margin-right: 10px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
    <h3>Data Penyewaan</h3>

    <!-- Tombol untuk Tambah Penyewaan -->
    <div style="margin-bottom: 20px;">
        <a href="tambah_penyewaan.php">Tambah Penyewaan</a>
        <a href="logout.php">Logout</a>
    </div>
    <div style="margin-bottom: 20px;">
    <a href="tambah_penyewaan.php">Tambah Penyewaan</a>
</div>

    <!-- Tabel Data Penyewaan -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Penyewa</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id_penyewaan'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['tanggal_peminjaman'] . "</td>";
                echo "<td>" . $row['tanggal_pengembalian'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Belum ada data penyewaan.</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>
