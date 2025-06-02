<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login_sebagai.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$kost_id = $_POST['kost_id'];

$stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = ? AND kost_id = ?");
$stmt->bind_param("ii", $user_id, $kost_id);
$stmt->execute();

header("Location: hal_favorit.php");
exit;
?>
