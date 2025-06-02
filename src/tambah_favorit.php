<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login_sebagai.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$kost_id = $_POST['kost_id'];

// Cek apakah sudah difavoritkan
$cek = $conn->prepare("SELECT * FROM favorit WHERE user_id = ? AND kost_id = ?");
$cek->bind_param("ii", $user_id, $kost_id);
$cek->execute();
$result = $cek->get_result();

if ($result->num_rows === 0) {
    $stmt = $conn->prepare("INSERT INTO favorit (user_id, kost_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $kost_id);
    $stmt->execute();
}

header("Location: hal_favorit.php");
exit;
?>
