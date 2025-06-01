<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['user_id'] ?? 0;
$id = intval($_GET['id'] ?? 0);

// Pastikan kos milik user ini
$result = mysqli_query($conn, "SELECT * FROM kost WHERE id = $id AND user_id = $user_id");
$kost = mysqli_fetch_assoc($result);
if (!$kost) {
    die("Akses ditolak atau kos tidak ditemukan.");
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kos = $_POST['nama_kos'];
    $alamat = $_POST['alamat'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Tangani upload gambar baru jika ada
    $gambar_baru = '';
    if (!empty($_FILES['gambar']['name'][0])) {
        $gambar_list = [];
        foreach ($_FILES['gambar']['tmp_name'] as $index => $tmp_name) {
            $filename = "uploads/" . time() . '_' . basename($_FILES['gambar']['name'][$index]);
            move_uploaded_file($tmp_name, $filename);
            $gambar_list[] = $filename;
        }
        $gambar_baru = implode(',', $gambar_list);

        // Hapus gambar lama
        $gambar_lama = explode(',', $kost['gambar']);
        foreach ($gambar_lama as $g) {
            if (file_exists($g)) unlink($g);
        }
    } else {
        $gambar_baru = $kost['gambar']; // gunakan gambar lama jika tidak diubah
    }

    // Update data ke database
    $query = "UPDATE kost SET 
                nama_kos = '$nama_kos',
                alamat = '$alamat',
                harga = '$harga',
                deskripsi = '$deskripsi',
                gambar = '$gambar_baru'
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
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
        <input type="text" name="nama_kos" value="<?php echo htmlspecialchars($kost['nama_kos']); ?>" class="w-full p-2 border rounded" required>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1">Alamat</label>
        <input type="text" name="alamat" value="<?php echo htmlspecialchars($kost['alamat']); ?>" class="w-full p-2 border rounded" required>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1">Harga (per hari)</label>
        <input type="number" name="harga" value="<?php echo htmlspecialchars($kost['harga']); ?>" class="w-full p-2 border rounded" required>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1">Deskripsi</label>
        <textarea name="deskripsi" class="w-full p-2 border rounded" rows="4"><?php echo htmlspecialchars($kost['deskripsi']); ?></textarea>
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
