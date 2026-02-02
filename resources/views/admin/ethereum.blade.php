@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8 col-lg-6 col-xl-5">
				<div class="card shadow-lg border-0">
					<div class="card-header bg-gradient-warning text-white text-center py-4">
						<h3 class="mb-0">
							<i class="align-middle" data-feather="wallet"></i> Wallet Settings
						</h3>
						<p class="mb-0 mt-2 opacity-75">Update your Ethereum wallet address</p>
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

						<!-- Current Wallet Display -->
						@if(Auth::guard('admin')->user()->wallet_address)
						<div class="alert alert-info mb-4">
							<div class="d-flex align-items-center">
								<i class="align-middle me-2" data-feather="info"></i>
								<div class="flex-grow-1">
									<strong>Current Wallet Address:</strong>
									<div class="mt-1">
										<code class="text-break">{{ Auth::guard('admin')->user()->wallet_address }}</code>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="alert alert-warning mb-4">
							<i class="align-middle" data-feather="alert-triangle"></i>
							<strong>No wallet address set.</strong> Please add your Ethereum wallet address below.
						</div>
						@endif

						<form action="{{ route('admin.save.wallet') }}" method="POST" enctype="multipart/form-data" id="walletForm">
							@csrf

							<!-- Ethereum Wallet Address -->
							<div class="mb-4">
								<label for="wallet_address" class="form-label fw-semibold">
									<i class="align-middle" data-feather="wallet"></i> Ethereum Wallet Address <span class="text-danger">*</span>
								</label>
								<div class="input-group">
									<span class="input-group-text bg-light">
										<i class="align-middle" data-feather="hash"></i>
									</span>
									<input type="text" 
										class="form-control @error('wallet_address') is-invalid @enderror" 
										id="wallet_address" 
										name="wallet_address" 
										value="{{ old('wallet_address', Auth::guard('admin')->user()->wallet_address) }}" 
										placeholder="0x..." 
										required
										pattern="^0x[a-fA-F0-9]{40}$"
										maxlength="255">
									<button class="btn btn-outline-secondary" type="button" id="copyWalletBtn" title="Copy to clipboard">
										<i class="align-middle" data-feather="copy"></i>
									</button>
									@error('wallet_address')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<small class="text-muted">
									<i class="align-middle" data-feather="help-circle"></i> 
									Enter a valid Ethereum wallet address (starts with 0x, 42 characters)
								</small>
								<div id="walletValidation" class="mt-2"></div>
							</div>

							<!-- QR Code / Bar Code Upload -->
							<div class="mb-4">
								<label for="image" class="form-label fw-semibold">
									<i class="align-middle" data-feather="image"></i> Wallet QR Code / Bar Code
								</label>
								<div class="card bg-light">
									<div class="card-body">
										<div class="mb-3">
											<input type="file" 
												class="form-control @error('image') is-invalid @enderror" 
												id="image" 
												name="image" 
												accept="image/*"
												onchange="previewImage(this)">
											@error('image')
											<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											<small class="text-muted">
												<i class="align-middle" data-feather="info"></i> 
												Upload a QR code or bar code image (max 2MB). Supported formats: JPEG, PNG, JPG, GIF, SVG, WEBP
											</small>
										</div>

										<!-- Current Bar Code Display -->
										@if(Auth::guard('admin')->user()->bar_code)
										<div class="mt-3">
											<label class="form-label small">Current QR Code / Bar Code:</label>
											<div class="text-center p-3 bg-white rounded border">
												<img src="{{ asset('admin/uploads/admin/' . Auth::guard('admin')->user()->bar_code) }}" 
													alt="Wallet QR Code" 
													class="img-fluid" 
													style="max-height: 200px; max-width: 200px;"
													id="currentBarCode">
												<div class="mt-2">
													<button type="button" class="btn btn btn-outline-danger" onclick="deleteBarCode()">
														<i class="align-middle" data-feather="trash-2"></i> Remove
													</button>
												</div>
											</div>
										</div>
										@endif

										<!-- Image Preview -->
										<div id="imagePreview" class="mt-3" style="display: none;">
											<label class="form-label small">Preview:</label>
											<div class="text-center p-3 bg-white rounded border">
												<img id="previewImg" src="" alt="Preview" class="img-fluid" style="max-height: 200px; max-width: 200px;">
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Wallet Format Info -->
							<div class="alert alert-light mb-4">
								<h6 class="alert-heading mb-2">
									<i class="align-middle" data-feather="info"></i> Wallet Address Guidelines:
								</h6>
								<ul class="mb-0 small">
									<li>Ethereum addresses start with "0x"</li>
									<li>Must be exactly 42 characters (0x + 40 hex characters)</li>
									<li>Example: 0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb</li>
									<li>Double-check the address before saving</li>
									<li>QR code is optional but recommended for easy access</li>
								</ul>
							</div>

							<!-- Submit Button -->
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-warning btn-lg" id="submitBtn">
									<i class="align-middle" data-feather="save"></i> Update Wallet Settings
								</button>
								<a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
									<i class="align-middle" data-feather="x"></i> Cancel
								</a>
							</div>
						</form>
					</div>
				</div>

				<!-- Wallet Info Card -->
				<div class="card mt-4 border-0 shadow-sm">
					<div class="card-body">
						<h6 class="card-title">
							<i class="align-middle" data-feather="help-circle"></i> About Wallet Settings
						</h6>
						<p class="card-text small text-muted mb-0">
							Your Ethereum wallet address is used for receiving payments and transactions. 
							Make sure to use a valid address and keep your private keys secure. Never share your private keys with anyone.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<style>
	.bg-gradient-warning {
		background: linear-gradient(135deg, #f6c23e 0%, #f39c12 100%);
	}

	.card {
		border-radius: 15px;
		overflow: hidden;
	}

	.card-header {
		border: none;
	}

	.input-group .form-control:focus {
		border-color: #f6c23e;
		box-shadow: 0 0 0 0.2rem rgba(246, 194, 62, 0.25);
	}

	.btn-warning {
		background-color: #f6c23e;
		border-color: #f6c23e;
		color: #000;
	}

	.btn-warning:hover {
		background-color: #f39c12;
		border-color: #f39c12;
		color: #000;
	}

	code {
		background-color: #f8f9fa;
		padding: 0.25rem 0.5rem;
		border-radius: 0.25rem;
		font-size: 0.875rem;
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

		// Wallet address validation
		const walletInput = document.getElementById('wallet_address');
		const walletValidation = document.getElementById('walletValidation');
		const copyWalletBtn = document.getElementById('copyWalletBtn');

		if (walletInput && walletValidation) {
			walletInput.addEventListener('input', function() {
				const value = this.value.trim();
				const ethereumAddressPattern = /^0x[a-fA-F0-9]{40}$/;

				if (value === '') {
					walletValidation.innerHTML = '';
					this.classList.remove('is-valid', 'is-invalid');
					return;
				}

				if (ethereumAddressPattern.test(value)) {
					walletValidation.innerHTML = '<small class="text-success"><i class="align-middle" data-feather="check-circle"></i> Valid Ethereum address</small>';
					this.classList.remove('is-invalid');
					this.classList.add('is-valid');
				} else {
					walletValidation.innerHTML = '<small class="text-danger"><i class="align-middle" data-feather="x-circle"></i> Invalid Ethereum address format</small>';
					this.classList.remove('is-valid');
					this.classList.add('is-invalid');
				}

				if (typeof feather !== 'undefined') {
					feather.replace();
				}
			});

			// Initialize validation on page load
			if (walletInput.value.trim() !== '') {
				walletInput.dispatchEvent(new Event('input'));
			}
		}

		// Copy wallet address to clipboard
		if (copyWalletBtn && walletInput) {
			copyWalletBtn.addEventListener('click', function() {
				if (walletInput.value.trim() === '') {
					alert('No wallet address to copy');
					return;
				}

				walletInput.select();
				walletInput.setSelectionRange(0, 99999); // For mobile devices

				try {
					document.execCommand('copy');
					
					// Visual feedback
					const originalHTML = this.innerHTML;
					this.innerHTML = '<i class="align-middle" data-feather="check"></i>';
					this.classList.remove('btn-outline-secondary');
					this.classList.add('btn-success');
					
					setTimeout(() => {
						this.innerHTML = originalHTML;
						this.classList.remove('btn-success');
						this.classList.add('btn-outline-secondary');
						if (typeof feather !== 'undefined') {
							feather.replace();
						}
					}, 2000);
				} catch (err) {
					alert('Failed to copy address');
				}
			});
		}

		// Image preview function
		window.previewImage = function(input) {
			const preview = document.getElementById('imagePreview');
			const previewImg = document.getElementById('previewImg');

			if (input.files && input.files[0]) {
				const reader = new FileReader();

				reader.onload = function(e) {
					previewImg.src = e.target.result;
					preview.style.display = 'block';
				};

				reader.readAsDataURL(input.files[0]);
			} else {
				preview.style.display = 'none';
			}
		};

		// Delete bar code function
		window.deleteBarCode = function() {
			if (confirm('Are you sure you want to remove the current QR code/bar code?')) {
				// This would require a separate route to delete the bar code
				// For now, just hide it and let user upload a new one
				const currentBarCode = document.getElementById('currentBarCode');
				if (currentBarCode) {
					currentBarCode.parentElement.parentElement.style.display = 'none';
				}
			}
		};

		// Form validation
		const form = document.getElementById('walletForm');
		if (form) {
			form.addEventListener('submit', function(e) {
				const wallet = walletInput.value.trim();
				const ethereumAddressPattern = /^0x[a-fA-F0-9]{40}$/;

				if (wallet === '') {
					e.preventDefault();
					alert('Please enter an Ethereum wallet address.');
					return false;
				}

				if (!ethereumAddressPattern.test(wallet)) {
					e.preventDefault();
					alert('Please enter a valid Ethereum wallet address (starts with 0x, 42 characters).');
					return false;
				}

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
