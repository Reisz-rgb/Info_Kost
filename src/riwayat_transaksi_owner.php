<?php
session_start();
include 'koneksi.php';

// Pastikan hanya pemilik yang bisa mengakses
if (!isset($_SESSION['user_id'])) {
    header("Location: login_sebagai.php");
    exit();
}

// Cek apakah user adalah pemilik
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user['role'] != 'pemilik') {
    header("Location: index.php");
    exit();
}

// Proses perubahan status jika ada request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ubah_status'])) {
    $sewa_id = $_POST['sewa_id'];
    $status_baru = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE sewa SET status = ? WHERE id = ? AND kost_id IN (SELECT id FROM kost WHERE user_id = ?)");
    $stmt->bind_param("sii", $status_baru, $sewa_id, $user_id);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        $pesan = "Status berhasil diubah";
    } else {
        $pesan = "Gagal mengubah status";
    }
}

// Ambil data riwayat transaksi
$query = "SELECT s.id, s.checkin, s.durasi, s.status, s.created_at, 
                 u.username AS username_penyewa, 
                 k.nama_kos, k.harga,
                 (k.harga * s.durasi) AS total_harga
          FROM sewa s
          JOIN users u ON s.user_id = u.id
          JOIN kost k ON s.kost_id = k.id
          WHERE k.user_id = ?
          ORDER BY s.created_at DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi Pemesanan Kos - Pemilik Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="bg-[#063D18] text-white p-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <img src="assets/img/logo.png" alt="Logo" class="h-10 w-10">
            <h1 class="text-xl font-bold">Kost Hero</h1>
        </div>
        <div class="hidden md:flex items-center space-x-4">
            <ul class="flex space-x-4 list-none">
                <li class="p-4 hover:bg-gray-200"><a href="profil_pemilik.php">Home</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="hal_favorit.php">Favorit</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="riwayat_transaksi_owner.php">Riwayat Transaksi</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="edit_akun.php">Edit Akun</a></li>
                <li class="p-4 hover:bg-gray-200"><a href="log out.php">Log Out</a></li>
            </ul>
        </div>
        <button id="toggleNav" class="block md:hidden mr-6">
            <img id="menuIcon" src="assets/img/icons/menu.png" alt="Menu" class="w-6 h-6 text-gray-400">
        </button>
    </header>
    
    <div id="mobileNav" class="fixed left-[-100%] h-full top-0 w-[60%] bg-[#12506B] transition-all duration-500">
        <h1 class="text-3xl text-gray-400 m-4">Kost Hero</h1>
        <ul class="p-8 text-2xl">
            <li class="p-4 hover:bg-[#B33328]"><a href="profil_pemilik.php">Home</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="hal_favorit.php">Favorit</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="riwayat_transaksi_owner.php">Riwayat Transaksi</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="edit_akun.php">Edit Akun</a></li>
            <li class="p-4 hover:bg-[#B33328]"><a href="logout.php">Log Out</a></li>
        </ul>
    </div>

    <div class="container mx-auto p-4">
        <?php if (isset($pesan)): ?>
            <div class="alert alert-info mb-4"><?php echo $pesan; ?></div>
        <?php endif; ?>
        
        <h2 class="text-2xl font-bold mb-6">Riwayat Transaksi Pemesanan Kos</h2>
        
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">username Penyewa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pesan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi Sewa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if ($result->num_rows > 0): ?>
                        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $no++; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['username_penyewa']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['nama_kos']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['durasi']; ?> bulan</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php 
                                        switch($row['status']) {
                                            case 'Menunggu Pembayaran': echo 'bg-yellow-100 text-yellow-800'; break;
                                            case 'Selesai': echo 'bg-green-100 text-green-800'; break;
                                            case 'Dibatalkan': echo 'bg-red-100 text-red-800'; break;
                                            default: echo 'bg-gray-100 text-gray-800';
                                        }
                                        ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form method="POST" class="flex items-center space-x-2">
                                        <input type="hidden" name="sewa_id" value="<?php echo $row['id']; ?>">
                                        <select name="status" class="border rounded p-1 text-sm">
                                            <option value="Menunggu Pembayaran" <?php echo $row['status'] == 'Menunggu Pembayaran' ? 'selected' : ''; ?>>Menunggu Pembayaran</option>
                                            <option value="Selesai" <?php echo $row['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                            <option value="Dibatalkan" <?php echo $row['status'] == 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                                        </select>
                                        <button type="submit" name="ubah_status" class="bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada transaksi</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Toggle mobile menu
        document.getElementById('toggleNav').addEventListener('click', function() {
            const mobileNav = document.getElementById('mobileNav');
            if (mobileNav.style.left === '-100%') {
                mobileNav.style.left = '0';
            } else {
                mobileNav.style.left = '-100%';
            }
        });
    </script>
</body>
</html>