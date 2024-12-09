<?php
// Konfigurasi database
$host = 'localhost';        // Nama host, biasanya 'localhost'
$user = 'root';             // Username database
$password = '';             // Password database (kosong jika default di XAMPP)
$dbname = 'pt_bendicar';   // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
