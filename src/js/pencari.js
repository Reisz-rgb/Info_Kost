function createStarRating(rating, maxStars = 5) {
  const container = document.querySelector('.star-rating');
  
  for (let i = 1; i <= maxStars; i++) {
    const svg = document.createElement('svg');
    svg.className = `w-4 h-4 fill-current ${i <= rating ? 'text-yellow-400' : 'text-gray-300'}`;
    svg.setAttribute('viewBox', '0 0 20 20');
    svg.innerHTML = '<path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>';
    container.appendChild(svg);
  }
}

function historyBack() {
    window.location.href = document.referrer;
}


function removeFavorite(button) {
            const item = button.closest('.bg-white');
            item.remove();
        }

function redirectToSearch() {
    const searchInput = document.querySelector('input[type="search"]');
    if (searchInput) {
        const query = searchInput.value.trim();
        if (query) {
            window.location.href = `search.php?query=${encodeURIComponent(query)}`;
        } else {
            alert("Please enter a search term.");
        }
    }
}
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('accountBtn').addEventListener('click', function() {
        const dropdown = document.getElementById('accountDropdown');
            dropdown.classList.toggle('hidden');
    });
                
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const accountBtn = document.getElementById('accountBtn');
        const dropdown = document.getElementById('accountDropdown');
        if (!accountBtn.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
});


document.getElementById('favoriteBtn').addEventListener('click', function() {
    const icon = document.getElementById('favoriteIcon');
    const currentFavorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const productId = 'kost-aresta'; // ID unik untuk produk ini
 
// //tugas backend untuk sambunngin ke databae
//     if (icon.classList.contains('far')) {
//     // Tambah ke favorit
//     icon.classList.remove('far');
//     icon.classList.add('fas');
//     currentFavorites.push({
//     id: productId,
//     name: 'Kost Aresta',
//     price: 'Rp 100.000',
//     location: 'Jl. Sudirman No. 123, Jakarta Pusat',
//     image: 'assets/img/bg/km2.png'
//     });
//     localStorage.setItem('favorites', JSON.stringify(currentFavorites));
//     } else {
//     // Hapus dari favorit
//     icon.classList.remove('fas');
//     icon.classList.add('far');
//     const updatedFavorites = currentFavorites.filter(item => item.id !== productId);
//     localStorage.setItem('favorites', JSON.stringify(updatedFavorites));
//     }
//     });
                        
//     // Cek status favorit saat halaman dimuat
//     document.addEventListener('DOMContentLoaded', function() {
//     const currentFavorites = JSON.parse(localStorage.getItem('favorites') || '[]');
//     const productId = 'kost-aresta';
//     const icon = document.getElementById('favoriteIcon');
                            
//     if (currentFavorites.some(item => item.id === productId)) {
//         icon.classList.remove('far');
//         icon.classList.add('fas');
//     }
 });
        