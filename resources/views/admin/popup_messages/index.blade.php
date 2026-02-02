@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="h3 mb-0"><strong>Popup Messages</strong></h1>
			<a href="{{ route('admin.popup.create') }}" class="btn btn-primary">
				<i class="align-middle" data-feather="plus"></i> Create New Popup
			</a>
		</div>

		@include('dashboard.alert')

		<!-- Statistics Cards -->
		<div class="row mb-4">
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Total Popups</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-primary">
									<i class="align-middle" data-feather="message-square"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['total']) }}</b></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Active Popups</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-success">
									<i class="align-middle" data-feather="check-circle"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['active']) }}</b></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">General Messages</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-info">
									<i class="align-middle" data-feather="users"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['general']) }}</b></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">User Specific</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-warning">
									<i class="align-middle" data-feather="user"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['user_specific']) }}</b></h3>
					</div>
				</div>
			</div>
		</div>

		<!-- Filters -->
		<div class="card mb-4">
			<div class="card-body">
				<form method="GET" action="{{ route('admin.popup.messages') }}" class="row g-3">
					<div class="col-md-4">
						<label for="type" class="form-label">Type</label>
						<select class="form-select" id="type" name="type">
							<option value="">All Types</option>
							<option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>General</option>
							<option value="user_specific" {{ request('type') == 'user_specific' ? 'selected' : '' }}>User Specific</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="status" class="form-label">Status</label>
						<select class="form-select" id="status" name="status">
							<option value="">All Status</option>
							<option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
							<option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
						</select>
					</div>
					<div class="col-md-4 d-flex align-items-end">
						<button type="submit" class="btn btn-primary w-100">
							<i class="align-middle" data-feather="search"></i> Filter
						</button>
					</div>
				</form>
			</div>
		</div>

		<!-- Popups Table -->
		<div class="card">
			<div class="card-header">
				<h5 class="card-title mb-0">All Popup Messages</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead class="table-light">
							<tr>
								<th>ID</th>
								<th>Title</th>
								<th>Type</th>
								<th>User</th>
								<th>Position</th>
								<th>Status</th>
								<th>Date Range</th>
								<th>Created</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse($popups as $popup)
							<tr>
								<td><strong>#{{ $popup->id }}</strong></td>
								<td>
									<strong>{{ $popup->title }}</strong>
									<br><small class="text-muted">{{ Str::limit($popup->message, 50) }}</small>
								</td>
								<td>
									@if($popup->type == 'general')
									<span class="badge bg-info">General</span>
									@else
									<span class="badge bg-warning text-dark">User Specific</span>
									@endif
								</td>
								<td>
									@if($popup->user)
									<a href="{{ url('profile/' . $popup->user->id) }}" class="text-decoration-none">
										{{ $popup->user->name }}
									</a>
									@else
									<span class="text-muted">All Users</span>
									@endif
								</td>
								<td>
									<span class="badge bg-secondary">{{ ucfirst($popup->position) }}</span>
								</td>
								<td>
									@if($popup->is_active)
									<span class="badge bg-success">Active</span>
									@else
									<span class="badge bg-danger">Inactive</span>
									@endif
								</td>
								<td>
									@if($popup->start_date || $popup->end_date)
									<small>
										@if($popup->start_date)
										From: {{ $popup->start_date->format('M d, Y') }}<br>
										@endif
										@if($popup->end_date)
										To: {{ $popup->end_date->format('M d, Y') }}
										@endif
									</small>
									@else
									<span class="text-muted">No limit</span>
									@endif
								</td>
								<td>
									<small>{{ $popup->created_at->format('M d, Y') }}</small>
								</td>
								<td>
									<div class="btn-group" role="group">
										<a href="{{ route('admin.popup.edit', $popup->id) }}" class="btn btn-primary" title="Edit">
											<i class="align-middle" data-feather="edit"></i>
										</a>
										<a href="{{ route('admin.popup.toggle', $popup->id) }}" class="btn btn-{{ $popup->is_active ? 'warning' : 'success' }}" title="{{ $popup->is_active ? 'Deactivate' : 'Activate' }}">
											<i class="align-middle" data-feather="{{ $popup->is_active ? 'eye-off' : 'eye' }}"></i>
										</a>
										<a href="{{ route('admin.popup.delete', $popup->id) }}" 
											class="btn btn-danger" 
											title="Delete"
											onclick="return confirm('Are you sure you want to delete this popup message?')">
											<i class="align-middle" data-feather="trash-2"></i>
										</a>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="9" class="text-center py-5">
									<i class="align-middle" data-feather="message-square" style="width: 48px; height: 48px; opacity: 0.3;"></i>
									<p class="mt-3 text-muted">No popup messages found</p>
									<a href="{{ route('admin.popup.create') }}" class="btn btn-primary mt-2">
										Create First Popup Message
									</a>
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>

				<!-- Pagination -->
				<div class="d-flex justify-content-between align-items-center mt-3">
					<div class="text-muted">
						Showing {{ $popups->firstItem() ?? 0 }} to {{ $popups->lastItem() ?? 0 }} of {{ $popups->total() }} popups
					</div>
					<div>
						{{ $popups->links('pagination::bootstrap-4') }}
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		if (typeof feather !== 'undefined') {
			feather.replace();
		}
	});
</script>

@include('dashboard.footer')
