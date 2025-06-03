// Simpan state filter di URL tanpa reload halaman
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const params = new URLSearchParams(formData).toString();
    
    // Update URL tanpa reload
    history.pushState(null, '', 'riwayat.php?' + params);
    
    // Submit form secara manual
    this.submit();
});