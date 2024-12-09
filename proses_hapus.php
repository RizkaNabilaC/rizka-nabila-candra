<?php
session_start();

// Periksa apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: unauthorized.php");
    exit();
}

// Periksa apakah data ID Penyewaan dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sambungkan ke database
    $servername = "localhost"; // Ganti dengan nama server Anda
    $username = "root";        // Ganti dengan username database Anda
    $password = "";            // Ganti dengan password database Anda
    $dbname = "rental_mobil";  // Ganti dengan nama database Anda

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil ID Penyewaan dari form
    $id_penyewaan = $conn->real_escape_string($_POST['id_penyewaan']);

    // Periksa apakah ID Penyewaan ada di database
    $check_query = "SELECT * FROM penyewaan WHERE id_penyewaan = '$id_penyewaan'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Hapus data dari tabel penyewaan
        $delete_query = "DELETE FROM penyewaan WHERE id_penyewaan = '$id_penyewaan'";
        
        if ($conn->query($delete_query) === TRUE) {
            echo "<script>
                alert('Data berhasil dihapus.');
                window.location.href = 'admin_dashboard.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus data: " . $conn->error . "');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('ID Penyewaan tidak ditemukan.');
            window.history.back();
        </script>";
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika metode bukan POST, kembalikan ke halaman sebelumnya
    header("Location: admin_dashboard.php");
    exit();
}
?>
