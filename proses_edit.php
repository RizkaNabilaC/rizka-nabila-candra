<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include('config.php');

// Memeriksa apakah data sudah dikirimkan melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_penyewaan = intval($_POST['id_penyewaan']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $tanggal_peminjaman = mysqli_real_escape_string($conn, $_POST['tanggal_peminjaman']);
    $tanggal_pengembalian = mysqli_real_escape_string($conn, $_POST['tanggal_pengembalian']);
    $mobil = mysqli_real_escape_string($conn, $_POST['mobil']);

    // Query untuk memperbarui data
    $update_sql = "UPDATE penyewaan 
                   SET nama = '$nama', 
                       tanggal_peminjaman = '$tanggal_peminjaman',
                       tanggal_pengembalian = '$tanggal_pengembalian',
                       mobil = '$mobil'
                   WHERE id_penyewaan = $id_penyewaan";

    if (mysqli_query($conn, $update_sql)) {
        // Redirect ke halaman utama setelah berhasil
        header("Location: penyewaan.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
} else {
    echo "Metode tidak valid.";
}
?>
