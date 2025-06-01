<?php
session_start();
include "koneksi.php";

// Cek apakah user pencari
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'pencari') {
    header("Location: login_pencari.php");
    exit;
}

$username = $_SESSION['username'];
$data = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
$user = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="./output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg- text-gray-400">
    <header class="bg-[#063D18] text-white p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="assets/img/logo.png" alt="Logo" class="h-10 w-10">
            <h1 class="text-xl font-bold">Kost Hero</h1>
        </div>
        <div class="hidden md:flex items-center space-x-4">
            <ul class="flex space-x-4 list-none">
                <li class="p-4 hover:bg-gray-200"><a href="index.php">Home</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="#">Riwayat Transaksi</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="log out.php">Log Out</a></li>
            </ul>
        </div>

        <button id="toggleNav" class="block md:hidden mr-6">
            <img id="menuIcon" src="assets/img/icons/menu.png" alt="Menu" class="w-6 h-6 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </button>        
    </header>

    <div id="mobileNav" class="fixed left-[-100%] h-full top-0 w-[60%] bg-[#12506B] transition-all duration-500">
        <h1 class="text-3xl text-gray-400 m-4">Kost Hero</h1>
        <ul class="p-8 text-2xl">
            <li class="p-4 hover:bg-[#B33328]"><a href="Index.php">Home</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="riwayat_transaksi_owner.php">Riwayat Transaksi</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="log out.php">Log Out</a></li>
        </ul>
    </div>
    

    <script src="js/owner.js"></script>
</body>
</html>

