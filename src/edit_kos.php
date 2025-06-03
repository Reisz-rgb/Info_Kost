<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['user_id'] ?? 0;
$id = intval($_GET['id'] ?? 0);

// Cek kepemilikan kos
$stmt = $conn->prepare("SELECT * FROM kost WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$kost = $result->fetch_assoc();

if (!$kost) {
    die("Akses ditolak atau kos tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kos = $_POST['nama_kos'];
    $alamat = $_POST['alamat'];
    $harga = $_POST['harga'];
    $tipe = $_POST['tipe'];
    $deskripsi = $_POST['deskripsi'];

    // Tangani upload gambar baru
    $gambar_baru = $kost['gambar'];
    if (!empty($_FILES['gambar']['name'][0])) {
        $gambar_list = [];
        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        $max_size = 2 * 1024 * 1024; // 2MB

        foreach ($_FILES['gambar']['tmp_name'] as $index => $tmp_name) {
            $file_type = $_FILES['gambar']['type'][$index];
            $file_size = $_FILES['gambar']['size'][$index];

            if (!in_array($file_type, $allowed_types) || $file_size > $max_size) {
                continue; // Skip file tidak valid
            }

            $filename = "uploads/" . time() . '_' . basename($_FILES['gambar']['name'][$index]);
            if (move_uploaded_file($tmp_name, $filename)) {
                $gambar_list[] = $filename;
            }
        }

        if (!empty($gambar_list)) {
            // Hapus gambar lama
            $gambar_lama = explode(',', $kost['gambar']);
            foreach ($gambar_lama as $g) {
                if (file_exists($g)) unlink($g);
            }
            $gambar_baru = implode(',', $gambar_list);
        }
    }

    // Update database
    $stmt = $conn->prepare("UPDATE kost SET nama_kos = ?, alamat = ?, harga = ?, deskripsi = ?, gambar = ?, tipe = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssisssii", $nama_kos, $alamat, $harga, $deskripsi, $gambar_baru, $tipe, $id, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Data kos berhasil diperbarui.');window.location.href='edit_properti_owner.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui kos.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Kos</title>
  <link href="output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">✏️ Edit Kos</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="block font-semibold mb-1">Nama Kos</label>
        <input type="text" name="nama_kos" value="<?= htmlspecialchars($kost['nama_kos']) ?>" class="w-full p-2 border rounded" required>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1">Alamat</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($kost['alamat']) ?>" class="w-full p-2 border rounded" required>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1">Harga (per hari)</label>
        <input type="number" name="harga" value="<?= htmlspecialchars($kost['harga']) ?>" class="w-full p-2 border rounded" required>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1">Deskripsi</label>
        <textarea name="deskripsi" class="w-full p-2 border rounded" rows="4"><?= htmlspecialchars($kost['deskripsi']) ?></textarea>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1">Tipe</label>
        <select name="tipe" class="w-full p-2 border rounded">
            <option value="Putra" <?= $kost['tipe'] == 'Putra' ? 'selected' : '' ?>>Putra</option>
            <option value="Putri" <?= $kost['tipe'] == 'Putri' ? 'selected' : '' ?>>Putri</option>
            <option value="Campur" <?= $kost['tipe'] == 'Campur' ? 'selected' : '' ?>>Campur</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1">Gambar Baru (boleh lebih dari satu)</label>
        <input type="file" name="gambar[]" multiple class="w-full">
        <p class="text-sm text-gray-500 mt-1">Abaikan jika tidak ingin mengganti gambar.</p>
      </div>
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Simpan Perubahan
      </button>
    </form>
  </div>
</body>
</html>
