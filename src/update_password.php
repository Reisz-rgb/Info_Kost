<?php
$token = $_POST['token'];
$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

include 'koneksi.php';
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek token valid
$stmt = $conn->prepare("SELECT email FROM reset_tokens WHERE token = ? AND expires_at > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $email = $result->fetch_assoc()['email'];

    // Update password user
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $new_password, $email);
    $stmt->execute();

    // Hapus token setelah digunakan
    $stmt = $conn->prepare("DELETE FROM reset_tokens WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();

    echo "Password berhasil diubah. <a href='login.php'>Login</a>";
} else {
    echo "Token tidak valid atau sudah kedaluwarsa.";
}
$conn->close();
?>
