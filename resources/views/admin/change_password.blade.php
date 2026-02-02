@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8 col-lg-6 col-xl-5">
				<div class="card shadow-lg border-0">
					<div class="card-header bg-gradient-primary text-white text-center py-4">
						<h3 class="mb-0">
							<i class="align-middle" data-feather="lock"></i> Change Password
						</h3>
						<p class="mb-0 mt-2 opacity-75">Update your account password</p>
					</div>
					<div class="card-body p-4">
						@if (session('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong><i class="align-middle" data-feather="alert-circle"></i> Error!</strong> {{ session('error') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif

						@if (session('status'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong><i class="align-middle" data-feather="check-circle"></i> Success!</strong> {{ session('status') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif

						@if ($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong><i class="align-middle" data-feather="alert-circle"></i> Validation Error!</strong>
							<ul class="mb-0 mt-2">
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif

						<form action="{{ route('admin.update.password') }}" method="POST" id="changePasswordForm">
							@csrf

							<!-- Current Password -->
							<div class="mb-4">
								<label for="old_password" class="form-label fw-semibold">
									<i class="align-middle" data-feather="key"></i> Current Password <span class="text-danger">*</span>
								</label>
								<div class="input-group">
									<input type="password" 
										class="form-control @error('old_password') is-invalid @enderror" 
										id="old_password" 
										name="old_password" 
										placeholder="Enter your current password" 
										required
										autocomplete="current-password">
									<button class="btn btn-outline-secondary" type="button" id="toggleOldPassword">
										<i class="align-middle" data-feather="eye" id="eyeOldPassword"></i>
										<i class="align-middle" data-feather="eye-off" id="eyeOffOldPassword" style="display: none;"></i>
									</button>
									@error('old_password')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<small class="text-muted">Enter your current password to verify your identity</small>
							</div>

							<!-- New Password -->
							<div class="mb-4">
								<label for="new_password" class="form-label fw-semibold">
									<i class="align-middle" data-feather="lock"></i> New Password <span class="text-danger">*</span>
								</label>
								<div class="input-group">
									<input type="password" 
										class="form-control @error('new_password') is-invalid @enderror" 
										id="new_password" 
										name="new_password" 
										placeholder="Enter your new password" 
										required
										minlength="8"
										autocomplete="new-password">
									<button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
										<i class="align-middle" data-feather="eye" id="eyeNewPassword"></i>
										<i class="align-middle" data-feather="eye-off" id="eyeOffNewPassword" style="display: none;"></i>
									</button>
									@error('new_password')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="password-strength mt-2">
									<div class="progress" style="height: 5px;">
										<div class="progress-bar" id="passwordStrength" role="progressbar" style="width: 0%"></div>
									</div>
									<small class="text-muted" id="passwordStrengthText">Password must be at least 8 characters</small>
								</div>
							</div>

							<!-- Confirm New Password -->
							<div class="mb-4">
								<label for="new_password_confirmation" class="form-label fw-semibold">
									<i class="align-middle" data-feather="lock"></i> Confirm New Password <span class="text-danger">*</span>
								</label>
								<div class="input-group">
									<input type="password" 
										class="form-control @error('new_password_confirmation') is-invalid @enderror" 
										id="new_password_confirmation" 
										name="new_password_confirmation" 
										placeholder="Confirm your new password" 
										required
										autocomplete="new-password">
									<button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
										<i class="align-middle" data-feather="eye" id="eyeConfirmPassword"></i>
										<i class="align-middle" data-feather="eye-off" id="eyeOffConfirmPassword" style="display: none;"></i>
									</button>
									@error('new_password_confirmation')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<small class="text-muted" id="passwordMatch"></small>
							</div>

							<!-- Password Requirements -->
							<div class="alert alert-info mb-4">
								<h6 class="alert-heading mb-2"><i class="align-middle" data-feather="info"></i> Password Requirements:</h6>
								<ul class="mb-0 small">
									<li>At least 8 characters long</li>
									<li>Contains uppercase and lowercase letters</li>
									<li>Contains at least one number</li>
									<li>Contains at least one special character (optional but recommended)</li>
								</ul>
							</div>

							<!-- Submit Button -->
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
									<i class="align-middle" data-feather="save"></i> Update Password
								</button>
								<a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
									<i class="align-middle" data-feather="x"></i> Cancel
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<style>
	.bg-gradient-primary {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	}

	.card {
		border-radius: 15px;
		overflow: hidden;
	}

	.card-header {
		border: none;
	}

	.input-group .btn {
		border-left: none;
		z-index: 3;
	}

	.input-group .form-control:focus {
		border-color: #667eea;
		box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
	}

	.password-strength .progress-bar {
		transition: width 0.3s ease, background-color 0.3s ease;
	}

	@media (max-width: 768px) {
		.card-body {
			padding: 1.5rem !important;
		}
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Feather Icons
		if (typeof feather !== 'undefined') {
			feather.replace();
		}

		// Toggle Old Password Visibility
		const toggleOldPassword = document.getElementById('toggleOldPassword');
		const oldPasswordInput = document.getElementById('old_password');
		const eyeOldPassword = document.getElementById('eyeOldPassword');
		const eyeOffOldPassword = document.getElementById('eyeOffOldPassword');

		if (toggleOldPassword) {
			toggleOldPassword.addEventListener('click', function() {
				const type = oldPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
				oldPasswordInput.setAttribute('type', type);
				
				if (type === 'text') {
					eyeOldPassword.style.display = 'none';
					eyeOffOldPassword.style.display = 'inline';
				} else {
					eyeOldPassword.style.display = 'inline';
					eyeOffOldPassword.style.display = 'none';
				}
				
				if (typeof feather !== 'undefined') {
					feather.replace();
				}
			});
		}

		// Toggle New Password Visibility
		const toggleNewPassword = document.getElementById('toggleNewPassword');
		const newPasswordInput = document.getElementById('new_password');
		const eyeNewPassword = document.getElementById('eyeNewPassword');
		const eyeOffNewPassword = document.getElementById('eyeOffNewPassword');

		if (toggleNewPassword) {
			toggleNewPassword.addEventListener('click', function() {
				const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
				newPasswordInput.setAttribute('type', type);
				
				if (type === 'text') {
					eyeNewPassword.style.display = 'none';
					eyeOffNewPassword.style.display = 'inline';
				} else {
					eyeNewPassword.style.display = 'inline';
					eyeOffNewPassword.style.display = 'none';
				}
				
				if (typeof feather !== 'undefined') {
					feather.replace();
				}
			});
		}

		// Toggle Confirm Password Visibility
		const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
		const confirmPasswordInput = document.getElementById('new_password_confirmation');
		const eyeConfirmPassword = document.getElementById('eyeConfirmPassword');
		const eyeOffConfirmPassword = document.getElementById('eyeOffConfirmPassword');

		if (toggleConfirmPassword) {
			toggleConfirmPassword.addEventListener('click', function() {
				const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
				confirmPasswordInput.setAttribute('type', type);
				
				if (type === 'text') {
					eyeConfirmPassword.style.display = 'none';
					eyeOffConfirmPassword.style.display = 'inline';
				} else {
					eyeConfirmPassword.style.display = 'inline';
					eyeOffConfirmPassword.style.display = 'none';
				}
				
				if (typeof feather !== 'undefined') {
					feather.replace();
				}
			});
		}

		// Password Strength Indicator
		const passwordStrength = document.getElementById('passwordStrength');
		const passwordStrengthText = document.getElementById('passwordStrengthText');
		
		if (newPasswordInput && passwordStrength) {
			newPasswordInput.addEventListener('input', function() {
				const password = this.value;
				let strength = 0;
				let strengthText = 'Weak';
				let strengthColor = 'bg-danger';

				if (password.length >= 8) strength++;
				if (password.length >= 12) strength++;
				if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
				if (/\d/.test(password)) strength++;
				if (/[^a-zA-Z\d]/.test(password)) strength++;

				if (strength <= 2) {
					strengthText = 'Weak';
					strengthColor = 'bg-danger';
				} else if (strength <= 3) {
					strengthText = 'Medium';
					strengthColor = 'bg-warning';
				} else {
					strengthText = 'Strong';
					strengthColor = 'bg-success';
				}

				const percentage = (strength / 5) * 100;
				passwordStrength.style.width = percentage + '%';
				passwordStrength.className = 'progress-bar ' + strengthColor;
				passwordStrengthText.textContent = 'Password strength: ' + strengthText;
			});
		}

		// Password Match Indicator
		if (newPasswordInput && confirmPasswordInput) {
			function checkPasswordMatch() {
				const passwordMatch = document.getElementById('passwordMatch');
				if (confirmPasswordInput.value === '') {
					passwordMatch.textContent = '';
					confirmPasswordInput.classList.remove('is-valid', 'is-invalid');
					return;
				}

				if (newPasswordInput.value === confirmPasswordInput.value) {
					passwordMatch.textContent = '✓ Passwords match';
					passwordMatch.className = 'text-success';
					confirmPasswordInput.classList.remove('is-invalid');
					confirmPasswordInput.classList.add('is-valid');
				} else {
					passwordMatch.textContent = '✗ Passwords do not match';
					passwordMatch.className = 'text-danger';
					confirmPasswordInput.classList.remove('is-valid');
					confirmPasswordInput.classList.add('is-invalid');
				}
			}

			newPasswordInput.addEventListener('input', checkPasswordMatch);
			confirmPasswordInput.addEventListener('input', checkPasswordMatch);
		}

		// Form Validation
		const form = document.getElementById('changePasswordForm');
		if (form) {
			form.addEventListener('submit', function(e) {
				const submitBtn = document.getElementById('submitBtn');
				if (submitBtn) {
					submitBtn.disabled = true;
					submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating...';
				}
			});
		}
	});
</script>

@include('dashboard.footer')
