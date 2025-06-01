<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['user_id'] ?? 0;
$id = intval($_GET['id'] ?? 0);

// Pastikan kos milik user ini
$result = mysqli_query($conn, "SELECT * FROM kost WHERE id = $id AND user_id = $user_id");
$kost = mysqli_fetch_assoc($result);
if (!$kost) {
    die("Akses ditolak atau kos tidak ditemukan.");
}


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data kost untuk menghapus gambar dari server
    $get = mysqli_query($conn, "SELECT gambar FROM kost WHERE id = $id");
    if ($row = mysqli_fetch_assoc($get)) {
        $gambar_array = explode(',', $row['gambar']);
        foreach ($gambar_array as $gambar) {
            if (file_exists($gambar)) {
                unlink($gambar); // Hapus file gambar dari server
            }
        }
    }

    // Hapus data dari database
    $delete = mysqli_query($conn, "DELETE FROM kost WHERE id = $id");

    if ($delete) {
        echo "<script>alert('Kost berhasil dihapus.');window.location.href='edit_properti_owner.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus kost.');window.location.href='edit_properti_owner.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan.');window.location.href='edit_properti_owner.php';</script>";
}
?>
