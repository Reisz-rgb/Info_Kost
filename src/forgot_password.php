<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <button onclick="window.history.back()" class="fixed top-6 left-6 z-10 bg-opacity-90 rounded-full p-2 shadow hover:bg-opacity-100 transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl cursor-pointer">
        <img src="assets/img/icons/back.png" alt="Back" class="h-6 w-6">
    </button>
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm">
        <h2 class="text-xl font-semibold text-center mb-4">Reset Password</h2>
        <form method="POST" action="send_reset_link.php">
            <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" required class="w-full px-3 py-2 mb-4 border border-gray-300 rounded-lg">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Kirim Link Reset</button>
        </form>
    </div>
<script src="js/main.js"></script>
</body>
</html>
