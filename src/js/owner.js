document.getElementById('toggleNav').addEventListener('click', function() {
            const mobileNav = document.getElementById('mobileNav');
            if (mobileNav.style.left === '0px') {
                mobileNav.style.left = '-100%';
            } else {
                mobileNav.style.left = '0px';
            }
        });