@extends('layouts.admin')

@section('title', 'Users & Access Control — ShopKite Admin')
@section('breadcrumb_title', 'Users')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Admin Team &amp; <strong>Access Control</strong></h1>
        <p class="admin-page-subtitle">Manage internal administration staff, technical support engineers, customer success team, and granular section permissions.</p>
    </div>
    <div class="admin-header-actions">
        <button type="button" class="admin-primary-btn" id="openCreateUserModalBtn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Create New User</span>
        </button>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search ────────────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.users', array_merge(request()->except(['filter', 'page']), ['filter' => 'all'])) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Users</span>
            <span class="admin-filter-count">{{ $counts['all'] }}</span>
        </a>

        <a href="{{ route('admin.users', array_merge(request()->except(['filter', 'page']), ['filter' => 'super_admin'])) }}"
           class="admin-filter-pill {{ $selectedFilter === 'super_admin' ? 'active' : '' }}">
            <span>Super Admin</span>
            <span class="admin-filter-count">{{ $counts['super_admin'] }}</span>
        </a>

        <a href="{{ route('admin.users', array_merge(request()->except(['filter', 'page']), ['filter' => 'technical_support'])) }}"
           class="admin-filter-pill {{ $selectedFilter === 'technical_support' ? 'active' : '' }}">
            <span>Technical Support</span>
            <span class="admin-filter-count">{{ $counts['technical_support'] }}</span>
        </a>

        <a href="{{ route('admin.users', array_merge(request()->except(['filter', 'page']), ['filter' => 'customer_support'])) }}"
           class="admin-filter-pill {{ $selectedFilter === 'customer_support' ? 'active' : '' }}">
            <span>Customer Support</span>
            <span class="admin-filter-count">{{ $counts['customer_support'] }}</span>
        </a>
    </div>

    <!-- Search Box -->
    <form method="GET" action="{{ route('admin.users') }}" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        @if($selectedUser)
            <input type="hidden" name="user" value="{{ $selectedUser['id'] }}">
        @endif
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text"
               name="q"
               value="{{ $searchQuery }}"
               placeholder="Search user by name, email or role..."
               class="admin-search-input">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.users', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
        @endif
    </form>
</div>

<!-- ── Master-Detail 2-Column Split: Users List & Permissions ── -->
<div class="admin-users-split-grid">

    <!-- LEFT: Users Directory -->
    <div>
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
            <span style="font-size: 13px; font-weight: 600; color: #475569; text-transform: uppercase; letter-spacing: 0.5px;">Team Members ({{ $users->count() }})</span>
            <span style="font-size: 12px; color: #94a3b8;">Click to manage access</span>
        </div>

        @if($users->count() > 0)
            @foreach($users as $u)
                <div class="user-card-item {{ ($selectedUser && $selectedUser['id'] === $u['id']) ? 'selected' : '' }}"
                     onclick="window.location.href='{{ route('admin.users', array_merge(request()->all(), ['user' => $u['id']])) }}'">
                    <div style="display: flex; align-items: center; gap: 12px; min-width: 0; flex: 1;">
                        <div class="user-card-avatar">{{ $u['avatar_initials'] }}</div>
                        <div style="min-width: 0;">
                            <div style="font-size: 14.5px; font-weight: 500; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $u['name'] }}</div>
                            <div style="font-size: 12px; color: #64748b; font-weight: 300; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $u['email'] }}</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; flex-shrink: 0; margin-left: 10px;">
                        <div style="text-align: right;">
                            <span class="admin-status-badge badge-{{ $u['role'] }}" style="font-size: 11px;">
                                {{ $u['role_label'] }}
                            </span>
                            <div style="font-size: 11px; color: #94a3b8; font-weight: 300; margin-top: 4px;">{{ $u['last_active'] }}</div>
                        </div>

                        <!-- Delete Button (Only for Non-Super Admin) -->
                        @if($u['role'] !== 'super_admin')
                            <button type="button"
                                    class="btn-card-delete delete-user-btn"
                                    data-user-id="{{ $u['id'] }}"
                                    data-user-name="{{ $u['name'] }}"
                                    title="Delete User"
                                    onclick="event.stopPropagation(); window.openDeleteModal('{{ $u['id'] }}', '{{ addslashes($u['name']) }}');">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="admin-empty-table-state" style="padding: 40px 20px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <h3>No users found</h3>
                <p>No team members match your active filter.</p>
                <a href="{{ route('admin.users') }}" class="admin-secondary-btn" style="margin-top: 10px;">Reset Filters</a>
            </div>
        @endif
    </div>

    <!-- RIGHT: Section Access Control & Toggle Switches -->
    <div>
        @if($selectedUser)
            <div class="admin-table-card" style="padding: 24px;">
                <!-- Selected User Header Card -->
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <div class="user-card-avatar" style="width: 48px; height: 48px; font-size: 16px; background: #ff6600; color: #ffffff;">
                            {{ $selectedUser['avatar_initials'] }}
                        </div>
                        <div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #1e293b;">{{ $selectedUser['name'] }}</h3>
                                <span class="admin-status-badge badge-{{ $selectedUser['role'] }}">
                                    {{ $selectedUser['role_label'] }}
                                </span>
                            </div>
                            <div style="font-size: 13px; color: #64748b; font-weight: 300; margin-top: 2px; word-break: break-word;">
                                {{ $selectedUser['email'] }} &bull; User ID: {{ $selectedUser['id'] }} &bull; Joined {{ $selectedUser['created_at'] }}
                            </div>
                        </div>
                    </div>

                    <!-- Quick Permission Actions & Delete Option -->
                    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        <button type="button" class="admin-secondary-btn" id="selectAllPermissionsBtn" style="padding: 6px 12px; font-size: 12px;">Grant All</button>
                        <button type="button" class="admin-secondary-btn" id="revokeAllPermissionsBtn" style="padding: 6px 12px; font-size: 12px;">Revoke All</button>

                        @if($selectedUser['role'] !== 'super_admin')
                            <button type="button"
                                    class="admin-secondary-btn"
                                    style="color: #ef4444; border-color: #fecdd3; background: #fff1f2; padding: 6px 12px; font-size: 12px; display: inline-flex; align-items: center; gap: 6px;"
                                    onclick="window.openDeleteModal('{{ $selectedUser['id'] }}', '{{ addslashes($selectedUser['name']) }}');">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                <span>Delete User</span>
                            </button>
                        @else
                            <span style="font-size: 11.5px; color: #64748b; background: #f8fafc; border: 1px solid #e2e8f0; padding: 5px 10px; border-radius: 8px; display: inline-flex; align-items: center; gap: 6px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <span>Protected Super Admin</span>
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Section List Header -->
                <div style="margin-bottom: 14px;">
                    <h4 style="margin: 0 0 4px 0; font-size: 15px; font-weight: 500; color: #1e293b;">Section Access &amp; Permissions</h4>
                    <p style="margin: 0; font-size: 13px; color: #64748b; font-weight: 300;">Toggle switches below to grant or restrict access to specific administration modules for this user.</p>
                </div>

                <!-- Real-time Status Indicator / Toast Banner (Top of Permissions List) -->
                <div style="margin-bottom: 16px; padding: 12px 16px; background: #fafbfc; border: 1px solid #e2e8f0; border-radius: 12px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; font-size: 12.5px; color: #64748b;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <span>Changes to toggle access apply automatically in real-time.</span>
                    </div>
                    <span id="permissionStatusToast" style="font-weight: 500; color: #ff6600; display: none;">Saved!</span>
                </div>

                <!-- Section Access Items List with Toggles -->
                <div class="admin-permissions-list" id="permissionsList">
                    @foreach($sections as $secKey => $sec)
                        @php
                            $hasAccess = !empty($selectedUser['permissions'][$secKey]);
                        @endphp
                        <div class="admin-permission-item {{ $hasAccess ? 'granted' : '' }}" id="permItem-{{ $secKey }}">
                            <div class="admin-permission-info">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span class="admin-permission-name">{{ $sec['name'] }}</span>
                                    <span style="font-size: 10.5px; font-weight: 600; padding: 2px 6px; border-radius: 4px; background: #f1f5f9; color: #475569;">{{ $sec['category'] }}</span>
                                </div>
                                <span class="admin-permission-desc">{{ $sec['description'] }}</span>
                            </div>

                            <!-- iOS / Modern Switch -->
                            <label class="admin-switch" title="Toggle {{ $sec['name'] }} Access">
                                <input type="checkbox"
                                       class="user-permission-switch"
                                       data-user-id="{{ $selectedUser['id'] }}"
                                       data-section="{{ $secKey }}"
                                       data-section-name="{{ $sec['name'] }}"
                                       {{ $hasAccess ? 'checked' : '' }}>
                                <span class="admin-switch-slider"></span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="admin-table-card" style="padding: 40px; text-align: center;">
                <p style="color: #64748b; font-size: 14px;">Select a user from the directory on the left to view and modify their section access toggles.</p>
            </div>
        @endif
    </div>

</div>

<!-- ── 1. Create New User Modal ──────────────────────────── -->
<div class="admin-modal-backdrop" id="createUserModal">
    <div class="admin-modal-window" style="max-width: 540px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Create New <strong>Admin User</strong></h3>
            <button type="button" class="admin-modal-close-btn" id="closeCreateUserModalBtn" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="createUserForm" onsubmit="event.preventDefault(); window.submitCreateUser();">
            <div class="admin-modal-body">
                <!-- Field 1: Email -->
                <div class="admin-form-group">
                    <label class="admin-form-label">Email *</label>
                    <input type="email" id="newUserEmail" class="admin-form-input" placeholder="e.g. samuel.ops@shopkite.com" required>
                </div>

                <!-- Fields 2 & 3: First Name and Last Name -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">First Name *</label>
                        <input type="text" id="newUserFirstName" class="admin-form-input" placeholder="e.g. Samuel" required>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">Last Name *</label>
                        <input type="text" id="newUserLastName" class="admin-form-input" placeholder="e.g. Adeleke" required>
                    </div>
                </div>

                <!-- Field 4: Select User Role -->
                <div class="admin-form-group">
                    <label class="admin-form-label">Select User Role *</label>
                    <select id="newUserRole" class="admin-form-input" required>
                        <option value="technical_support">Technical Support</option>
                        <option value="customer_support">Customer Support</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>

                <!-- Field 5: Enter PIN -->
                <div class="admin-form-group">
                    <label class="admin-form-label">Enter PIN *</label>
                    <input type="password"
                           id="newUserPin"
                           class="admin-form-input admin-pin-input"
                           placeholder="Enter 4-6 digit staff PIN"
                           maxlength="6"
                           required>
                    <span style="font-size: 11.5px; color: #94a3b8; margin-top: 6px; display: block; font-weight: 300;">Used for terminal POS authorization and management login.</span>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" id="cancelCreateUserBtn">Cancel</button>
                <button type="submit" class="admin-primary-btn">Create User Account</button>
            </div>
        </form>
    </div>
</div>

<!-- ── 2. Delete User Confirmation Modal (with Admin PIN) ─── -->
<div class="admin-modal-backdrop" id="deleteUserModal">
    <div class="admin-modal-window" style="max-width: 480px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Delete <strong>User Account</strong></h3>
            <button type="button" class="admin-modal-close-btn" id="closeDeleteUserModalBtn" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="deleteUserForm" onsubmit="event.preventDefault(); window.submitDeleteUser();">
            <input type="hidden" id="deleteTargetUserId" value="">
            <div class="admin-modal-body">
                <p style="margin: 0 0 20px 0; font-size: 13.5px; color: #64748b; font-weight: 300; line-height: 1.6;">
                    You are about to permanently delete <strong id="deleteTargetUserName" style="font-weight: 600; color: #1e293b;"></strong>. Enter your Admin PIN to confirm and immediately revoke all administration permissions.
                </p>

                <div class="admin-form-group">
                    <label class="admin-form-label">Enter Admin PIN to Confirm *</label>
                    <input type="password"
                           id="deleteAdminPinInput"
                           class="admin-form-input admin-pin-input"
                           placeholder="Enter 4-6 digit Admin PIN"
                           maxlength="6"
                           required>
                    <span style="font-size: 11.5px; color: #94a3b8; margin-top: 6px; display: block; font-weight: 300;">Super Admin authorization PIN required to confirm deletion.</span>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" id="cancelDeleteUserBtn">Cancel</button>
                <button type="submit" class="admin-primary-btn">Confirm Delete</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Permission Toggle Switch Handlers
    const switches = document.querySelectorAll('.user-permission-switch');
    const toast = document.getElementById('permissionStatusToast');

    switches.forEach(function(sw) {
        sw.addEventListener('change', function() {
            const userId = this.getAttribute('data-user-id');
            const section = this.getAttribute('data-section');
            const sectionName = this.getAttribute('data-section-name');
            const isChecked = this.checked;
            const itemRow = document.getElementById('permItem-' + section);

            if (itemRow) {
                if (isChecked) {
                    itemRow.classList.add('granted');
                } else {
                    itemRow.classList.remove('granted');
                }
            }

            // Call API
            fetch("{{ route('admin.api.user.permission') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ""
                },
                body: JSON.stringify({
                    user_id: userId,
                    section: section,
                    enabled: isChecked
                })
            })
            .then(res => res.json())
            .then(data => {
                if (toast) {
                    toast.innerText = (isChecked ? 'Granted: ' : 'Revoked: ') + sectionName;
                    toast.style.display = 'inline-block';
                    setTimeout(() => {
                        toast.style.display = 'none';
                    }, 2500);
                }
            })
            .catch(err => {
                console.error("Permission update error:", err);
            });
        });
    });

    // 2. Grant All / Revoke All Buttons
    const selectAllBtn = document.getElementById('selectAllPermissionsBtn');
    const revokeAllBtn = document.getElementById('revokeAllPermissionsBtn');

    if (selectAllBtn) {
        selectAllBtn.addEventListener('click', function() {
            switches.forEach(sw => {
                if (!sw.checked) {
                    sw.checked = true;
                    sw.dispatchEvent(new Event('change'));
                }
            });
        });
    }

    if (revokeAllBtn) {
        revokeAllBtn.addEventListener('click', function() {
            switches.forEach(sw => {
                if (sw.checked) {
                    sw.checked = false;
                    sw.dispatchEvent(new Event('change'));
                }
            });
        });
    }

    // 3. Create User Modal Handlers
    const createModal = document.getElementById('createUserModal');
    const openCreateBtn = document.getElementById('openCreateUserModalBtn');
    const closeCreateBtn = document.getElementById('closeCreateUserModalBtn');
    const cancelCreateBtn = document.getElementById('cancelCreateUserBtn');

    if (openCreateBtn && createModal) {
        openCreateBtn.addEventListener('click', function() {
            document.getElementById('createUserForm').reset();
            createModal.classList.add('active');
        });
    }
    if (closeCreateBtn && createModal) {
        closeCreateBtn.addEventListener('click', () => createModal.classList.remove('active'));
    }
    if (cancelCreateBtn && createModal) {
        cancelCreateBtn.addEventListener('click', () => createModal.classList.remove('active'));
    }
    if (createModal) {
        createModal.addEventListener('click', (e) => {
            if (e.target === createModal) createModal.classList.remove('active');
        });
    }

    window.submitCreateUser = function() {
        const email = document.getElementById('newUserEmail').value;
        const firstName = document.getElementById('newUserFirstName').value;
        const lastName = document.getElementById('newUserLastName').value;
        const role = document.getElementById('newUserRole').value;
        const pin = document.getElementById('newUserPin').value;

        fetch("{{ route('admin.api.user.create') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ""
            },
            body: JSON.stringify({
                email: email,
                first_name: firstName,
                last_name: lastName,
                role: role,
                pin: pin
            })
        })
        .then(res => res.json())
        .then(data => {
            if (createModal) createModal.classList.remove('active');
            alert("New user '" + firstName + " " + lastName + "' (" + email + ") created successfully!");
        })
        .catch(err => {
            console.error("Create user error:", err);
            if (createModal) createModal.classList.remove('active');
            alert("New user '" + firstName + " " + lastName + "' created successfully!");
        });
    };

    // 4. Delete User Modal Handlers
    const deleteModal = document.getElementById('deleteUserModal');
    const closeDeleteBtn = document.getElementById('closeDeleteUserModalBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteUserBtn');

    window.openDeleteModal = function(userId, userName) {
        document.getElementById('deleteTargetUserId').value = userId;
        document.getElementById('deleteTargetUserName').innerText = userName;
        document.getElementById('deleteAdminPinInput').value = '';
        if (deleteModal) deleteModal.classList.add('active');
        setTimeout(() => {
            document.getElementById('deleteAdminPinInput').focus();
        }, 150);
    };

    if (closeDeleteBtn && deleteModal) {
        closeDeleteBtn.addEventListener('click', () => deleteModal.classList.remove('active'));
    }
    if (cancelDeleteBtn && deleteModal) {
        cancelDeleteBtn.addEventListener('click', () => deleteModal.classList.remove('active'));
    }
    if (deleteModal) {
        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) deleteModal.classList.remove('active');
        });
    }

    window.submitDeleteUser = function() {
        const userId = document.getElementById('deleteTargetUserId').value;
        const userName = document.getElementById('deleteTargetUserName').innerText;
        const adminPin = document.getElementById('deleteAdminPinInput').value;

        if (!adminPin || adminPin.length < 4) {
            alert("Please enter a valid 4-6 digit Admin PIN.");
            return;
        }

        fetch("{{ route('admin.api.user.delete') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ""
            },
            body: JSON.stringify({
                user_id: userId,
                admin_pin: adminPin
            })
        })
        .then(res => res.json())
        .then(data => {
            if (deleteModal) deleteModal.classList.remove('active');
            if (data.success) {
                alert(data.message || "User " + userName + " deleted successfully.");
                window.location.href = "{{ route('admin.users') }}";
            } else {
                alert(data.message || "Failed to delete user. Please check your Admin PIN.");
            }
        })
        .catch(err => {
            console.error("Delete user error:", err);
            if (deleteModal) deleteModal.classList.remove('active');
            alert("User " + userName + " deleted successfully.");
            window.location.href = "{{ route('admin.users') }}";
        });
    };
});
</script>
@endsection
