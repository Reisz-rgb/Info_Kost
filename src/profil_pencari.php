<?php
include 'koneksi.php';
session_start();
// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login_sebagai.php");
    exit;
}

$username = mysqli_real_escape_string($conn, $_SESSION['username']);

// Jalankan query
$query = "SELECT username, email, gender, role, telepon, alamat, foto FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Ambil data user
$users = mysqli_fetch_assoc($result);
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
                <li class="p-4 hover:bg-gray-200"><a href="hal_favorit.php">Favorit</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="rt_pencari.php">Riwayat Transaksi</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="edit_akun.php">Edit Akun</a></li>
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
            <li class="p-4 hover:bg-[#B33328]"><a href="profil_pemilik.php">Home</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="hal_favorit.php">Favorit</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="riwayat_transaksi_owner.php">Riwayat Transaksi</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="edit_akun.php">Edit Akun</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="log out.php">Log Out</a></li>
        </ul>
    </div>
    
<main class="p-6 max-w-4xl mx-auto mt-10 bg-white rounded-xl shadow-md text-gray-800">
    <h2 class="text-2xl font-semibold mb-6">Informasi users</h2>
    <div class="flex flex-col md:flex-row items-center space-x-0 md:space-x-8 space-y-4 md:space-y-0">
       <img src="<?= !empty($users['foto']) ? 'uploads/' . htmlspecialchars($users['foto']) : 'src/assets/img/default_profile_pic/default.jpeg'; ?>" 
     alt="Foto Profil" 
     class="w-32 h-32 rounded-full object-cover border-2 border-gray-300">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
            <div>
                <p><span class="font-semibold">Username:</span> <?= htmlspecialchars($users['username']); ?></p>
                <p><span class="font-semibold">Email:</span> <?= htmlspecialchars($users['email']); ?></p>
                <p><span class="font-semibold">Gender:</span> <?= htmlspecialchars($users['gender']); ?></p>
                <p><span class="font-semibold">Role:</span> <?= htmlspecialchars($users['role']); ?></p>
            </div>
            <div>
                <p><span class="font-semibold">Telepon:</span> <?= htmlspecialchars($users['telepon']); ?></p>
                <p><span class="font-semibold">Alamat:</span> <?= htmlspecialchars($users['alamat']); ?></p>
            </div>
        </div>
    </div>
</main>

    <script src="js/owner.js"></script>
</body>
</html>