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

    <form class="space-y-5">
      <!-- Nama dan Gender -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">Nama Lengkap</label>
          <input type="text" class="mt-1 w-full p-2 border border-gray-300 rounded"/>
        </div>
        <div>
          <label class="block text-sm font-medium">Jenis Kelamin</label>
          <input type="text" class="mt-1 w-full p-2 border border-gray-300 rounded"/>
        </div>
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email"
               class="mt-1 w-full p-2 border border-gray-300 rounded"/>
      </div>

      <!-- Alamat -->
      <div>
        <label class="block text-sm font-medium">Alamat</label>
        <input type="text"
               class="mt-1 w-full p-2 border border-gray-300 rounded"/>
      </div>

      <!-- Tanggal Lahir -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">Tanggal Lahir</label>
            <input type="date" class="mt-1 w-full p-2 border border-gray-300 rounded"/>
          </select>
        </div>
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password"
               class="mt-1 w-full p-2 border border-gray-300 rounded"/>
      </div>

      <!-- Tombol -->
      <div class="flex justify-end gap-3 pt-4">
        <button type="button" class="px-4 py-2 border border-orange-500 text-orange-500 rounded hover:bg-orange-50">
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