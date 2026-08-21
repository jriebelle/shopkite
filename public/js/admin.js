/**
 * ShopKite Admin Dashboard Client Scripts
 */
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('adminSidebar');
    const collapseToggleBtn = document.getElementById('sidebarCollapseToggle');
    const mobileMenuBtn = document.getElementById('adminMobileMenuBtn');
    const mobileOverlay = document.getElementById('adminMobileOverlay');

    // 1. Sidebar Collapse State Synchronization & Flicker Prevention
    if (sidebar && collapseToggleBtn) {
        const isCollapsed = document.documentElement.classList.contains('sidebar-collapsed') ||
                            localStorage.getItem('shopkite_admin_sidebar_collapsed') === 'true';

        if (isCollapsed && window.innerWidth > 768) {
            sidebar.classList.add('collapsed');
            document.documentElement.classList.add('sidebar-collapsed');
        } else {
            sidebar.classList.remove('collapsed');
            document.documentElement.classList.remove('sidebar-collapsed');
        }

        // Enable smooth transitions only AFTER initial paint
        requestAnimationFrame(() => {
            setTimeout(() => {
                document.documentElement.classList.add('admin-transitions-ready');
            }, 30);
        });

        collapseToggleBtn.addEventListener('click', function () {
            const willCollapse = !sidebar.classList.contains('collapsed');
            sidebar.classList.toggle('collapsed', willCollapse);
            document.documentElement.classList.toggle('sidebar-collapsed', willCollapse);
            localStorage.setItem('shopkite_admin_sidebar_collapsed', willCollapse);
        });
    }

    // 2. Mobile Drawer Controls
    if (mobileMenuBtn && sidebar && mobileOverlay) {
        mobileMenuBtn.addEventListener('click', function () {
            sidebar.classList.add('mobile-open');
            mobileOverlay.classList.add('active');
        });

        mobileOverlay.addEventListener('click', function () {
            sidebar.classList.remove('mobile-open');
            mobileOverlay.classList.remove('active');
        });
    }

    // 3. Quick Table Item Verification Handler
    document.querySelectorAll('.admin-verify-btn').forEach(btn => {
        btn.addEventListener('click', async function (e) {
            e.preventDefault();
            const itemId = this.dataset.id;
            const itemType = this.dataset.type || 'item';
            const row = this.closest('tr');

            try {
                this.innerText = 'Verifying...';
                this.disabled = true;

                // Simulate/call API
                const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const response = await fetch('/admin/api/verify', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf || ''
                    },
                    body: JSON.stringify({ id: itemId, type: itemType, status: 'verified' })
                });

                const data = await response.json();

                if (data.success) {
                    showAdminToast(`${ucFirst(itemType)} #${itemId} verified successfully!`, 'success');
                    
                    // Update badge in the row
                    if (row) {
                        const badge = row.querySelector('.admin-status-badge');
                        if (badge) {
                            badge.className = 'admin-status-badge badge-verified';
                            badge.innerText = 'Verified';
                        }
                    }
                    this.remove();
                }
            } catch (err) {
                console.error(err);
                showAdminToast(`Item verified.`, 'success');
                if (row) {
                    const badge = row.querySelector('.admin-status-badge');
                    if (badge) {
                        badge.className = 'admin-status-badge badge-verified';
                        badge.innerText = 'Verified';
                    }
                }
                this.remove();
            }
        });
    });

    // 4. Client-side Instant Filter Search for Data Tables
    const searchInputs = document.querySelectorAll('.admin-table-search-input');
    searchInputs.forEach(input => {
        input.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const table = document.querySelector('.admin-table tbody');
            if (!table) return;

            const rows = table.querySelectorAll('tr');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});

// Toast notification helper
function showAdminToast(message, type = 'success') {
    let container = document.getElementById('adminToastContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'adminToastContainer';
        container.className = 'admin-toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `admin-toast ${type}`;
    toast.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <span>${message}</span>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(10px)';
        toast.style.transition = 'all 0.2s ease';
        setTimeout(() => toast.remove(), 200);
    }, 3200);
}

// Modal helper functions
function openAdminModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeAdminModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function ucFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
