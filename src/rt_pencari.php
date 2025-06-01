<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan - Kost Hero</title>
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Riwayat Pemesanan</h1>
                    <p class="text-blue-100">Kelola dan pantau pesanan kost Anda</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-history text-6xl opacity-20"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Pemesanan</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Semua Status</option>
                        <option>Menunggu Konfirmasi</option>
                        <option>Dikonfirmasi</option>
                        <option>Aktif</option>
                        <option>Selesai</option>
                        <option>Dibatalkan</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Semua Waktu</option>
                        <option>30 Hari Terakhir</option>
                        <option>3 Bulan Terakhir</option>
                        <option>6 Bulan Terakhir</option>
                        <option>1 Tahun Terakhir</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Booking History Cards -->
        <div class="space-y-6">
            <!-- Active Booking -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                        <div class="flex items-center gap-4 mb-4 lg:mb-0">
                            <img src="https://via.placeholder.com/80x80" alt="Kost" class="w-20 h-20 rounded-lg object-cover">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Kost Harmoni Residence</h3>
                                <p class="text-gray-600">Jl. Sudirman No. 123, Jakarta Pusat</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="fas fa-check-circle mr-1"></i>Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-blue-600">Rp 2.500.000</p>
                            <p class="text-gray-600">per bulan</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Tanggal Mulai</p>
                            <p class="font-semibold">15 Januari 2024</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Tanggal Berakhir</p>
                            <p class="font-semibold">15 Juli 2024</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Sisa Waktu</p>
                            <p class="font-semibold text-green-600">3 bulan 12 hari</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-credit-card mr-2"></i>Perpanjang Sewa
                        </button>
                        <button class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-download mr-2"></i>Unduh Kontrak
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pending Booking -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                        <div class="flex items-center gap-4 mb-4 lg:mb-0">
                            <img src="https://via.placeholder.com/80x80" alt="Kost" class="w-20 h-20 rounded-lg object-cover">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Kost Melati Indah</h3>
                                <p class="text-gray-600">Jl. Kebon Jeruk No. 45, Jakarta Barat</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="fas fa-clock mr-1"></i>Menunggu Konfirmasi
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-blue-600">Rp 1.800.000</p>
                            <p class="text-gray-600">per bulan</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Tanggal Pemesanan</p>
                            <p class="font-semibold">10 April 2024</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Rencana Mulai</p>
                            <p class="font-semibold">1 Mei 2024</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Durasi Sewa</p>
                            <p class="font-semibold">6 bulan</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </button>
                        <button class="border border-red-300 text-red-700 px-4 py-2 rounded-lg hover:bg-red-50 transition-colors">
                            <i class="fas fa-times mr-2"></i>Batalkan Pesanan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Completed Booking -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                        <div class="flex items-center gap-4 mb-4 lg:mb-0">
                            <img src="https://via.placeholder.com/80x80" alt="Kost" class="w-20 h-20 rounded-lg object-cover">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Kost Anggrek Putih</h3>
                                <p class="text-gray-600">Jl. Gatot Subroto No. 67, Jakarta Selatan</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                        <i class="fas fa-flag-checkered mr-1"></i>Selesai
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-gray-600">Rp 2.200.000</p>
                            <p class="text-gray-600">per bulan</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Periode Sewa</p>
                            <p class="font-semibold">Jan 2023 - Dec 2023</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Total Pembayaran</p>
                            <p class="font-semibold">Rp 26.400.000</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Rating Diberikan</p>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400 mr-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="font-semibold">5.0</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </button>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-redo mr-2"></i>Pesan Lagi
                        </button>
                        <button class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-download mr-2"></i>Unduh Riwayat
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (jika tidak ada data) -->
        <!-- <div class="text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Riwayat Pemesanan</h3>
            <p class="text-gray-500 mb-6">Mulai cari kost impian Anda sekarang!</p>
            <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-search mr-2"></i>Cari Kost
            </a>
        </div> -->
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h4 class="text-xl font-bold mb-2">Kost Hero</h4>
                <p class="text-gray-400">Platform terpercaya untuk menemukan kost terbaik</p>
            </div>
        </div>
    </footer>
</body>
</html>