<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Kost Hero</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 min-h-screen flex items-center justify-center">
    <button onclick="window.history.back()" class="fixed top-6 left-6 z-10 bg-opacity-90 rounded-full p-2 shadow hover:bg-opacity-100 transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl cursor-pointer">
            <img src="assets/img/icons/back.png" alt="Back" class="h-6 w-6">
    </button>

    <div class="fixed inset-0 -z-10">
        <img src="assets/img/bg/km4.png" alt="Kost Hero Logo" class="w-full h-full object-cover">
    </div>

    <div class="fixed inset-0 bg-black opacity-20"></div>

    <!-- Container -->
    <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl px-6">
        <div class="bg-white/80 backdrop-blur-md p-6 sm:p-8 lg:p-10 rounded-xl shadow-lg border border-blue-100 mx-auto">
            
            
            <!-- Logo dan Judul -->
            <div class="flex flex-col items-center mb-6">
                <img src="assets/img/logo.png" alt="Kost-Hero Logo" class="mb-2 w-14 h-14 lg:w-16 lg:h-16 rounded-full">
                <span class="text-xl lg:text-2xl font-bold text-[#12506B] mb-3 tracking-wide">Kost Hero</span>
            </div>

            <!-- Form Register -->
            <p class="text-gray-500 font-bold text-center mb-4 text-sm lg:text-base">Daftar akun Anda</p>
            <form method="POST" action="auth_register.php" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1" for="username">Username</label>
                    <input class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base" type="username" id="username" name="username" required placeholder="Budi">
                </div>
               <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1" for="telepon">Nomor Telepon (Format Internasional)</label>
                <input class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base" type="tel"
                    id="telepon"
                    name="telepon"
                    required
                    placeholder="+6281234567890"
                    pattern="^\+62[0-9]{9,13}$"
                    title="Masukkan nomor telepon dalam format internasional, misalnya +6281234567890">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1" for="foto">Foto Profil</label>
                    <input class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base" type="file" name="foto" accept="image/*"">
                </div>
                 <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1" for="alamat">Alamat</label>
                    <input class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base" type="alamat" id="alamat" name="alamat" required placeholder="Sekaran">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1" for="email">Email</label>
                    <input class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base" type="email" id="email" name="email" required placeholder="you@example.com">
                </div>
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-1" for="password">Password</label>
                    <input class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base" type="password" id="password" name="password" required placeholder="••••••••">
                </div>
                <div>
                <label class="block text-gray-700 font-semibold mb-1" for="gender">Gender</label>
                    <select name="gender" class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div><br>
                <div>
                <label class="block text-gray-700 font-semibold mb-1" for="role">Role</label>
                    <select name="role" class="w-full px-3 py-2 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#12506B] transition text-sm lg:text-base">
                        <option value="pencari">Saya Pencari</option>
                        <option value="pemilik">Saya Pemilik Kos</option>
                    </select>
                    </div><br>
                <button class="w-full bg-gradient-to-r from-[#12506B] to-[#063D18] text-white py-2 rounded-lg font-semibold shadow-md hover:from-[#12506B] hover:to-[#12506B] transition text-sm lg:text-base" type="submit">
                    Daftar
                </button>
            </form>


            <p class="text-xs text-gray-700 mt-4">Sudah punya akun? 
                <a href="login_sebagai.php" class="text-blue-900 hover:underline">Login</a>
            </p>
        </div>
    </div>

</body>
</html>
