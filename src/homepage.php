<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Hero</title>
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-[#063D18] text-white p-4 flex justify-between items-center">
        <div onclick="redirectToRole()" class="flex items-center space-x-2 cursor-pointer">
            <img src="assets/img/logo.png" alt="Logo" class="h-10 w-10">
            <h1 class="text-xl font-bold">Kost Hero</h1>
        </div>
        <div class="flex items-center space-x-4">
            <button onclick="redirectToRole()" class="flex items-center gap-1 cursor-pointer"> 
                <img src="assets/img/icons/notif.png" alt="Notifikasi" class="h-5 w-6">
                <span class="text-xs">Notifikasi</span>
            </button>
            <button onclick="redirectToRole()" class="flex items-center gap-1 cursor-pointer">
                <img src="assets/img/icons/help.png" alt="Pusat Bantuan" class="h-7 w-5">
                <span class="text-xs">Pusat Bantuan</span>
            </button>
            <div class="relative">
                <button id="accountBtn" class="flex items-center gap-1 cursor-pointer hover:bg-green-700 px-2 py-1 rounded">
                    <img src="assets/img/icons/profil.png" alt="Akun" class="h-5 w-5">
                    <span class="text-xs">Akun</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div id="accountDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 hidden">
                    <div class="py-1">
                        <a href="edit_akun.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                        <a href="hal_favorit.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Halaman Disukai</a>
                        <a href="rt_pencari.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Riwayat Pesanan</a>
                        <hr class="my-1">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Promotion Section -->
    <section class="relative rounded-lg shadow-lg mt-6 mx-4">
        <div class="relative w-full h-64 md:h-80 lg:h-96">
            <!-- Slideshow Images -->
            <div class="slideshow-container w-full h-64 md:h-80 lg:h-96 relative overflow-hidden rounded-lg">
                <img id="slide-img" src="assets/img/bg/promosi1.png" alt="Room Image" class="slide w-full h-64 md:h-80 lg:h-96 object-cover absolute transition-opacity duration-500 ease-in-out opacity-100">
                <img id="slide-img2" src="assets/img/bg/km3.png" alt="Room Image" class="slide w-full h-64 md:h-80 bg-black opacity-20 lg:h-96 object-cover absolute transition-opacity duration-500 ease-in-out opacity-0">
                <img id="slide-img3" src="assets/img/bg/km5.png" alt="Room Image" class="slide w-full h-64 md:h-80 bg-black opacity-10 lg:h-96 object-cover absolute transition-opacity duration-500 ease-in-out opacity-0">

            <!-- Text Overlay -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <h1 id="overlay-text-1" class="overlay-text text-3xl md:text-2xl font-bold text-center px-4 transition-opacity duration-500 ease-in-out opacity-100">
                        Diskon <span class="text-red-800 font-extrabold text-5xl">25%</span>
                        <br>
                        <span class="font-extrabold text-3xl">Untuk 1 Bulan Pertama</span>
                        <br>
                        <div class="mt-4 bg-gray-200 opacity-80 px-4 py-2 rounded-lg inline-block stroke-linejoin">
                            <div class="text-xs">Penawaran berakhir dalam:</div>
                            <div id="countdown" class="mt-2 stroke-linejoin font-bold">
                                <span id="days" class="border border-[#807878] bg-white px-2 rounded"></span>:
                                <span id="hours" class="border border-[#807878] bg-white px-2 rounded"></span>:
                                <span id="minutes" class="border border-[#807878] bg-white px-2 rounded"></span>:
                                <span id="seconds" class="border border-[#807878] bg-white px-2 rounded"></span>
                            </div>
                        </div>
                    </h1>
                    <h1 id="overlay-text-2" class="overlay-text text-3xl md:text-2xl font-bold text-center px-4 transition-opacity duration-500 ease-in-out opacity-0 absolute">
                        Temukan Kost Impian
                        <br>
                        <span class="font-extrabold text-white">Dengan Mudah dan Cepat</span>
                    </h1>
                    <h1 id="overlay-text-3" class="overlay-text text-3xl md:text-2xl font-bold text-center px-4 transition-opacity duration-500 ease-in-out opacity-0 absolute">
                        Sewa Kost Nyaman
                        <br>
                        <span class="font-extrabold text-[#620F08]">Langsung dengan Pemiliknya</span>
                    </h1>
                </div>

                <!-- Navigation Buttons -->
                <button id="prevBtn" class="absolute left-2 top-1/2 transform -translate-y-1/2 px-4">
                    <img src="assets/img/icons/chev_left.png" alt="Previous" class="h-5 w-5">
                </button>
                <button id="nextBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2 px-4">
                    <img src="assets/img/icons/chev_right.png" alt="Next" class="h-5 w-5">
                </button>
            </div>
       </div>
    </section>

    <!-- Search Bar -->
    <section class="mt-4 mx-4">
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-2 flex items-center pl-2 border-gray-300">
                <img src="assets/img/icons/cari.png" alt="Cari" class="h-5 w-5 text-gray-400">
            </span>
            <input 
                type="text" 
                placeholder="Cari nama kost, area, atau kampus..." 
                class="w-full p-4 pl-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#B33328] focus:border-[#B33328] transition-colors"/>
        </div>
    </section>  
        

    <!-- Recommended Rooms -->
    <section class="mt-8 mx-4">
        <h2 class="text-2xl font-extrabold color-[12506B] text-center">MUNGKIN ANDA SUKA</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <div onclick="redirectToRole()" class="bg-white rounded-lg shadow-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:bg-gray-50 cursor-pointer group">
                <img src="assets/img/bg/km0.png" alt="Room Image" class="w-full h-45 object-cover rounded-lg transition-transform duration-300">
                <h3 class="mt-2 font-bold text-gray-800 transition-colors duration-300 group-hover:text-green-700">Kost Eksklusif - Kost Putra</h3>
                <p class="text-gray-600 transition-colors duration-300 group-hover:text-gray-700">Gang Mangga, Sekaran</p>
                <div class="flex items-center gap-1 mt-1">
                    <div class="flex text-yellow-400">
                        <span>★★★★</span><span class="relative inline-block"><span class="absolute inset-0 overflow-hidden w-1/2">★</span>☆</span>
                    </div>
                    <span class="text-sm text-gray-500">(5.0)</span>
                </div>
                <p class="text-green-700 font-bold transition-all duration-300 group-hover:text-green-800 group-hover:text-lg">Rp 999.000</p>
            </div>
            <div onclick="redirectToRole()" class="bg-white rounded-lg shadow-lg p-4  transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:bg-gray-50 cursor-pointer group">
                 <img src="assets/img/bg/km2.png" alt="Room Image" class="w-full h-45 object-cover rounded-lg transition-transform duration-300">
                <h3 class="mt-2 font-bold">Kos Katcaw - Kost Putri</h3>
                <p class="text-gray-600">Gang Jeruk, Sekaran</p>
                <div class="flex items-center gap-1 mt-1">
                    <div class="flex text-yellow-400">
                        <span>★★★★</span><span class="relative inline-block"><span class="absolute inset-0 overflow-hidden w-1/2">★</span>☆</span>
                    </div>
                    <span class="text-sm text-gray-500">(4.8)</span>
                </div>
                <p class="text-green-700 font-bold">Rp 999.000</p>
            </div>
            <div onclick="redirectToRole()" class="bg-white rounded-lg shadow-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:bg-gray-50 cursor-pointer group">
                 <img src="assets/img/bg/km3.png" alt="Room Image" class="w-full h-45 object-cover rounded-lg transition-transform duration-300">
                <h3 class="mt-2 font-bold">Kost Balaw - Kost Putra</h3>
                <p class="text-gray-600">Ampel Gading, Kalisegoro</p>
                <div class="flex items-center gap-1 mt-1">
                    <div class="flex text-yellow-400">
                        <span>★★★★</span><span class="relative inline-block"><span class="absolute inset-0 overflow-hidden w-1/2">★</span>☆</span>
                    </div>
                    <span class="text-sm text-gray-500">(4.9)</span>
                </div>
                <p class="text-green-700 font-bold">Rp 900.000</p>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button onclick="redirectToRole()" class="bg-[#12506B] px-4 py-2 text-white rounded">
            Lihat Semua
            </button>
        </div>
    </section>

    <!-- Recommeded Area-->
    <section class="mt-8 mx-4">
        <h2 class="text-2xl font-extrabold text-[#12506B] text-center">REKOMENDASI KOS DI SEKITAR KAMPUS</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <div onclick="redirectToRole()" class="bg-white rounded-lg shadow-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:bg-gray-50 cursor-pointer group">
            <img src="assets/img/bg/unnes.png" alt="Area Image" class="w-full h-32 object-contain rounded-lg">
            <h3 class="mt-1 font-bold">UNNES</h3>
            <p class="text-gray-600">Gunungpati, Semarang</p>
            </div>
            <div onclick="redirectToRole()" class="bg-white rounded-lg shadow-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:bg-gray-50 cursor-pointer group">
            <img src="assets/img/bg/undip.png" alt="Area Image" class="w-full h-32 object-contain rounded-lg">
            <h3 class="mt-1 font-bold">UNDIP</h3>
            <p class="text-gray-600">Tembalang, Semarang</p>
            </div>
            <div onclick="redirectToRole()" class="bg-white rounded-lg shadow-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:bg-gray-50 cursor-pointer group">
            <img src="assets/img/bg/polines.png" alt="Area Image" class="w-full h-32 object-contain rounded-lg">
            <h3 class="mt-1 font-bold">Polines</h3>
            <p class="text-gray-600">Semarang</p>
            </div>
            <div onclick="redirectToRole()" class="bg-white rounded-lg shadow-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:bg-gray-50 cursor-pointer group">
            <img src="assets/img/bg/poltekkes.png" alt="Area Image" class="w-full h-32 object-contain rounded-lg">
            <h3 class="mt-1 font-bold">Poltekkes</h3>
            <p class="text-gray-600">Semarang</p>
            </div>
            <div onclick="redirectToRole()" class="bg-white rounded-lg shadow-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:bg-gray-50 cursor-pointer group">
            <img src="assets/img/bg/udinus.png" alt="Area Image" class="w-full h-32 object-contain rounded-lg">
            <h3 class="mt-1 font-bold">Udinus</h3>
            <p class="text-gray-600">Semarang</p>
            </div>
            <div onclick="redirectToRole()" class="bg-white rounded-lg shadow-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:bg-gray-50 cursor-pointer group">
            <img src="assets/img/bg/unisula.png" alt="Area Image" class="w-full h-32 object-contain rounded-lg">
            <h3 class="mt-1 font-bold">Unisula</h3>
            <p class="text-gray-600">Semarang</p>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button onclick="redirectToRole()" class="bg-[#12506B] px-4 py-2 text-white rounded">
            Lihat Semua
            </button>
        </div>
    </section>

       <!-- About Section -->
    <section class="mt-8 mx-4">
        <h2 class="text-2xl font-extrabold text-[#063D18] text-center">TENTANG KOST HERO</h2>
        <p class="mt-2 text-gray-700 text-center">
            Kost Hero adalah platform yang memudahkan pencarian kost dengan simple dan praktis!
        </p>
    </section>

    <!-- Footer -->
<footer class="bg-[#063D18] text-white p-4 mt-6 flex flex-wrap justify-between gap-8">
    <!-- Logo & Contact -->
    <div class="w-full mt-3 flex flex-col flex-1 min-w-[200px]">
        <div class="flex items-center mb-4">
            <img src="assets/img/logo.png" class="h-10 w-10 mr-3 mt-6" alt="Logo">
            <span class="text-lg font-bold mt-6 flex ">Kost Hero</span>
        </div>
        <h4 class="text-base font-bold mb-2">Kontak</h4>
        <p class="text-sm font-light mb-1"><strong>Alamat:</strong> Sekaran, Gunungpati, Semarang</p>
        <p class="text-sm font-light mb-4"><strong>Telepon:</strong> +62 8xx-xxx-xxx</p>
        <h4 class="mb-1">Ikuti Kami</h4>
        <div class="flex gap-3 text-lg">
            <i class="fa-brands fa-facebook-f"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-instagram"></i>
        </div>
    </div>

    <!-- Informasi -->
    <div class="w-full mt-4 flex flex-col flex-1 min-w-[200px]">
        <h4 class="font-bold mb-2">Informasi</h4>
        <a href="#" class="mb-1 hover:underline">Tentang Kami</a>
        <a href="#" class="mb-1 hover:underline">Kebijakan Privasi</a>
        <a href="#" class="hover:underline">Syarat & Ketentuan</a>
    </div>

    <!-- Fitur -->
    <div class="w-full mt-4 flex flex-col flex-1 min-w-[200px]">
        <h4 class="font-bold mb-2">Fitur</h4>
        <a href="#" class="mb-1 hover:underline">Daftar Akun</a>
        <a href="#" class="mb-1 hover:underline">Daftar Favorit</a>
        <a href="#" class="mb-1 hover:underline">Lacak Pesanan</a>
        <a href="#" class="hover:underline">Bantuan</a>
    </div>

    <!-- Secure Payment -->
    <div class="w-full mt-4 flex flex-col flex-1 min-w-[200px]">
        <h4 class="font-bold mb-2">Pembayaran Aman</h4>
        <p class="text-sm font-light mb-1">Kami menyediakan berbagai metode pembayaran yang aman dan terpercaya.</p>
        <div class="flex items-center gap-2">
            <img src="assets/img/icons/visa.png" alt="Visa" class="h-4 w-auto mr-2">
            <img src="assets/img/icons/bni.png" alt="BNI" class="h-4 w-auto mr-2">
            <img src="assets/img/icons/bri.png" alt="BRI" class="h-7 w-auto mr-2">
            <img src="assets/img/icons/bca.png" alt="BCA" class="h-4 w-auto">
        </div>
    </div>

        <!-- Copyright -->
        <div class="w-full mt-3">
            <p class="text-xs text-center">&copy; 2025 Kost Hero. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
    <script src="js/pencari.js"></script>

</body>
</html>
