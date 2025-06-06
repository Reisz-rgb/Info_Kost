<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Masuk Sebagai</title>
</head>
<body class="flex items-center justify-center h-screen">
    <div class="fixed inset-0 -z-10">
        <img src="assets/img/bg/km4.png" alt="Kost Hero Logo" class="w-full h-full object-cover">
    </div>

    <button onclick="window.history.back()" class="fixed top-6 left-6 z-10 bg-opacity-90 rounded-full p-2 shadow hover:bg-opacity-100 transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl cursor-pointer">
            <img src="assets/img/icons/back.png" alt="Back" class="h-6 w-6">
    </button>

    <div class="fixed inset-0 bg-black opacity-20"></div>

    
    <div class="bg-white bg-opacity-95 shadow-lg p-8 w-96 rounded-xl transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl">
        <h2 class="text-xl font-bold mb-5 text-center drop-shadow-lg text-green-900">Masuk Sebagai</h2>

        <div onclick="redirectToLogin()" class="bg-gray-200 rounded-lg p-4 mb-4 flex items-center transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl cursor-pointer">
            <img src="assets/img/bg/loginPenyewa.png" alt="Pencari Kost" class="h-16 mr-4">
            <span class="font-bold drop-shadow-lg">Pencari Kost</span>
        </div>

        <div onclick="redirectToLogin()" class="bg-gray-200 rounded-lg p-4 mb-4 flex items-center transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl cursor-pointer">
            <img src="assets/img/bg/loginOwner.png" alt="Pemilik Kost" class="h-16 mr-4">
            <span class="font-bold drop-shadow-lg">Pemilik Kost</span>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>
