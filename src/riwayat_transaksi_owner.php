<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi Pemesanan Kos - Pemilik Kos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Kost Hero - Pemilik Kos</a>
        </div>
    </nav>
    <div class="container">
        <h2 class="mb-4">Riwayat Transaksi Pemesanan Kos</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Penyewa</th>
                    <th>Nama Kos</th>
                    <th>Tanggal Pesan</th>
                    <th>Durasi Sewa</th>
                    <th>Total Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <!-- ini harus dihubungkan ke backend -->
                <tr>
                    <td>1</td>
                    <td>Andi Wijaya</td>
                    <td>Kos Mawar Indah</td>
                    <td>2024-06-01</td>
                    <td>6 bulan</td>
                    <td>Rp3.000.000</td>
                    <td><span class="badge bg-success">Lunas</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Siti Rahma</td>
                    <td>Kos Melati Asri</td>
                    <td>2024-05-20</td>
                    <td>12 bulan</td>
                    <td>Rp6.000.000</td>
                    <td><span class="badge bg-warning text-dark">Menunggu Pembayaran</span></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Budi Santoso</td>
                    <td>Kos Mawar Indah</td>
                    <td>2024-04-15</td>
                    <td>6 bulan</td>
                    <td>Rp1.500.000</td>
                    <td><span class="badge bg-danger">Dibatalkan</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>