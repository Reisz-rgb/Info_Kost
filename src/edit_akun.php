<?php
session_start();
require_once 'koneksi.php'; 

$username = $_SESSION['username']; // ambil dari session login

// Ambil data lama user
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

    // Upload foto jika diunggah
    $foto_username = $user['foto']; // default ke foto lama
    if (!empty($_FILES['foto']['name'])) {
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_username = uniqid() . "." . $foto_ext;
        $foto_path = "uploads/" . $foto_username;

        // Pindahkan file ke folder uploads/
        move_uploaded_file($foto_tmp, $foto_path);
    }

    // Simpan perubahan ke database
    $update = "UPDATE users SET 
        username = '$username', 
        gender = '$gender', 
        email = '$email', 
        alamat = '$alamat', 
        telepon = '$telepon', 
        password = '$password', 
        foto = '$foto_username'
        WHERE username = '$username'";

    if (mysqli_query($conn, $update)) {
        header("Location: profil_pemilik.php?status=updated");
        exit;
    } else {
        echo "Gagal mengupdate: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Profile</title>
  <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-white p-10">
  <div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-start mb-6">
      <h1 class="text-2xl font-semibold">Informasi Pribadi</h1>
      <div class="w-16 h-16 rounded-full bg-cyan-700 flex items-center justify-center">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
      </div>
    </div>

    <form class="space-y-5" method="POST" enctype="multipart/form-data" action="">
      <!-- username dan Gender -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">Username</label>
          <input type="text" name="nama" value="<?= htmlspecialchars($user['username']) ?>" class="mt-1 w-full p-2 border border-gray-300 rounded"/>
        </div>
        <div>
          <label class="block text-sm font-medium">Gender</label>
            <select name="gender" class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
            </select>
        </div>
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email" name="email" class="mt-1 w-full p-2 border border-gray-300 rounded" value="<?= htmlspecialchars($users['email']) ?>">
      </div>

      <!-- Alamat -->
      <div>
        <label class="block text-sm font-medium">Alamat</label>
        <input type="text" name="alamat" class="mt-1 w-full p-2 border border-gray-300 rounded" value="<?= htmlspecialchars($users['alamat']) ?>">
      </div>

      <!-- Telepon -->
      <div>
        <label class="block text-sm font-medium">Telepon</label>
        <input type="text" name="telepon" class="mt-1 w-full p-2 border border-gray-300 rounded" value="<?= htmlspecialchars($users['telepon']) ?>">
      </div>

      <!-- Foto Profil -->
      <div>
        <label class="block text-sm font-medium">Foto Profil</label>
        <input type="file" name="foto"
               class="mt-1 w-full p-2 border border-gray-300 rounded"/>
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password"
               class="mt-1 w-full p-2 border border-gray-300 rounded"/>
      </div>

      <!-- Tombol -->
      <div class="flex justify-end gap-3 pt-4">
        <button onclick="window.history.back()" type="button" class="px-4 py-2 border border-orange-500 text-orange-500 rounded hover:bg-orange-50">
          Cancel
        </button>
        <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">
          Save
        </button>
      </div>
    </form>
  </div>
</body>
</html>