<?php
include 'koneksi.php';
$kost_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$result = $conn->query("SELECT * FROM kost WHERE id = $kost_id");
$kost = $result->fetch_assoc();

// Proses gambar jadi array
$gambar_array = explode(",", $kost['gambar']);
$fasilitas_kamar = explode(", ", $kost['fasilitas_kamar']);
$fasilitas_umum = explode(", ", $kost['fasilitas_umum']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title><?php echo htmlspecialchars($kost['nama_kos']); ?></title>
</head>
<body class="bg-gray-50">

    <!-- Header Section -->
    <div class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center">
            <button onclick="history.back()" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>
            <h1 class="text-xl font-semibold text-gray-800">Detail Kos</h1>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-6">
        <!-- Main Content -->
        <div class="grid lg:grid-cols-3 gap-8">
            
        <!-- Left Column - Images and Details -->
        <div class="lg:col-span-2">
            <!-- Image Gallery -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                <div class="relative">
                    <img src="<?php echo $gambar_array[0]; ?>" alt="Gambar utama" class="w-full h-90 object-cover">
                    <div class="absolute bottom-4 right-4 bg-black bg-opacity-60 text-white px-3 py-1 rounded-full text-sm">
                        1 / <?php echo count($gambar_array); ?>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-2 p-4">
                    <?php foreach ($gambar_array as $gambar): ?>
                        <img src="<?php echo $gambar; ?>" alt="Gambar" class="w-full h-40 object-cover rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl">
                    <?php endforeach; ?>
                </div>
            </div>
            
            <form method="get" action="tambah_favorit.php" class="absolute top-3 right-3">
    <input type="hidden" name="action" value="<?php echo $is_favorit ? 'remove' : 'add'; ?>">
    <input type="hidden" name="kost_id" value="<?php echo $kost['id']; ?>">
    <button type="submit" class="p-2 bg-white rounded-full shadow hover:bg-gray-100">
        <svg class="w-5 h-5 <?php echo $is_favorit ? 'text-red-500' : 'text-gray-400'; ?> fill-current" viewBox="0 0 20 20">
            <path d="M10 18.35l-1.45-1.32C5.4 14.25 2 11.39 2 8.5 2 6.5 3.5 5 5.5 5
                    c1.54 0 3.04.99 3.57 2.36h1.87C11.46 5.99 12.96 5 14.5 5
                    C16.5 5 18 6.5 18 8.5c0 2.89-3.4 5.75-6.55 8.53L10 18.35z"/>
        </svg>
    </button>
</form>

            <!-- Kos Information -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2"><?php echo htmlspecialchars($kost['nama_kos']); ?></h1>
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span><?php echo htmlspecialchars($kost['alamat']); ?></span>
                        </div>
                        <div class="flex items-center">
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-medium">
                                Tersisa <?php echo $kost['sisa_kamar']; ?> kamar
                            </span>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <h3 class="font-semibold text-gray-900 mb-3">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        <?php echo nl2br(htmlspecialchars($kost['deskripsi'])); ?>
                    </p>
                </div>
            </div>

            <!-- Facilities -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Fasilitas Kamar</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <?php foreach ($fasilitas_kamar as $f): ?>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                            <span><?php echo htmlspecialchars($f); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Fasilitas Umum</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <?php foreach ($fasilitas_umum as $f): ?>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span><?php echo htmlspecialchars($f); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right Column - Booking Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
                <div class="mb-6">
                    <div class="flex items-baseline justify-between mb-2">
                        <span class="text-3xl font-bold text-gray-900">Rp <?php echo number_format($kost['harga'], 0, ',', '.'); ?></span>
                        <span class="text-gray-500">/Bulan</span>
                    </div>
                    <p class="text-sm text-gray-600">Bulan pertama</p>
                </div>

                <div class="space-y-4 mb-6">
                    <div class="border rounded-lg p-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                        <input type="date" class="w-full border-0 focus:ring-0 text-gray-900">
                    </div>
                    <div class="border rounded-lg p-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Durasi Sewa</label>
                        <select class="w-full border-0 focus:ring-0 text-gray-900">
                            <option>1 Bulan</option>
                            <option>3 Bulan</option>
                            <option>6 Bulan</option>
                            <option>12 Bulan</option>
                        </select>
                    </div>
                </div>

                <button class="w-full bg-[#12506B] hover:bg-[#620F08] text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Ajukan Sewa
                </button>
            </div>
        </div>
        
        </div>
    </div>
    <script src="js/pencarian.js"></script>
</body>
</html>
