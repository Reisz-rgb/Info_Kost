<?php
include 'koneksi.php';
session_start(); // pastikan session dimulai di sini juga
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM kost WHERE user_id = $user_id ORDER BY created_at DESC";
$kostList = mysqli_query($conn, $query);
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
<body class="bg-text-gray-400 bg-gray-50">
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
                <li class="px-4 py-2 rounded-md transition-colors duration-200 hover:bg-white/10 hover:text-gray-100"><a href="riwayat_transaksi_owner.php" class="block w-full">Riwayat Transaksi</a></li>
                <li class="px-4 py-2 rounded-md transition-colors duration-200 hover:bg-white/10 hover:text-gray-100"><a href="edit_properti_owner.php" class="block w-full">Manajemen Kost</a></li>
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
            <li class="p-4 hover:bg-[#B33328]"><a href="edit_properti_owner.php">Manajemen Kost</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="edit_akun.php">Edit Akun</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="log out.php">Log Out</a></li>
        </ul>
    </div>


<main class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-8">
    <!-- Form Tambah Kos -->
    <div class="max-w-4xl mx-auto px-4 mb-12">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Header Form -->
            <div class="bg-gradient-to-r from-[#063D18] to-[#12506B] px-8 py-6">
                <h2 class="text-3xl font-bold text-white flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Data Kos Baru
                </h2>
                <div class="container mx-auto px-4">
                    <p class="text-green-100 mt-2 text-lg font-semibold">Lengkapi informasi kos untuk menarik lebih banyak penyewa</p>
                </div>
            </div>
            
            <!-- Form Body -->
            <div class="p-8">
                <form action="proses_tambah_kos.php" method="POST" enctype="multipart/form-data" class="space-y-8">
                    <!-- Row 1: Nama dan Alamat -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="flex text-gray-700 font-semibold mb-2 items-center">
                                <svg class="w-5 h-5 mr-2 text-[#12506B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Nama Kos
                            </label>
                            <input type="text" name="nama_kos" required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#12506B] focus:ring-2 focus:ring-[#12506B]/20 transition-all duration-200"
                                placeholder="Masukkan nama kos...">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#12506B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Alamat
                            </label>
                            <input type="text" name="alamat" required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#12506B] focus:ring-2 focus:ring-[#12506B]/20 transition-all duration-200"
                                placeholder="Alamat lengkap kos...">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#12506B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" rows="4" required 
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#12506B] focus:ring-2 focus:ring-[#12506B]/20 transition-all duration-200"
                            placeholder="Deskripsikan kos Anda secara detail..."></textarea>
                    </div>

                    <!-- Row 2: Kamar, Tipe, Harga -->
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#12506B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                Sisa Kamar
                            </label>
                            <input type="number" name="sisa_kamar" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#12506B] focus:ring-2 focus:ring-[#12506B]/20 transition-all duration-200"
                                placeholder="0">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#12506B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Tipe
                            </label>
                            <select name="tipe" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#12506B] focus:ring-2 focus:ring-[#12506B]/20 transition-all duration-200">
                                <option value="Putra">Putra</option>
                                <option value="Putri">Putri</option>
                                <option value="Campur">Campur</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-[#12506B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Harga per Bulan
                            </label>
                            <input type="number" name="harga" required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#12506B] focus:ring-2 focus:ring-[#12506B]/20 transition-all duration-200"
                                placeholder="Rp">
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Fasilitas Kamar -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                            <label class="block text-gray-700 font-semibold mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v1H8V5z"></path>
                                </svg>
                                Fasilitas Kamar
                            </label>
                            <div class="grid grid-cols-1 gap-3">
                                <?php 
                                    $faskam = ['Kasur', 'Kipas Angin', 'Meja Belajar', 'Kursi', 'Lemari Baju', 'Cermin'];
                                    foreach ($faskam as $item) {
                                        echo "<label class='flex items-center p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors cursor-pointer border border-gray-100'>
                                                <input type='checkbox' name='fasilitas_kamar[]' value='$item' class='w-5 h-5 text-[#12506B] rounded mr-3'>
                                                <span class='text-gray-700 font-medium'>$item</span>
                                              </label>";
                                    }
                                ?>
                            </div>
                        </div>

                        <!-- Fasilitas Umum -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl border border-green-100">
                            <label class="block text-gray-700 font-semibold mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Fasilitas Umum
                            </label>
                            <div class="grid grid-cols-1 gap-3">
                                <?php 
                                    $fasum = ['Kamar Mandi', 'Kulkas', 'Dapur'];
                                    foreach ($fasum as $item) {
                                        echo "<label class='flex items-center p-3 bg-white rounded-lg hover:bg-green-50 transition-colors cursor-pointer border border-gray-100'>
                                                <input type='checkbox' name='fasilitas_umum[]' value='$item' class='w-5 h-5 text-[#12506B] rounded mr-3'>
                                                <span class='text-gray-700 font-medium'>$item</span>
                                              </label>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="space-y-2">
                        <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#12506B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Unggah Gambar Kos
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-[#12506B] transition-colors">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" />
                            </svg>
                            <input type="file" name="gambar[]" accept="image/*" multiple 
                                class="w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#12506B] file:text-white hover:file:bg-[#063D18]">

                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit" class="bg-gradient-to-r from-[#063D18] to-[#12506B] text-black px-8 py-4 rounded-xl font-semibold text-lg hover:from-[#12506B] hover:to-[#063D18] transform hover:scale-105 transition-all duration-200 shadow-lg flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Kos Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Daftar Kos -->
    <div class="max-w-6xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#063D18] to-[#12506B] px-8 py-6">
                <h2 class="text-3xl font-bold text-white flex items-center" id="manajemen">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Manajemen Kos Anda
                </h2>
                <p class="text-green-100 mt-2">Kelola semua properti kos yang Anda miliki</p>
            </div>
            
            <!-- Grid Kos -->
            <div class="p-8">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    include 'koneksi.php';
                    session_start(); // pastikan session dimulai di sini juga
                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT * FROM kost WHERE user_id = $user_id ORDER BY created_at DESC";
                    $kostList = mysqli_query($conn, $query);

                    while ($kost = mysqli_fetch_assoc($kostList)):
                      // Ambil gambar pertama dari daftar gambar (jika ada)
                      $gambar_array = explode(',', $kost['gambar']);
                      $gambar_utama = !empty($gambar_array[0]) ? $gambar_array[0] : 'assets/img/default.jpg';
                    ?>
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden group">
                            <a href="display_produk.php?id=<?php echo $kost['id']; ?>" class="block">
                                <!-- Image Container -->
                                <div class="relative overflow-hidden">
                                    <img src="<?php echo $gambar_utama; ?>" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                                        <span class="text-green-600 font-bold text-sm">Rp <?php echo number_format($kost['harga'], 0, ',', '.'); ?></span>
                                    </div>
                                    <div class="absolute bottom-4 left-4 bg-[#12506B]/90 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">
                                        <?php echo htmlspecialchars($kost['tipe']); ?>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-[#12506B] transition-colors"><?php echo htmlspecialchars($kost['nama_kos']); ?></h3>
                                    <p class="text-gray-600 flex items-center mb-3">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <?php echo htmlspecialchars($kost['alamat']); ?>
                                    </p>
                                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                                        <?php echo substr(htmlspecialchars($kost['deskripsi']), 0, 100); ?>...
                                    </p>
                                    
                                    <!-- Stats -->
                                    <div class="flex items-center justify-between mb-4 text-sm">
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                            </svg>
                                            <?php echo $kost['sisa_kamar']; ?> kamar tersisa
                                        </div>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="flex gap-3 pt-4 border-t border-gray-100">
                                        <a href="edit_kos.php?id=<?php echo $kost['id']; ?>" 
                                           class="flex-1 bg-blue-50 text-blue-600 py-2 px-4 rounded-lg text-center font-medium hover:bg-blue-100 transition-colors flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <a href="hapus_kos.php?id=<?php echo $kost['id']; ?>" 
                                           onclick="return confirm('Hapus kos ini?')"
                                           class="flex-1 bg-red-50 text-red-600 py-2 px-4 rounded-lg text-center font-medium hover:bg-red-100 transition-colors flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

</main>
<script src="js/owner.js"></script>
</body>
</html>
