@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8 col-lg-6 col-xl-5">
				<div class="card shadow-lg border-0">
					<div class="card-header bg-gradient-success text-white text-center py-4">
						<h3 class="mb-0">
							<i class="align-middle" data-feather="phone"></i> WhatsApp API Settings
						</h3>
						<p class="mb-0 mt-2 opacity-75">Update your WhatsApp contact number</p>
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

						<!-- Current WhatsApp Number Display -->
						@if(Auth::guard('admin')->user()->phone)
						<div class="alert alert-info mb-4">
							<div class="d-flex align-items-center">
								<i class="align-middle me-2" data-feather="info"></i>
								<div>
									<strong>Current WhatsApp Number:</strong>
									<div class="mt-1">
										<a href="https://wa.me/{{ str_replace(['+', ' ', '-', '(', ')'], '', Auth::guard('admin')->user()->phone) }}" 
										   target="_blank" 
										   class="text-decoration-none">
											<i class="align-middle" data-feather="message-circle"></i>
											{{ Auth::guard('admin')->user()->phone }}
										</a>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="alert alert-warning mb-4">
							<i class="align-middle" data-feather="alert-triangle"></i>
							<strong>No WhatsApp number set.</strong> Please add your WhatsApp number below.
						</div>
						@endif

						<form action="{{ route('admin.save.whatsapp') }}" method="POST" id="whatsappForm">
							@csrf

							<!-- WhatsApp Phone Number -->
							<div class="mb-4">
								<label for="phone" class="form-label fw-semibold">
									<i class="align-middle" data-feather="phone"></i> WhatsApp Phone Number <span class="text-danger">*</span>
								</label>
								<div class="input-group">
									<span class="input-group-text bg-light">
										<i class="align-middle" data-feather="phone"></i>
									</span>
									<input type="text" 
										class="form-control @error('phone') is-invalid @enderror" 
										id="phone" 
										name="phone" 
										value="{{ old('phone', Auth::guard('admin')->user()->phone) }}" 
										placeholder="+1234567890 or 1234567890" 
										required
										pattern="[+]?[0-9\s\-\(\)]+"
										maxlength="20">
									@error('phone')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<small class="text-muted">
									<i class="align-middle" data-feather="help-circle"></i> 
									Enter your WhatsApp number with country code (e.g., +1234567890)
								</small>
							</div>

							<!-- WhatsApp Format Info -->
							<div class="alert alert-light mb-4">
								<h6 class="alert-heading mb-2">
									<i class="align-middle" data-feather="info"></i> Format Guidelines:
								</h6>
								<ul class="mb-0 small">
									<li>Include country code (e.g., +1 for USA, +44 for UK)</li>
									<li>You can use spaces, dashes, or parentheses for formatting</li>
									<li>Example formats: +1 234 567 8900, +44-20-1234-5678, (123) 456-7890</li>
									<li>This number will be used for the WhatsApp contact button on your website</li>
								</ul>
							</div>

							<!-- Preview Section -->
							<div class="card bg-light mb-4">
								<div class="card-body">
									<h6 class="card-title">
										<i class="align-middle" data-feather="eye"></i> Preview
									</h6>
									<p class="card-text small mb-2">This is how your WhatsApp button will appear:</p>
									<div class="d-inline-block p-3 bg-white rounded border">
										<a href="#" id="previewLink" class="text-decoration-none text-success" target="_blank">
											<i class="align-middle" data-feather="message-circle"></i>
											<span id="previewPhone">Enter phone number to preview</span>
										</a>
									</div>
								</div>
							</div>

							<!-- Submit Button -->
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-success btn-lg" id="submitBtn">
									<i class="align-middle" data-feather="save"></i> Update WhatsApp Number
								</button>
								<a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
									<i class="align-middle" data-feather="x"></i> Cancel
								</a>
							</div>
						</form>
					</div>
				</div>

				<!-- WhatsApp Widget Info Card -->
				<div class="card mt-4 border-0 shadow-sm">
					<div class="card-body">
						<h6 class="card-title">
							<i class="align-middle" data-feather="help-circle"></i> About WhatsApp Widget
						</h6>
						<p class="card-text small text-muted mb-0">
							The WhatsApp contact button will appear on your website, allowing visitors to contact you directly via WhatsApp. 
							Make sure to use a valid WhatsApp number with the correct country code.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<style>
	.bg-gradient-success {
		background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
	}

	.card {
		border-radius: 15px;
		overflow: hidden;
	}

	.card-header {
		border: none;
	}

	.input-group .form-control:focus {
		border-color: #25D366;
		box-shadow: 0 0 0 0.2rem rgba(37, 211, 102, 0.25);
	}

	.btn-success {
		background-color: #25D366;
		border-color: #25D366;
	}

	.btn-success:hover {
		background-color: #128C7E;
		border-color: #128C7E;
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

		// Phone number input formatting
		const phoneInput = document.getElementById('phone');
		const previewPhone = document.getElementById('previewPhone');
		const previewLink = document.getElementById('previewLink');

		if (phoneInput && previewPhone && previewLink) {
			// Format phone number on input
			phoneInput.addEventListener('input', function() {
				let value = this.value;
				
				// Update preview
				if (value.trim() !== '') {
					previewPhone.textContent = value;
					// Create WhatsApp link
					const cleanPhone = value.replace(/[\s\-\(\)]/g, '');
					const whatsappPhone = cleanPhone.startsWith('+') ? cleanPhone : '+' + cleanPhone;
					previewLink.href = 'https://wa.me/' + whatsappPhone.replace(/\+/g, '');
					previewLink.style.display = 'inline-block';
				} else {
					previewPhone.textContent = 'Enter phone number to preview';
					previewLink.href = '#';
					previewLink.style.display = 'none';
				}
			});

			// Initialize preview on page load
			if (phoneInput.value.trim() !== '') {
				phoneInput.dispatchEvent(new Event('input'));
			}
		}

		// Form validation
		const form = document.getElementById('whatsappForm');
		if (form) {
			form.addEventListener('submit', function(e) {
				const phone = phoneInput.value.trim();
				
				// Basic validation
				if (phone === '') {
					e.preventDefault();
					alert('Please enter a WhatsApp phone number.');
					return false;
				}

				// Check if phone number has at least 10 digits
				const digitsOnly = phone.replace(/\D/g, '');
				if (digitsOnly.length < 10) {
					e.preventDefault();
					alert('Please enter a valid phone number with at least 10 digits.');
					return false;
				}

				const submitBtn = document.getElementById('submitBtn');
				if (submitBtn) {
					submitBtn.disabled = true;
					submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating...';
				}
			});
		}

		// WhatsApp widget script (only if phone number exists)
		@if(Auth::guard('admin')->user()->phone)
		(function () {
			var options = {
				whatsapp: "{{ Auth::guard('admin')->user()->phone }}",
				call_to_action: "Message us",
				position: "left",
			};
			var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
			var s = document.createElement('script'); 
			s.type = 'text/javascript'; 
			s.async = true; 
			s.src = url + '/widget-send-button/js/init.js';
			s.onload = function () { 
				if (typeof WhWidgetSendButton !== 'undefined') {
					WhWidgetSendButton.init(host, proto, options); 
				}
			};
			var x = document.getElementsByTagName('script')[0]; 
			x.parentNode.insertBefore(s, x);
		})();
		@endif
	});
</script>

@include('dashboard.footer')
