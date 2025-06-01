<?php
session_start();
include "koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['foto'] = $user['foto'];

        if ($user['role'] == 'pencari') {
            header("Location:index.php");
        } else {
            header("Location:index.php");
        }
        exit;
    } else {
        echo "Password salah!";
    }
} else {
    echo "User tidak ditemukan!";
}
?>
