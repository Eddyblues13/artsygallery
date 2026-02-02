@include('dashboard.header')

<style>
/* Modern Settings Styles */
.settings-card {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    border-radius: 12px;
    overflow: hidden;
    height: 100%;
    transition: transform 0.2s ease-in-out;
}

.settings-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
}

.settings-header {
    background: linear-gradient(135deg, #3b7ddd 0%, #2a5298 100%);
    padding: 1.5rem;
    color: white;
    border-bottom: 0;
}

.settings-title {
    font-weight: 600;
    font-size: 1.25rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.settings-body {
    padding: 2rem;
}

.form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
}

.form-control-lg {
    font-size: 1rem;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    border: 1px solid #ced4da;
    background-color: #f8f9fa;
    transition: all 0.2s ease;
}

.form-control-lg:focus {
    background-color: #fff;
    border-color: #3b7ddd;
    box-shadow: 0 0 0 4px rgba(59, 125, 221, 0.1);
}

.accordion-button:not(.collapsed) {
    color: #3b7ddd;
    background-color: rgba(59, 125, 221, 0.05);
}

.btn-primary-soft {
    color: #3b7ddd;
    background-color: rgba(59, 125, 221, 0.1);
    border: none;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-primary-soft:hover {
    background-color: #3b7ddd;
    color: white;
    transform: translateY(-1px);
}

/* Subtle Divider */
.section-divider {
    height: 1px;
    background-color: #f0f2f5;
    margin: 2rem 0;
}
</style>

<main class="content">
    <div class="container-fluid p-0">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Account Settings</h1>
            <div class="text-muted">Manage your personal information and security</div>
        </div>

        @include('dashboard.alert')

        <div class="row g-4">
            <!-- Global Profile Information -->
            <div class="col-12 col-lg-6">
                <div class="card settings-card">
                    <div class="settings-header">
                        <div class="settings-title">
                            <i data-feather="user" style="width: 24px; height: 24px;"></i> Personal Information
                        </div>
                    </div>
                    <div class="settings-body">
                        <form action="{{ route('update.profile') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                           name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+1 234 567 8900">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control form-control-lg @error('country') is-invalid @enderror" 
                                           name="country" value="{{ old('country', $user->country) }}" placeholder="United States">
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control form-control-lg @error('address') is-invalid @enderror" 
                                              name="address" rows="2" placeholder="Street address, apartment, suite, etc.">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="align-middle me-2" data-feather="save"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Security Settings -->
            <div class="col-12 col-lg-6">
                <div class="card settings-card">
                    <div class="settings-header" style="background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);">
                        <div class="settings-title">
                            <i data-feather="shield" style="width: 24px; height: 24px;"></i> Security Setting
                        </div>
                    </div>
                    <div class="settings-body">
                        <div class="mb-4">
                            <h5 class="card-title fw-bold">Change Password</h5>
                            <p class="text-muted small">Update your password to keep your account secure. You'll need to log in again after changing it.</p>
                        </div>
                        
                        <form id="settingsPasswordForm" action="{{ route('update-password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i data-feather="lock" class="text-muted" style="width: 16px;"></i></span>
                                    <input type="password" class="form-control form-control-lg border-start-0 ps-0 @error('old_password') is-invalid @enderror" 
                                           name="old_password" required placeholder="Enter current password">
                                </div>
                                @error('old_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i data-feather="key" class="text-muted" style="width: 16px;"></i></span>
                                    <input type="password" class="form-control form-control-lg border-start-0 ps-0 @error('new_password') is-invalid @enderror" 
                                           name="new_password" required minlength="6" placeholder="Enter new password">
                                </div>
                                <div class="form-text text-muted">Minimum 6 characters</div>
                                @error('new_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i data-feather="check-circle" class="text-muted" style="width: 16px;"></i></span>
                                    <input type="password" class="form-control form-control-lg border-start-0 ps-0" 
                                           name="new_password_confirmation" required minlength="6" placeholder="Confirm new password">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" id="settingsPasswordBtn" class="btn btn-primary-soft">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		if (typeof feather !== 'undefined') feather.replace();

		var form = document.getElementById('settingsPasswordForm');
		var btn = document.getElementById('settingsPasswordBtn');
		if (form && btn) {
			form.addEventListener('submit', function() {
				btn.disabled = true;
				btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Updating…';
			});
		}
	});
</script>

@include('dashboard.footer')
