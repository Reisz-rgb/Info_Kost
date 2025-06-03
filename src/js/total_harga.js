document.addEventListener("DOMContentLoaded", function () {
    const durasiSelect = document.getElementById("durasiSewa");
    const hargaPerBulan = parseInt(document.getElementById("hargaPerBulan").value);
    const totalHargaElem = document.getElementById("totalHarga");

    durasiSelect.addEventListener("change", function () {
        const durasi = parseInt(durasiSelect.value);
        const totalHarga = durasi * hargaPerBulan;
        totalHargaElem.textContent = "Rp " + totalHarga.toLocaleString("id-ID");
    });
});

function openModal() {
    // Validasi form sebelum buka modal
    const form = document.getElementById('sewaForm');
    const checkin = form.elements['checkin'].value;
    const durasi = form.elements['durasi'].value;
    
    if (!checkin || !durasi) {
        alert('Harap isi tanggal check-in dan durasi sewa terlebih dahulu');
        return;
    }
    
    document.getElementById('paymentModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('paymentModal').classList.add('hidden');
}

document.getElementById("paymentForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    // Ambil metode
    const metode = document.querySelector('input[name="metode_pembayaran"]:checked').value;

    // Tambahkan hidden input ke form utama
    const formUtama = document.querySelector('form[action="ajukan_sewa.php"]');
    let input = document.createElement("input");
    input.type = "hidden";
    input.name = "metode_pembayaran";
    input.value = metode;
    formUtama.appendChild(input);

    // Submit form utama
    formUtama.submit();
});

