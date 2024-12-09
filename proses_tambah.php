<?php
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include('config.php');

// Mengecek apakah data telah dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $id_penyewaan = intval($_POST['id_penyewaan']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $tanggal_peminjaman = mysqli_real_escape_string($conn, $_POST['tanggal_peminjaman']);
    $tanggal_pengembalian = mysqli_real_escape_string($conn, $_POST['tanggal_pengembalian']);
    $mobil = mysqli_real_escape_string($conn, $_POST['mobil']);

    // Validasi data (opsional)
    if (empty($id_penyewaan) || empty($nama) || empty($tanggal_peminjaman) || empty($tanggal_pengembalian) || empty($mobil)) {
        echo "Semua data harus diisi.";
        exit();
    }

    // Query untuk menambahkan data ke tabel penyewaan
    $sql = "INSERT INTO penyewaan (id_penyewaan, nama, tanggal_peminjaman, tanggal_pengembalian, mobil) 
            VALUES ('$id_penyewaan', '$nama', '$tanggal_peminjaman', '$tanggal_pengembalian', '$mobil')";

    if (mysqli_query($conn, $sql)) {
        // Berhasil menambahkan, kembali ke halaman penyewaan
        header("Location: penyewaan.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Metode request tidak valid.";
}
?>
