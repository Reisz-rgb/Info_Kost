<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_sebagai.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT kost.* FROM favorites 
        JOIN kost ON favorites.kost_id = kost.id 
        WHERE favorites.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$fav_result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit - Kost Hero</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-[#063D18] text-white p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="assets/img/logo.png" alt="Logo" class="h-10 w-10">
            <h1 class="text-xl font-bold">Kost Hero</h1>
        </div>
        <div class="hidden md:flex items-center space-x-4">
            <ul class="flex space-x-4 list-none">
                <li class="px-4 py-2 rounded-md transition-colors duration-200 hover:bg-white/10 hover:text-gray-100"><a href="index.php" class="block w-full">Home</a></li>
                <li class="px-4 py-2 rounded-md transition-colors duration-200 hover:bg-white/10 hover:text-gray-100"><a href="hal_favorit.php" class="block w-full">Favorit</a></li>
                <li class="px-4 py-2 rounded-md transition-colors duration-200 hover:bg-white/10 hover:text-gray-100"><a href="rt_pencari.php" class="block w-full">Riwayat Transaksi</a></li>
                <li class="px-4 py-2 rounded-md transition-colors duration-200 hover:bg-white/10 hover:text-gray-100"><a href="edit_akun.php" class="block w-full">Edit Akun</a></li>
                <li class="px-4 py-2 rounded-md transition-colors duration-200 hover:bg-white/10 hover:text-gray-100"><a href="log out.php" class="block w-full">Log Out</a></li>
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
            <li class="p-4 hover:bg-[#B33328]"><a href="hal_favorit.php">Kos Favorit</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="riwayat_transaksi_owner.php">Riwayat Transaksi</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="edit_akun.php">Edit Akun</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="log out.php">Log Out</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Kost Favorit Saya</h2>
        </div>

        <!-- Favorites Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <?php if ($fav_result->num_rows > 0): ?>
        <?php while ($kost = $fav_result->fetch_assoc()): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden w-full">
            <div class="relative">
            <img src="<?php echo explode(",", $kost['gambar'])[0]; ?>" alt="Kost" class="w-full h-48 object-cover">
            <form method="POST" action="hapus_favorit.php" class="absolute top-2 right-2">
            <input type="hidden" name="kost_id" value="<?php echo $kost['id']; ?>">
            <button type="submit" class="p-1.5 bg-white rounded-full shadow-md hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 text-red-600 fill-current" viewBox="0 0 20 20">
            <path d="M10 18.35l-1.45-1.32C5.4 14.25 2 11.39 2 8.5
            2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87
            C11.46 5.99 12.96 5 14.5 5
            16.5 5 18 6.5 18 8.5c0 2.89-3.4 5.75-6.55 8.53L10 18.35z"/>
            </svg>
            </button>
            </form>
            </div>
            <div class="p-4">
            <h3 class="font-semibold text-lg text-gray-900 mb-2"><?php echo $kost['nama_kos']; ?></h3>
            <p class="text-gray-600 text-sm mb-2"><?php echo $kost['alamat']; ?></p>
            <div class="flex justify-between items-center">
                <span class="text-xl font-bold text-[#063D18]">Rp <?php echo number_format($kost['harga'], 0, ',', '.'); ?></span>
                <span class="text-sm text-gray-500">/bulan</span>
            </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <div class="col-span-full text-center py-12">
        <h3 class="text-lg font-medium text-gray-900">Belum ada favorit</h3>
        <p class="text-sm text-gray-500">Ayo mulai menambahkan kost favorit Anda.</p>
        <div class="mt-4">
            <a href="index.php" class="bg-[#12506B] text-white px-4 py-2 rounded">Jelajahi Kost</a>
        </div>
    </div>
<?php endif; ?>

    </main>
    <script src="js/pencari.js"></script>
</body>
</html></svg>