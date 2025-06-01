<?php
include "koneksi.php";

$username = $_POST['username'];
$telepon  = $_POST['telepon'];
$alamat   = $_POST['alamat'];
$email    = $_POST['email'];
$password = $_POST['password'];
$role     = $_POST['role'];
$gender   = $_POST['gender'];

$hashed = password_hash($password, PASSWORD_DEFAULT);

// Handle Foto
$foto = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto = uniqid() . "." . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto);
}

// Cek username sudah ada?
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Username sudah digunakan.");
}
$stmt->close();

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO users (username, email, password, gender, role, telepon, alamat, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $username, $email, $hashed, $gender, $role, $telepon, $alamat, $foto);

if ($stmt->execute()) {
    header("Location: login_sebagai.php");
    exit;
} else {
    echo "Gagal registrasi: " . $stmt->error;
}

$stmt->close();
?>
