<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    die("Silakan login terlebih dahulu.");
}

// Validasi input
if (!isset($_POST['kost_id'], $_POST['checkin'], $_POST['durasi'], $_POST['status'], $_POST['metode_pembayaran'])) {
    die("Data tidak lengkap.");
}

$user_id = $_SESSION['user_id'];
$kost_id = intval($_POST['kost_id']);
$checkin = $_POST['checkin'];
$durasi = intval($_POST['durasi']);
$status = $_POST['status'];
$metode = $_POST['metode_pembayaran'];

// Validasi data
if ($kost_id <= 0 || $durasi <= 0) {
    die("Data tidak valid.");
}

// Mulai transaksi
$conn->begin_transaction();

try {
    // Ambil harga kost dengan prepared statement
    $stmt = $conn->prepare("SELECT * FROM kost WHERE id = ?");
    $stmt->bind_param("i", $kost_id);
    $stmt->execute();
    $kost = $stmt->get_result()->fetch_assoc();
    
    if (!$kost) {
        throw new Exception("Kost tidak ditemukan.");
    }
    
    $harga_total = $kost['harga'] * $durasi;

    // Ambil info pemilik
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $kost['user_id']);
    $stmt->execute();
    $pemilik = $stmt->get_result()->fetch_assoc();
    
    if (!$pemilik) {
        throw new Exception("Pemilik tidak ditemukan.");
    }

    // Ambil info user
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    
    if (!$user) {
        throw new Exception("User tidak ditemukan.");
    }

        // Validasi status
        $allowed_statuses = ['Menunggu Pembayaran', 'Selesai', 'Dibatalkan'];
        $status = in_array($_POST['status'], $allowed_statuses) ? $_POST['status'] : 'Menunggu Pembayaran';

        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO sewa (user_id, kost_id, checkin, durasi, status, metode_pembayaran) 
                            VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $user_id, $kost_id, $checkin, $durasi, $status, $metode);

        if ($stmt->execute()) {
            echo "Penyewaan berhasil diajukan!";
        } else {
            echo "Gagal menyimpan data: " . $stmt->error;
        }
        
    // Commit transaksi jika semua berhasil
    $conn->commit();

    // Siapkan pesan WA
    $pesan_user = "Halo {$user['nama']}, Anda telah mengajukan sewa kost \"{$kost['nama']}\" selama $durasi bulan.\nTotal harga: Rp " . number_format($harga_total, 0, ',', '.') . "\nMetode: $metode\nSilakan hubungi pemilik di: {$pemilik['telepon']}";

    $pesan_pemilik = "Halo {$pemilik['nama']}, ada pengajuan sewa kost \"{$kost['nama']}\" oleh {$user['nama']} selama $durasi bulan.\nTotal harga: Rp " . number_format($harga_total, 0, ',', '.') . "\nMetode: $metode\nHubungi penyewa: {$user['telepon']}";

    // Redirect ke WhatsApp
    $wa_link_user = "https://wa.me/{$user['telepon']}?text=" . urlencode($pesan_user);
    $wa_link_pemilik = "https://wa.me/{$pemilik['telepon']}?text=" . urlencode($pesan_pemilik);

    echo "<script>
        alert('Pengajuan berhasil! Pesan WA akan dikirim.');
        window.open('$wa_link_pemilik', '_blank');
        window.location.href = '$wa_link_user';
    </script>";

} catch (Exception $e) {
    $conn->rollback();
    die("Error: " . $e->getMessage());
}
?>