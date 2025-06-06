<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kost Hero</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center">
    <button onclick="window.history.back()" class="fixed top-6 left-6 z-10 bg-opacity-90 rounded-full p-2 shadow hover:bg-opacity-100 transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl cursor-pointer">
        <img src="assets/img/icons/back.png" alt="Back" class="h-6 w-6">
    </button>

    <div class="fixed inset-0 bg-black opacity-20"></div>

    <!-- Container -->
    <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl px-6">
        <div class="fixed inset-0 -z-10">
            <img src="assets/img/bg/km4.png" alt="Kost Hero Logo" class="w-full h-full object-cover">
        </div>
        <div class="bg-white/80 backdrop-blur-md p-6 sm:p-8 lg:p-10 rounded-xl shadow-lg border border-blue-100 mx-auto">
            
            <!-- Logo dan Judul -->
            <div class="flex flex-col items-center mb-6">
                <img src="assets/img/logo.png" alt="Kost-Hero Logo" class="mb-2 w-14 h-14 lg:w-16 lg:h-16 rounded-full">
                <span class="text-xl lg:text-2xl font-bold text-[#12506B] mb-3 tracking-wide">Kost Hero</span>
            </div>

            <!-- Form Login -->
            <p class="text-gray-500 font-bold text-center mb-4 text-sm lg:text-base">Masuk ke akun Anda</p>
            <form method="POST" action="auth_login.php">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1" for="email">Email</label>
                    <input class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base" type="email" id="email" name="email" required placeholder="you@example.com">
                </div>
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-1" for="password">Password</label>
                    <input class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base" type="password" id="password" name="password" required placeholder="••••••••">
                </div>
                <button class="w-full bg-gradient-to-r from-[#12506B] to-[#063D18] text-white py-2 rounded-lg font-semibold shadow-md hover:from-[#12506B] hover:to-[#12506B] transition text-sm lg:text-base" type="submit">
                    Login
                </button>
            </form>

            <!-- Link Signup -->
            <p class="mt-4 text-center text-gray-600 text-xs lg:text-sm">
                Belum punya akun? <a onclick="redirectToRegist()" class="text-blue-600 font-semibold hover:underline cursor-pointer">Daftar</a>
            </p>

            <!-- Link Lupa Password -->
            <p class="mt-3 text-center text-gray-600 text-xs lg:text-sm">
                Lupa password? <a href="forgot_password.php" class="text-blue-600 font-semibold hover:underline">Reset di sini</a>
            </p>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>
