<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"
    integrity="sha512-NcZdtrT77bJr4STcmsGAESr06BYGE8woZdSdEgqnpyqac7sugNO+Tr4bGwGF3MsnEkGKhU2KL2xh6Ec+BqsaHA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script>
    function openPopupSupport() {
        const overlay = document.getElementById('popupOverlaySupport');
        const navDropdown = document.getElementById('nav-dropdown');
        const menuBtn = document.getElementById('menu-btn');
        
        if (navDropdown && menuBtn) {
            navDropdown.classList.remove('open');
            menuBtn.classList.remove('open');
        }
        
        if (overlay) {
            overlay.style.display = 'flex';
            requestAnimationFrame(() => {
                overlay.classList.add('active');
            });
            document.body.style.overflow = 'hidden';
        }
    }

    function closePopupSupport() {
        const overlay = document.getElementById('popupOverlaySupport');
        if (overlay) {
            overlay.classList.remove('active');
            setTimeout(() => {
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }, 250);
        }
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closePopupSupport();
        }
    });
</script>
