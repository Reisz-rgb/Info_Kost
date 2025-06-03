<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['user_id'];

// Query dasar
$query = "SELECT s.*, k.nama_kos AS nama_kost, k.alamat, k.harga, k.gambar 
          FROM sewa s
          JOIN kost k ON s.kost_id = k.id
          WHERE s.user_id = ?";

// Tambahkan kondisi filter status
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $query .= " AND s.status = ?";
}

// Tambahkan kondisi filter periode
if (isset($_GET['periode']) && !empty($_GET['periode'])) {
    $query .= " AND s.created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)";
}

$query .= " ORDER BY s.created_at DESC";

// Prepare statement
$stmt = $conn->prepare($query);

// Bind parameter berdasarkan filter yang aktif
if (isset($_GET['status']) && !empty($_GET['status']) && isset($_GET['periode']) && !empty($_GET['periode'])) {
    $stmt->bind_param("isi", $id_user, $_GET['status'], $_GET['periode']);
} elseif (isset($_GET['status']) && !empty($_GET['status'])) {
    $stmt->bind_param("is", $id_user, $_GET['status']);
} elseif (isset($_GET['periode']) && !empty($_GET['periode'])) {
    $stmt->bind_param("ii", $id_user, $_GET['periode']);
} else {
    $stmt->bind_param("i", $id_user);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan - Kost Hero</title>
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
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

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
<!-- Filter Section -->
<form method="GET" action="" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Pemesanan</label>
            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="Menunggu Pembayaran" <?= isset($_GET['status']) && $_GET['status'] == 'Menunggu Pembayaran' ? 'selected' : '' ?>>Menunggu Pembayaran</option>
                <option value="Selesai" <?= isset($_GET['status']) && $_GET['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                <option value="Dibatalkan" <?= isset($_GET['status']) && $_GET['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
            </select>
        </div>
        <div class="flex-1">
            <label for="periode" class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
            <select name="periode" id="periode" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Semua Waktu</option>
                <option value="30" <?= isset($_GET['periode']) && $_GET['periode'] == '30' ? 'selected' : '' ?>>30 Hari Terakhir</option>
                <option value="90" <?= isset($_GET['periode']) && $_GET['periode'] == '90' ? 'selected' : '' ?>>3 Bulan Terakhir</option>
                <option value="180" <?= isset($_GET['periode']) && $_GET['periode'] == '180' ? 'selected' : '' ?>>6 Bulan Terakhir</option>
                <option value="365" <?= isset($_GET['periode']) && $_GET['periode'] == '365' ? 'selected' : '' ?>>1 Tahun Terakhir</option>
            </select>
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" name="filter" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
            <?php if(isset($_GET['filter'])): ?>
                <a href="rt_pencari.php" class="text-gray-600 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition-colors">
                    Reset
                </a>
            <?php endif; ?>
        </div>
    </div>
</form>

<div class="mb-4 text-gray-600">
    <?php 
    $total_rows = $result->num_rows;
    echo "Menampilkan $total_rows riwayat";
    
    if (isset($_GET['status']) && !empty($_GET['status'])) {
        echo " dengan status " . htmlspecialchars($_GET['status']);
    }
    
    if (isset($_GET['periode']) && !empty($_GET['periode'])) {
        echo " dalam " . htmlspecialchars($_GET['periode']) . " hari terakhir";
    }
    ?>
</div>

        <!-- Booking History Cards -->
        <div class="space-y-6">
            <!-- Booking History Cards -->
<div class="space-y-6">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): 
            // Hitung tanggal berakhir
            $checkin = new DateTime($row['checkin']);
            $checkout = clone $checkin;
            $checkout->add(new DateInterval('P'.$row['durasi'].'M'));
        ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col md:flex-row justify-between gap-4">
                    <div class="flex gap-4">
                        <img src="<?= explode(',', $row['gambar'])[0] ?>" 
                             alt="<?= $row['nama_kost'] ?>" 
                             class="w-24 h-24 object-cover rounded-lg">
                        <div>
                            <h3 class="text-xl font-semibold"><?= $row['nama_kost'] ?></h3>
                            <p class="text-gray-600 mb-2"><?= $row['alamat'] ?></p>
                            <span class="text-sm text-white px-2 py-1 rounded 
                                <?= match($row['status']) {
                                    'Menunggu Pembayaran' => 'bg-yellow-500',
                                    'Selesai' => 'bg-green-500',
                                    'Dibatalkan' => 'bg-red-500',
                                    default => 'bg-gray-500'
                                } ?>">
                                <?= $row['status'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="md:text-right">
                        <p class="text-gray-500">Check-in: <?= $checkin->format('d M Y') ?></p>
                        <p class="text-gray-500">Check-out: <?= $checkout->format('d M Y') ?></p>
                        <p class="text-lg font-bold text-blue-600 mt-2">
                            Rp <?= number_format($row['harga'] * $row['durasi'], 0, ',', '.') ?>
                        </p>
                    </div>
                </div>
                

            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Riwayat Pemesanan</h3>
            <p class="text-gray-500 mb-6">Mulai cari kost impian Anda sekarang!</p>
            <a href="cari_kost.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-search mr-2"></i>Cari Kost
            </a>
        </div>
    <?php endif; ?>
</div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h4 class="text-xl font-bold mb-2">Kost Hero</h4>
                <p class="text-gray-400">Platform terpercaya untuk menemukan kost terbaik</p>
            </div>
        </div>
    </footer>

<script src=""></script>
</body>
</html>