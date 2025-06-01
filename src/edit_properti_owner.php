<?php
include 'koneksi.php';
session_start();
$user_id = $_SESSION['user_id'];

$kostList = mysqli_query($conn, "SELECT * FROM kost WHERE user_id = $user_id");
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
    <header class="bg-[#063D18] text-white p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="assets/img/logo.png" alt="Logo" class="h-10 w-10">
            <h1 class="text-xl font-bold">Kost Hero</h1>
        </div>
        <div class="hidden md:flex items-center space-x-4">
            <ul class="flex space-x-4 list-none">
                <li class="p-4 hover:bg-gray-200"><a href="index.php">Home</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="edit_properti_owner.php">Manajemen Properti</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="riwayat_transaksi_owner.php">Riwayat Transaksi</a></li>
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
            <li class="p-4 hover:bg-[#B33328]"><a href="edit_properti_owner.php">Manajemen Properti</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="riwayat_transaksi_owner.php">Riwayat Transaksi</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="edit_akun.php">Edit Akun</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="log out.php">Log Out</a></li>
        </ul>
    </div>
<main class="bg-gray-50 py-8">
<div class="max-w-4xl mx-auto px-4 py-8 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Data Kos</h2>
    <form action="proses_tambah_kos.php" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div>
            <label class="block text-gray-700 font-medium mb-1">Nama Kos</label>
            <input type="text" name="nama_kos" required class="w-full border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Alamat</label>
            <input type="text" name="alamat" required class="w-full border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" required class="w-full border-gray-300 rounded-lg"></textarea>
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Jumlah Kamar Tersisa</label>
            <input type="number" name="sisa_kamar" class="w-full border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-gray-700 font-medium mb-1">Harga (per bulan)</label>
            <input type="number" name="harga" required class="w-full border-gray-300 rounded-lg">
        </div>

        <!-- Fasilitas Kamar -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Fasilitas Kamar</label>
            <div class="grid grid-cols-2 gap-2">
                <?php 
                    $faskam = ['Kasur', 'Kipas Angin', 'Meja Belajar', 'Kursi', 'Lemari Baju', 'Cermin'];
                    foreach ($faskam as $item) {
                        echo "<label><input type='checkbox' name='fasilitas_kamar[]' value='$item'> $item</label>";
                    }
                ?>
            </div>
        </div>

        <!-- Fasilitas Umum -->
        <div>
            <label class="block text-gray-700 font-medium mb-1">Fasilitas Umum</label>
            <div class="grid grid-cols-2 gap-2">
                <?php 
                    $fasum = ['Kamar Mandi', 'Kulkas', 'Dapur'];
                    foreach ($fasum as $item) {
                        echo "<label><input type='checkbox' name='fasilitas_umum[]' value='$item'> $item</label>";
                    }
                ?>
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Unggah Gambar</label>
            <input type="file" name="gambar[]" accept="image/*" multiple class="w-full border-gray-300 rounded-lg">
        </div>

        <div>
            <button type="submit" class="bg-[#12506B] text-white px-6 py-3 rounded-lg">Tambah Kos</button>
        </div>
    </form>
</div>
<br>

<!-- Daftar Kos -->
<h2 class="text-xl font-semibold mb-4" id="manajemen">🏘️ Kos yang Anda Tambahkan</h2>
<div class="grid grid-cols-2 gap-6">
  <?php
    include 'koneksi.php';
    $query = "SELECT * FROM kost ORDER BY created_at DESC";
    $kostList = mysqli_query($conn, $query);

    while ($kost = mysqli_fetch_assoc($kostList)):
      // Ambil gambar pertama dari daftar gambar (jika ada)
      $gambar_array = explode(',', $kost['gambar']);
      $gambar_utama = !empty($gambar_array[0]) ? $gambar_array[0] : 'assets/img/default.jpg';
  ?>
    <div class="bg-white shadow p-4 rounded">
    <a href="display_produk.php?id=<?php echo $kost['id']; ?>">
      <img src="<?php echo $gambar_utama; ?>" class="w-full h-40 object-cover rounded mb-3">
      <h3 class="text-lg font-bold"><?php echo htmlspecialchars($kost['nama_kos']); ?></h3>
      <p class="text-sm text-gray-600"><?php echo htmlspecialchars($kost['alamat']); ?></p>
      <p class="text-green-600 font-semibold">Rp <?php echo number_format($kost['harga'], 0, ',', '.'); ?></p>
      <p class="text-sm text-gray-500 mt-1">
        <?php echo substr(htmlspecialchars($kost['deskripsi']), 0, 100); ?>...
      </p>
      <div class="flex justify-between mt-4 text-sm">
        <a href="edit_kos.php?id=<?php echo $kost['id']; ?>" class="text-blue-600 hover:underline">Edit</a>
        <a href="hapus_kos.php?id=<?php echo $kost['id']; ?>" class="text-red-600 hover:underline" onclick="return confirm('Hapus kos ini?')">Hapus</a>
      </div>
    </a>
    </div>
  <?php endwhile; ?>
</div>

</main>
<script src="js/owner.js"></script>
</body>
</html>
