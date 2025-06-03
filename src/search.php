<?php
include 'koneksi.php';

$search     = $_GET['search'] ?? '';
$harga      = $_GET['harga'] ?? [];
$tipe       = $_GET['tipe'] ?? [];
$fasilitas  = $_GET['fasilitas'] ?? [];
$sort       = $_GET['sort'] ?? 'rating';

$query = "SELECT * FROM kost WHERE 1=1";
$params = [];
$types = "";

// ------------------
// Search by keyword
// ------------------
if (!empty($search)) {
    $query .= " AND (nama_kos LIKE ? OR alamat LIKE ? OR deskripsi LIKE ?)";
    $searchTerm = "%$search%";
    $params[] = &$searchTerm;
    $params[] = &$searchTerm;
    $params[] = &$searchTerm;
    $types .= "sss";
}

// ------------------
// Filter Harga
// ------------------
$hargaConditions = [];
foreach ($harga as $range) {
    switch ($range) {
        case '1':
            $hargaConditions[] = "harga < 500000";
            break;
        case '2':
            $hargaConditions[] = "harga BETWEEN 500000 AND 1000000";
            break;
        case '3':
            $hargaConditions[] = "harga BETWEEN 1000000 AND 2000000";
            break;
        case '4':
            $hargaConditions[] = "harga > 2000000";
            break;
    }
}
if (!empty($hargaConditions)) {
    $query .= " AND (" . implode(" OR ", $hargaConditions) . ")";
}

// ------------------
// Filter Tipe Kost
// ------------------
if (!empty($tipe)) {
    $placeholders = implode(',', array_fill(0, count($tipe), '?'));
    $query .= " AND tipe IN ($placeholders)";
    foreach ($tipe as $t) {
        $params[] = &$t;
        $types .= "s";
    }
}

// ------------------
// Filter Fasilitas
// ------------------
foreach ($fasilitas as $f) {
    $query .= " AND fasilitas LIKE ?";
    $likeF = "%$f%";
    $params[] = &$likeF;
    $types .= "s";
}

// ------------------
// Sorting
// ------------------
switch ($sort) {
    case 'termurah':
        $query .= " ORDER BY harga ASC";
        break;
    case 'termahal':
        $query .= " ORDER BY harga DESC";
        break;
    case 'rating':
        $query .= " ORDER BY rating DESC";
        break;
    case 'populer':
    default:
        $query .= " ORDER BY popularitas DESC";
        break;
}

// ------------------
// Eksekusi Query
// ------------------
$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$kost_list = [];
while ($row = $result->fetch_assoc()) {
    $kost_list[] = $row;
}
$jumlah_kost = count($kost_list);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - Kost Hero</title>
    <link href="./output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <header class="bg-[#063D18] text-white p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="assets/img/logo.png" alt="Logo" class="h-10 w-10">
            <h1 class="text-xl font-bold">Kost Hero</h1>
        </div>
        
        <!-- Search Bar -->
        <div class="hidden md:flex flex-1 max-w-md mx-8">
            <form method="GET" action="search.php" class="w-full">
                <div class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($search) ?>" 
                        placeholder="Cari kost berdasarkan nama, alamat, atau deskripsi..." 
                        class="w-full px-4 py-2 pl-10 pr-4 text-gray-800 rounded-lg bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#B33328] focus:border-[#B33328] transition-colors"
                    >
                    <img src="assets/img/icons/cari.png" alt="Cari" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400">
                </div>
            </form>
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
    
    <!-- Mobile Search Bar -->
    <div class="md:hidden bg-white p-4 shadow-sm ">
        <form method="GET" action="search.php">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="<?= htmlspecialchars($search) ?>" 
                    placeholder="Cari kost..." 
                    class="w-full px-4 py-2 pl-10 pr-4 text-gray-800 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#B33328] focus:border-[#B33328] transition-colors"
                >
                <img src="assets/img/icons/cari.png" alt="Cari" class="h-5 w-5 text-gray-400">
            </div>
        </form>
    </div>
    
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
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
           <!-- Filter Sidebar -->
<div class="lg:w-1/4">
    <form method="GET" action="search.php" class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
        <h3 class="text-lg font-bold mb-4">Filter Pencarian</h3>

        <!-- Price Range -->
        <div class="mb-6">
            <h4 class="font-semibold mb-3">Rentang Harga</h4>
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="checkbox" name="harga[]" value="1" class="mr-2"> &lt; Rp 500.000
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="harga[]" value="2" class="mr-2"> Rp 500.000 - Rp 1.000.000
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="harga[]" value="3" class="mr-2"> Rp 1.000.000 - Rp 2.000.000
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="harga[]" value="4" class="mr-2"> &gt; Rp 2.000.000
                </label>
            </div>
        </div>

        <!-- Type -->
        <div class="mb-6">
            <h4 class="font-semibold mb-3">Tipe Kost</h4>
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="checkbox" name="tipe[]" value="Putra" class="mr-2"> Putra
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="tipe[]" value="Putri" class="mr-2"> Putri
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="tipe[]" value="Campur" class="mr-2"> Campur
                </label>
            </div>
        </div>

        <!-- Facilities -->
        <div class="mb-6">
            <h4 class="font-semibold mb-3">Fasilitas</h4>
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="checkbox" name="fasilitas[]" value="WiFi" class="mr-2"> WiFi
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="fasilitas[]" value="AC" class="mr-2"> AC
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="fasilitas[]" value="Kamar Mandi Dalam" class="mr-2"> Kamar Mandi Dalam
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="fasilitas[]" value="Parkir" class="mr-2"> Parkir
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="fasilitas[]" value="Dapur" class="mr-2"> Dapur
                </label>
            </div>
        </div>

        <button type="submit" class="w-full bg-[#12506B] hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-semibold">
            Terapkan Filter
        </button>
    </form>
</div>

<!-- Results -->
<div class="lg:w-3/4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Ditemukan <?= $jumlah_kost ?> kost</h2>
        <form method="GET" action="search.php">
            <input type="hidden" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
            <select name="sort" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-3 py-2">
                <option value="populer" <?= ($_GET['sort'] ?? '') === 'populer' ? 'selected' : '' ?>>Urutkan: Terpopuler</option>
                <option value="termurah" <?= ($_GET['sort'] ?? '') === 'termurah' ? 'selected' : '' ?>>Harga Terendah</option>
                <option value="termahal" <?= ($_GET['sort'] ?? '') === 'termahal' ? 'selected' : '' ?>>Harga Tertinggi</option>
                <option value="rating" <?= ($_GET['sort'] ?? '') === 'rating' ? 'selected' : '' ?>>Rating Tertinggi</option>
            </select>
        </form>
    </div>


                <!-- Kost Cards Grid -->
                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
    <?php if (count($kost_list) > 0): ?>
        <?php foreach ($kost_list as $kost): ?>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:-translate-y-2 transition-transform duration-300">
            <div class="relative">
                <img src="<?= htmlspecialchars($kost['gambar'] ?? 'https://via.placeholder.com/300x200') ?>" alt="Kost" class="w-full h-48 object-cover">
            </div>
            <div class="p-4">
            <div class="p-4 cursor-pointer" onclick="window.location.href='display_produk.php?id=<?= $kost['id']; ?>'">
    <h3 class="font-bold text-lg mb-2"><?= htmlspecialchars($kost['nama_kos']) ?></h3>
                <p class="text-gray-600 text-sm mb-2">
                    <i class="fas fa-map-marker-alt mr-1"></i><?= htmlspecialchars($kost['alamat']) ?>
                </p>
                <div class="flex items-center justify-between">
                    <span class="bg-gradient-to-r from-[#12506B] to-blue-800 text-white px-3 py-1 rounded-full text-sm font-bold">
                        Rp <?= number_format($kost['harga'], 0, ',', '.') ?>/bulan
                    </span>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-200 text-xs text-gray-600">
                    <?= htmlspecialchars(substr($kost['deskripsi'], 0, 100)) ?>...
                </div>
        </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-gray-600">Tidak ada kost yang ditemukan untuk pencarian.</p>
    <?php endif; ?>
</div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <nav class="flex space-x-2">
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded-lg">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 bg-[#12506B] text-white rounded-lg">1</button>
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300">2</button>
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-300">3</button>
                        <button class="px-3 py-2 bg-gray-200 text-gray-600 rounded-lg">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Kost Hero. All rights reserved.</p>
        </div>
    </footer> 
</body>
</html></nav></p></div></p></div>