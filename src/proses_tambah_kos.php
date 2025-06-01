<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_sebagai.php");
    exit;
}

// Ambil data dari form
$nama_kos = $_POST['nama_kos'];
$alamat = $_POST['alamat'];
$deskripsi = $_POST['deskripsi'];
$sisa = $_POST['sisa_kamar'];
$harga = $_POST['harga'];

$fasilitas_kamar = isset($_POST['fasilitas_kamar']) ? implode(", ", $_POST['fasilitas_kamar']) : '';
$fasilitas_umum = isset($_POST['fasilitas_umum']) ? implode(", ", $_POST['fasilitas_umum']) : '';

// Proses upload gambar
$upload_dir = "uploads/";
$gambar_paths = [];

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

foreach ($_FILES['gambar']['tmp_name'] as $key => $tmp_name) {
    if ($_FILES['gambar']['error'][$key] === UPLOAD_ERR_OK) {
        $file_name = basename($_FILES['gambar']['name'][$key]);
        $target_path = $upload_dir . time() . "_" . $file_name;

        if (move_uploaded_file($tmp_name, $target_path)) {
            $gambar_paths[] = $target_path;
        }
    }
}

$gambar_joined = !empty($gambar_paths) ? implode(",", $gambar_paths) : '';

// Simpan ke database
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO kost (nama_kos, alamat, harga, deskripsi, gambar, user_id, sisa_kamar, fasilitas_kamar, fasilitas_umum) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param(
    "ssdssiiss",
    $nama_kos, $alamat, $harga, $deskripsi, $gambar_joined, 
    $user_id, $sisa, $fasilitas_kamar, $fasilitas_umum
);

if ($stmt->execute()) {
    echo "<script>alert('Data kost berhasil ditambahkan');window.location.href='edit_properti_owner.php';</script>";
} else {
    echo "Gagal menambahkan data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>