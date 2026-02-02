@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="h3 mb-0"><strong>All Users</strong></h1>
			<div>
				<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse">
					<i class="align-middle" data-feather="filter"></i> Filters
				</button>
			</div>
		</div>

		@if(session('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong><i class="align-middle" data-feather="check-circle"></i> Success!</strong> {{ session('success') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		@if(session('status'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong><i class="align-middle" data-feather="check-circle"></i> Success!</strong> {{ session('status') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		@if($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong><i class="align-middle" data-feather="alert-circle"></i> Error!</strong>
			<ul class="mb-0 mt-2">
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		<!-- Statistics Cards -->
		<div class="row mb-4">
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Total Users</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-primary">
									<i class="align-middle" data-feather="users"></i>
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
								<h5 class="card-title">Active Users</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-success">
									<i class="align-middle" data-feather="user-check"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['active']) }}</b></h3>
						<div class="mb-0">
							<span class="text-muted">{{ number_format($stats['inactive']) }} Inactive</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Wallet Verified</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-info">
									<i class="align-middle" data-feather="shield"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['wallet_verified']) }}</b></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">KYC Approved</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-warning">
									<i class="align-middle" data-feather="file-check"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['kyc_approved']) }}</b></h3>
						<div class="mb-0">
							<span class="text-muted">{{ number_format($stats['kyc_pending']) }} Pending</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Filters Collapse -->
		<div class="collapse mb-4" id="filtersCollapse">
			<div class="card">
				<div class="card-body">
					<form method="GET" action="{{ route('view.users') }}" class="row g-3">
						<div class="col-12 col-md-6 col-lg-3">
							<label for="search" class="form-label">Search</label>
							<input type="text" class="form-control" id="search" name="search" 
								value="{{ request('search') }}" placeholder="Name, email, phone, ID...">
						</div>
						<div class="col-12 col-md-6 col-lg-2">
							<label for="status" class="form-label">Status</label>
							<select class="form-select" id="status" name="status">
								<option value="">All Status</option>
								<option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
								<option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-lg-2">
							<label for="wallet_verify" class="form-label">Wallet</label>
							<select class="form-select" id="wallet_verify" name="wallet_verify">
								<option value="">All</option>
								<option value="1" {{ request('wallet_verify') == '1' ? 'selected' : '' }}>Verified</option>
								<option value="0" {{ request('wallet_verify') == '0' ? 'selected' : '' }}>Unverified</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-lg-2">
							<label for="kyc_status" class="form-label">KYC Status</label>
							<select class="form-select" id="kyc_status" name="kyc_status">
								<option value="">All</option>
								<option value="0" {{ request('kyc_status') == '0' ? 'selected' : '' }}>Pending</option>
								<option value="1" {{ request('kyc_status') == '1' ? 'selected' : '' }}>Approved</option>
								<option value="2" {{ request('kyc_status') == '2' ? 'selected' : '' }}>Declined</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-lg-1">
							<label for="date_from" class="form-label">From Date</label>
							<input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
						</div>
						<div class="col-12 col-md-6 col-lg-1">
							<label for="date_to" class="form-label">To Date</label>
							<input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
						</div>
						<div class="col-12 col-md-6 col-lg-1 d-flex align-items-end">
							<button type="submit" class="btn btn-primary w-100">
								<i class="align-middle" data-feather="search"></i> <span class="d-none d-md-inline">Search</span>
							</button>
						</div>
						@if(request()->hasAny(['search', 'status', 'wallet_verify', 'kyc_status', 'date_from', 'date_to']))
						<div class="col-12">
							<a href="{{ route('view.users') }}" class="btn btn-outline-secondary">
								<i class="align-middle" data-feather="x"></i> Clear Filters
							</a>
						</div>
						@endif
					</form>
				</div>
			</div>
		</div>

		<!-- Users Table -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Users List</h5>
					</div>
					<div class="card-body">
						<!-- Desktop Table View -->
						<div class="table-responsive d-none d-md-block">
							<table class="table table-hover table-striped">
								<thead class="table-light">
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Status</th>
										<th>Wallet</th>
										<th>Wallet Type</th>
										<th>KYC</th>
										<th>Registered</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@forelse($users as $user)
									<tr>
										<td><strong>#{{ $user->id }}</strong></td>
										<td>
											<div class="d-flex align-items-center">
												<div>
													<strong>{{ $user->name }}</strong>
												</div>
											</div>
										</td>
										<td>
											<a href="mailto:{{ $user->email }}" class="text-decoration-none">
												{{ $user->email }}
											</a>
										</td>
										<td>{{ $user->phone ?? 'N/A' }}</td>
										<td>
											@if($user->is_activated == '1')
											<span class="badge bg-success">
												<i class="align-middle" data-feather="check-circle"></i> Active
											</span>
											@else
											<span class="badge bg-warning text-dark">
												<i class="align-middle" data-feather="x-circle"></i> Inactive
											</span>
											@endif
										</td>
										<td>
											@if($user->wallet_verify)
											<span class="badge bg-success">
												<i class="align-middle" data-feather="shield"></i> Verified
											</span>
											@else
											<span class="badge bg-danger">
												<i class="align-middle" data-feather="shield-off"></i> Unverified
											</span>
											@endif
										</td>
										<td>
											@if($user->wallet_type)
											<span class="badge bg-info">
												<i class="align-middle" data-feather="wallet"></i> {{ ucfirst($user->wallet_type) }}
											</span>
											@if($user->wallet_linked)
											<br><small class="text-success"><i class="align-middle" data-feather="link"></i> Linked</small>
											@endif
											@else
											<span class="text-muted">-</span>
											@endif
										</td>
										<td>
											@if($user->id_card_status == '0')
											<span class="badge bg-warning text-dark">
												<i class="align-middle" data-feather="clock"></i> Pending
											</span>
											@elseif($user->id_card_status == '1')
											<span class="badge bg-success">
												<i class="align-middle" data-feather="check-circle"></i> Approved
											</span>
											@elseif($user->id_card_status == '2')
											<span class="badge bg-danger">
												<i class="align-middle" data-feather="x-circle"></i> Declined
											</span>
											@else
											<span class="badge bg-secondary">
												<i class="align-middle" data-feather="file-x"></i> Not Submitted
											</span>
											@endif
										</td>
										<td>
											<div>{{ $user->created_at->format('M d, Y') }}</div>
											<small class="text-muted">{{ $user->created_at->format('H:i A') }}</small>
										</td>
										<td>
											<div class="btn-group" role="group">
												<a href="{{ url('profile/' . $user->id) }}" class="btn btn-primary" title="View Profile">
													<i class="align-middle" data-feather="eye"></i> View
												</a>
												<a href="{{ url('delete/' . $user->id) }}" 
													class="btn btn-danger" 
													title="Delete User"
													onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
													<i class="align-middle" data-feather="trash-2"></i> Delete
												</a>
											</div>
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="10" class="text-center py-5">
											<i class="align-middle" data-feather="users" style="width: 48px; height: 48px; opacity: 0.3;"></i>
											<p class="mt-3 text-muted">No users found</p>
											@if(request()->hasAny(['search', 'status', 'wallet_verify', 'kyc_status', 'date_from', 'date_to']))
											<a href="{{ route('view.users') }}" class="btn btn-outline-primary mt-2">
												Clear filters to see all users
											</a>
											@endif
										</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>

						<!-- Mobile Card View -->
						<div class="d-md-none">
							@forelse($users as $user)
							<div class="card mb-3">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-start mb-2">
										<div>
											<h6 class="mb-1"><strong>{{ $user->name }}</strong></h6>
											<small class="text-muted">ID: #{{ $user->id }}</small>
										</div>
										@if($user->is_activated == '1')
										<span class="badge bg-success">Active</span>
										@else
										<span class="badge bg-warning text-dark">Inactive</span>
										@endif
									</div>
									<div class="mb-2">
										<small class="text-muted d-block"><i class="align-middle" data-feather="mail"></i> Email:</small>
										<a href="mailto:{{ $user->email }}" class="text-decoration-none">{{ $user->email }}</a>
									</div>
									@if($user->phone)
									<div class="mb-2">
										<small class="text-muted d-block"><i class="align-middle" data-feather="phone"></i> Phone:</small>
										{{ $user->phone }}
									</div>
									@endif
									<div class="row g-2 mb-2">
										<div class="col-6">
											<small class="text-muted d-block">Wallet:</small>
											@if($user->wallet_verify)
											<span class="badge bg-success">Verified</span>
											@else
											<span class="badge bg-danger">Unverified</span>
											@endif
										</div>
										<div class="col-6">
											<small class="text-muted d-block">KYC:</small>
											@if($user->id_card_status == '0')
											<span class="badge bg-warning text-dark">Pending</span>
											@elseif($user->id_card_status == '1')
											<span class="badge bg-success">Approved</span>
											@elseif($user->id_card_status == '2')
											<span class="badge bg-danger">Declined</span>
											@else
											<span class="badge bg-secondary">Not Submitted</span>
											@endif
										</div>
									</div>
									@if($user->wallet_type)
									<div class="mb-2">
										<small class="text-muted d-block">Wallet Type:</small>
										<span class="badge bg-info">{{ ucfirst($user->wallet_type) }}</span>
										@if($user->wallet_linked)
										<small class="text-success ms-2"><i class="align-middle" data-feather="link"></i> Linked</small>
										@endif
									</div>
									@endif
									<div class="mb-2">
										<small class="text-muted d-block">Registered:</small>
										{{ $user->created_at->format('M d, Y H:i A') }}
									</div>
									<div class="d-grid gap-2 d-md-flex">
										<a href="{{ url('profile/' . $user->id) }}" class="btn btn-primary flex-fill">
											<i class="align-middle" data-feather="eye"></i> View
										</a>
										<a href="{{ url('delete/' . $user->id) }}" 
											class="btn btn-danger flex-fill" 
											onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
											<i class="align-middle" data-feather="trash-2"></i> Delete
										</a>
									</div>
								</div>
							</div>
							@empty
							<div class="text-center py-5">
								<i class="align-middle" data-feather="users" style="width: 48px; height: 48px; opacity: 0.3;"></i>
								<p class="mt-3 text-muted">No users found</p>
								@if(request()->hasAny(['search', 'status', 'wallet_verify', 'kyc_status', 'date_from', 'date_to']))
								<a href="{{ route('view.users') }}" class="btn btn-outline-primary mt-2">
									Clear filters to see all users
								</a>
								@endif
							</div>
							@endforelse
						</div>
						
						<!-- Pagination -->
						<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-3">
							<div class="text-muted text-center text-md-start">
								Showing <strong>{{ $users->firstItem() ?? 0 }}</strong> to <strong>{{ $users->lastItem() ?? 0 }}</strong> of <strong>{{ $users->total() }}</strong> users
							</div>
							<div class="pagination-wrapper">
								{{ $users->links('pagination::bootstrap-4') }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<style>
	.table-hover tbody tr:hover {
		background-color: rgba(0, 0, 0, 0.02);
	}

	.badge {
		padding: 0.5em 0.75em;
		font-weight: 500;
	}

	.btn-group .btn {
		margin: 0 4px;
		padding: 0.6rem 1.2rem;
		font-size: 0.95rem;
	}

	.btn:not(.btn-lg):not(.btn-sm) {
		padding: 0.6rem 1.2rem;
		font-size: 0.95rem;
	}

	.card {
		border-radius: 10px;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
	}

	.stat {
		font-size: 2rem;
		opacity: 0.8;
	}

	/* Enhanced Pagination Styles */
	.pagination-wrapper .pagination {
		margin-bottom: 0;
		flex-wrap: wrap;
		justify-content: center;
	}
	
	.pagination-wrapper .page-item .page-link {
		color: #495057;
		background-color: #fff;
		border: 1px solid #dee2e6;
		margin: 0 2px;
		border-radius: 4px;
		padding: 0.5rem 0.75rem;
		transition: all 0.2s;
	}
	
	.pagination-wrapper .page-item.active .page-link {
		background-color: #3b7ddd; /* Sidebar Blue */
		border-color: #3b7ddd;
		color: white;
	}
	
	.pagination-wrapper .page-item .page-link:hover {
		background-color: #e2e6ea;
		color: #212529;
		text-decoration: none;
	}
	
	.pagination-wrapper .page-item.disabled .page-link {
		color: #6c757d;
		background-color: #fff;
		border-color: #dee2e6;
	}

	/* Responsive Styles */
	@media (max-width: 768px) {
		.table-responsive {
			font-size: 0.875rem;
		}
		
		.btn-group {
			display: flex;
			flex-direction: column;
		}
		
		.btn-group .btn {
			margin: 2px 0;
		}

		/* Mobile card view improvements */
		.d-md-none .card {
			border-left: 4px solid #3b7ddd;
		}
		
		.d-md-none .card .badge {
			font-size: 0.8rem;
		}
	}

	/* Statistics Cards Responsive */
	@media (max-width: 576px) {
		.col-sm-6 {
			margin-bottom: 1rem;
		}
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Feather Icons
		if (typeof feather !== 'undefined') {
			feather.replace();
		}
	});
</script>

@include('dashboard.footer')
