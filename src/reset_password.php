<?php
$token = $_GET['token'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm">
        <h2 class="text-xl font-semibold text-center mb-4">Masukkan Password Baru</h2>
        <form method="POST" action="update_password.php">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
            <label class="block mb-2 text-sm font-medium text-gray-700">Password Baru</label>
            <input type="password" name="new_password" required class="w-full px-3 py-2 mb-4 border border-gray-300 rounded-lg">
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">Ubah Password</button>
        </form>
    </div>
</body>
</html>
