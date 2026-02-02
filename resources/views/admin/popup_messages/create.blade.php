@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="h3 mb-0"><strong>Create Popup Message</strong></h1>
			<a href="{{ route('admin.popup.messages') }}" class="btn btn-secondary">
				<i class="align-middle" data-feather="arrow-left"></i> Back to List
			</a>
		</div>

		@include('dashboard.alert')

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Popup Message Details</h5>
					</div>
					<div class="card-body">
						<form method="POST" action="{{ route('admin.popup.store') }}">
							@csrf

							<div class="row g-3">
								<div class="col-md-6">
									<label for="title" class="form-label">Title <span class="text-danger">*</span></label>
									<input type="text" class="form-control @error('title') is-invalid @enderror" 
										id="title" name="title" value="{{ old('title') }}" required>
									@error('title')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<div class="col-md-6">
									<label for="type" class="form-label">Type <span class="text-danger">*</span></label>
									<select class="form-select @error('type') is-invalid @enderror" 
										id="type" name="type" required onchange="toggleUserField()">
										<option value="">Select Type</option>
										<option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>General (All Users)</option>
										<option value="user_specific" {{ old('type') == 'user_specific' ? 'selected' : '' }}>User Specific</option>
									</select>
									@error('type')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<div class="col-md-6" id="userField" style="display: none;">
									<label for="user_id" class="form-label">Select User <span class="text-danger">*</span></label>
									<select class="form-select @error('user_id') is-invalid @enderror" 
										id="user_id" name="user_id">
										<option value="">Select User</option>
										@foreach($users as $user)
										<option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
											{{ $user->name }} ({{ $user->email }})
										</option>
										@endforeach
									</select>
									@error('user_id')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<div class="col-md-6">
									<label for="position" class="form-label">Position <span class="text-danger">*</span></label>
									<select class="form-select @error('position') is-invalid @enderror" 
										id="position" name="position" required>
										<option value="">Select Position</option>
										<option value="top" {{ old('position') == 'top' ? 'selected' : '' }}>Top of Screen</option>
										<option value="bottom" {{ old('position') == 'bottom' ? 'selected' : '' }}>Bottom of Screen</option>
									</select>
									@error('position')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>

								<div class="col-12">
									<label for="message" class="form-label">Message <span class="text-danger">*</span></label>
									<textarea class="form-control @error('message') is-invalid @enderror" 
										id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
									@error('message')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
									<small class="form-text text-muted">Enter the message content that will be displayed in the popup.</small>
								</div>

								<div class="col-md-6">
									<label for="start_date" class="form-label">Start Date</label>
									<input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" 
										id="start_date" name="start_date" value="{{ old('start_date') }}">
									@error('start_date')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
									<small class="form-text text-muted">Leave empty for immediate start.</small>
								</div>

								<div class="col-md-6">
									<label for="end_date" class="form-label">End Date</label>
									<input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" 
										id="end_date" name="end_date" value="{{ old('end_date') }}">
									@error('end_date')
									<div class="invalid-feedback">{{ $message }}</div>
									@enderror
									<small class="form-text text-muted">Leave empty for no expiration.</small>
								</div>

								<div class="col-12">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
											{{ old('is_active', true) ? 'checked' : '' }}>
										<label class="form-check-label" for="is_active">
											Active (Popup will be displayed)
										</label>
									</div>
								</div>

								<div class="col-12">
									<button type="submit" class="btn btn-primary">
										<i class="align-middle" data-feather="save"></i> Create Popup Message
									</button>
									<a href="{{ route('admin.popup.messages') }}" class="btn btn-secondary">
										Cancel
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
	function toggleUserField() {
		const type = document.getElementById('type').value;
		const userField = document.getElementById('userField');
		const userIdSelect = document.getElementById('user_id');
		
		if (type === 'user_specific') {
			userField.style.display = 'block';
			userIdSelect.setAttribute('required', 'required');
		} else {
			userField.style.display = 'none';
			userIdSelect.removeAttribute('required');
			userIdSelect.value = '';
			// Remove the select from form submission when hidden
			userIdSelect.disabled = true;
		}
	}

	// Initialize on page load
	document.addEventListener('DOMContentLoaded', function() {
		toggleUserField();
		if (typeof feather !== 'undefined') {
			feather.replace();
		}
	});
</script>

@include('dashboard.footer')
