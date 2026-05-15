@extends('layouts.app')

@section('title', 'Settings - Mini Social')

@section('content')
<div class="container mt-4 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="glass-card animate__animated animate__fadeIn">
                <div class="card-body p-5">
                    <h3 class="card-title mb-4 glow-text">Settings</h3>
                    
                    <div class="glass-card p-4 mb-4">
                        <h5 class="mb-3"><i class="bi bi-bell me-2"></i>Notification Settings</h5>
                        <select class="form-select mb-3" id="notification-settings">
                            <option value="all" selected>All notifications</option>
                            <option value="mentions">Mentions only</option>
                            <option value="none">No notifications</option>
                        </select>
                    </div>
                    
                    <div class="glass-card p-4 mb-4">
                        <h5 class="mb-3"><i class="bi bi-palette me-2"></i>Appearance</h5>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="darkModeToggle" checked>
                            <label class="form-check-label" for="darkModeToggle">Enable dark mode</label>
                        </div>
                    </div>
                    
                    <div class="glass-card p-4 mb-4">
                        <h5 class="mb-3"><i class="bi bi-shield me-2"></i>Privacy</h5>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="privateAccount">
                            <label class="form-check-label" for="privateAccount">Private account</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="activityStatus" checked>
                            <label class="form-check-label" for="activityStatus">Show activity status</label>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button class="neo-btn" id="save-settings">Save changes</button>
                        <button class="neo-btn" id="reset-settings" style="background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));">Restore default settings</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Save settings
    document.getElementById('save-settings').addEventListener('click', function() {
        const notificationSettings = document.getElementById('notification-settings').value;
        const darkMode = document.getElementById('darkModeToggle').checked;
        const privateAccount = document.getElementById('privateAccount').checked;
        const activityStatus = document.getElementById('activityStatus').checked;
        
        alert('Settings saved successfully!');
        console.log('Saved settings:', {
            notificationSettings,
            darkMode,
            privateAccount,
            activityStatus
        });
    });

    // Restore default settings
    document.getElementById('reset-settings').addEventListener('click', function() {
        if (confirm('Do you want to restore the default settings?')) {
            document.getElementById('notification-settings').value = 'all';
            document.getElementById('darkModeToggle').checked = true;
            document.getElementById('privateAccount').checked = false;
            document.getElementById('activityStatus').checked = true;
            alert('Default settings restored.');
        }
    });

    // Enable/Disable dark mode
    document.getElementById('darkModeToggle').addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('dark');
            alert('Dark mode enabled.');
        } else {
            document.body.classList.remove('dark');
            alert('Dark mode disabled.');
        }
    });
});
</script>
@endsection