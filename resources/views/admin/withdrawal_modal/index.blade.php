@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-4"><strong>Withdrawal Success Modal</strong></h1>
		<p class="text-muted mb-4">Configure the popup message shown to users after they submit a withdrawal. You can set the message text, turn the modal on or off globally, and override per user.</p>

		@include('dashboard.alert')

		{{-- Global settings --}}
		<div class="card mb-4">
			<div class="card-header">
				<h5 class="card-title mb-0">General (Global) Settings</h5>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('admin.withdrawal.modal.update') }}">
					@csrf
					@method('PUT')
					<div class="mb-4">
						<label for="message" class="form-label">Modal message (shown after withdrawal)</label>
						<textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4" placeholder="e.g. Your withdrawal request has been submitted and is pending review.">{{ old('message', $setting->message) }}</textarea>
						<small class="text-muted">Leave empty to use the default message.</small>
						@error('message')
						<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="form-check mb-3">
						<input type="checkbox" class="form-check-input" id="is_enabled" name="is_enabled" value="1" {{ old('is_enabled', $setting->is_enabled) ? 'checked' : '' }}>
						<label class="form-check-label" for="is_enabled">Enable withdrawal success modal globally</label>
					</div>
					<button type="submit" class="btn btn-primary">Save global settings</button>
				</form>
			</div>
		</div>

		{{-- User-specific overrides --}}
		<div class="card">
			<div class="card-header">
				<h5 class="card-title mb-0">User-specific overrides</h5>
			</div>
			<div class="card-body">
				<p class="text-muted small mb-3">Override the global setting for specific users. If a user is listed here, their choice (Show / Hide) overrides the global toggle.</p>

				<form method="POST" action="{{ route('admin.withdrawal.modal.override.store') }}" class="row g-3 mb-4">
					@csrf
					<div class="col-md-5">
						<label for="user_id" class="form-label">User</label>
						<select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
							<option value="">Select user</option>
							@foreach($users as $user)
							<option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
							@endforeach
						</select>
						@error('user_id')
						<div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
					<div class="col-md-4">
						<label class="form-label d-block">Show modal for this user?</label>
						<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" name="show_modal" id="show_modal_1" value="1" {{ old('show_modal', '1') == '1' ? 'checked' : '' }}>
							<label class="form-check-label" for="show_modal_1">Show</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" name="show_modal" id="show_modal_0" value="0" {{ old('show_modal') == '0' ? 'checked' : '' }}>
							<label class="form-check-label" for="show_modal_0">Hide</label>
						</div>
					</div>
					<div class="col-md-3 d-flex align-items-end">
						<button type="submit" class="btn btn-outline-primary">Add / Update override</button>
					</div>
				</form>

				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>User</th>
								<th>Email</th>
								<th>Show modal</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse($overrides as $override)
							<tr>
								<td>{{ $override->user->name ?? '—' }}</td>
								<td>{{ $override->user->email ?? '—' }}</td>
								<td>
									@if($override->show_modal)
									<span class="badge bg-success">Show</span>
									@else
									<span class="badge bg-secondary">Hide</span>
									@endif
								</td>
								<td>
									<a href="{{ route('admin.withdrawal.modal.override.delete', $override->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this user override?');">Remove</a>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="4" class="text-muted">No user overrides. Global setting applies to everyone.</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>

@include('admin.footer')
