@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-lg-8">
				<div class="card shadow-lg border-0">
					<div class="card-header bg-gradient-primary text-white text-center py-4">
						<h3 class="mb-0">
							<i class="align-middle" data-feather="upload"></i> Upload Artwork
						</h3>
						<p class="mb-0 mt-2 opacity-75">Add a new artwork to the marketplace</p>
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

						<form action="{{ route('admin.save.nft') }}" method="POST" enctype="multipart/form-data" id="uploadArtworkForm">
							@csrf

							<!-- Artwork Name -->
							<div class="mb-4">
								<label for="nft_name" class="form-label fw-semibold">
									<i class="align-middle" data-feather="tag"></i> Artwork Name <span class="text-danger">*</span>
								</label>
								<input type="text" 
									class="form-control @error('nft_name') is-invalid @enderror" 
									id="nft_name" 
									name="nft_name" 
									value="{{ old('nft_name') }}" 
									placeholder="Enter artwork name" 
									required
									maxlength="255">
								@error('nft_name')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<!-- Owner Name (Optional) -->
			<div class="mb-4">
				<label for="nft_owner" class="form-label fw-semibold">
					<i class="align-middle" data-feather="user"></i> Owner Name <span class="text-muted small">(Optional)</span>
				</label>
				<input type="text" 
					class="form-control @error('nft_owner') is-invalid @enderror" 
					id="nft_owner" 
					name="nft_owner" 
					value="{{ old('nft_owner', Auth::guard('admin')->user()->name ?? 'Admin') }}" 
					placeholder="Enter owner name"
					maxlength="255">
				@error('nft_owner')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
				<small class="text-muted">Leave blank to use your admin name as owner</small>
			</div>

							<!-- Price -->
			<div class="mb-4">
				<label for="nft_price" class="form-label fw-semibold">
					<i class="align-middle" data-feather="dollar-sign"></i> Price ({{ $activeCurrency->currency_code ?? 'USD' }}) <span class="text-danger">*</span>
				</label>
				<div class="input-group">
					<span class="input-group-text bg-light">{{ $activeCurrency->currency_symbol ?? '$' }}</span>
					<input type="number" 
						class="form-control @error('nft_price') is-invalid @enderror" 
						id="nft_price" 
						name="nft_price" 
						value="{{ old('nft_price') }}" 
						placeholder="0.00" 
						required
						step="0.01"
						min="0">
					@error('nft_price')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<small class="text-muted">Enter the price in {{ $activeCurrency->currency_code ?? 'USD' }}. ETH equivalent will be calculated automatically.</small>
			</div>

							<!-- Description -->
							<div class="mb-4">
								<label for="ntf_description" class="form-label fw-semibold">
									<i class="align-middle" data-feather="file-text"></i> Description <span class="text-danger">*</span>
								</label>
								<textarea class="form-control @error('ntf_description') is-invalid @enderror" 
									id="ntf_description" 
									name="ntf_description" 
									rows="5" 
									placeholder="Enter artwork description..." 
									required>{{ old('ntf_description') }}</textarea>
								@error('ntf_description')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>

							<!-- Image Upload -->
							<div class="mb-4">
								<label for="image" class="form-label fw-semibold">
									<i class="align-middle" data-feather="image"></i> Artwork Image <span class="text-danger">*</span>
								</label>
								<div class="card bg-light">
									<div class="card-body">
										<input type="file" 
											class="form-control @error('image') is-invalid @enderror" 
											id="image" 
											name="image" 
											accept="image/*"
											required
											onchange="previewImage(this)">
										@error('image')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
										<small class="text-muted">
											<i class="align-middle" data-feather="info"></i> 
											Maximum file size: 5MB. Supported formats: JPEG, PNG, JPG, GIF, SVG, WEBP
										</small>

										<!-- Image Preview -->
										<div id="imagePreview" class="mt-3" style="display: none;">
											<label class="form-label small">Preview:</label>
											<div class="text-center p-3 bg-white rounded border">
												<img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px; max-width: 100%;">
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Info Alert -->
							<div class="alert alert-info mb-4">
								<h6 class="alert-heading mb-2">
									<i class="align-middle" data-feather="info"></i> Upload Guidelines:
								</h6>
								<ul class="mb-0 small">
									<li>Artwork will be automatically approved and listed in the marketplace</li>
									<li>Ensure the image is high quality and represents the artwork accurately</li>
									<li>Provide a clear and descriptive name and description</li>
									<li>Set a fair and competitive price</li>
								</ul>
							</div>

							<!-- Submit Button -->
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
									<i class="align-middle" data-feather="upload"></i> Upload Artwork
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

	.input-group .form-control:focus {
		border-color: #667eea;
		box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
	}

	.form-control:focus {
		border-color: #667eea;
		box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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

		// Form validation
		const form = document.getElementById('uploadArtworkForm');
		if (form) {
			form.addEventListener('submit', function(e) {
				const submitBtn = document.getElementById('submitBtn');
				if (submitBtn) {
					submitBtn.disabled = true;
					submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';
				}
			});
		}
	});
</script>

@include('dashboard.footer')
