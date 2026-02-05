@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<div>
				<h1 class="h3 mb-1 text-gray-800">
					<strong>All Users</strong>
				</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active" aria-current="page">Users</li>
					</ol>
				</nav>
			</div>
			<div class="d-flex gap-2">
				<a href="{{ route('view.users') }}" class="btn btn-outline-secondary" title="Refresh">
					<i class="align-middle" data-feather="refresh-cw"></i>
				</a>
				<button class="btn btn-primary shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="{{ request()->hasAny(['search', 'status', 'wallet_verify', 'kyc_status', 'date_from', 'date_to']) ? 'true' : 'false' }}">
					<i class="align-middle" data-feather="filter"></i> Filters
				</button>
			</div>
		</div>

		@if(session('success'))
		<div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
			<div class="d-flex align-items-center">
				<i class="align-middle me-2" data-feather="check-circle"></i>
				<div>{{ session('success') }}</div>
			</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		@if(session('status'))
		<div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
			<div class="d-flex align-items-center">
				<i class="align-middle me-2" data-feather="check-circle"></i>
				<div>{{ session('status') }}</div>
			</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		<!-- Statistics Cards -->
		<div class="row mb-4">
			<div class="col-sm-6 col-xl-3 mb-3 mb-xl-0">
				<div class="card shadow-sm border-0 h-100 stat-card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title text-muted text-uppercase fw-bold small">Total Users</h5>
							</div>
							<div class="col-auto">
								<div class="icon-shape bg-soft-primary text-primary rounded-circle">
									<i class="align-middle" data-feather="users"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-0 fw-bold">{{ number_format($stats['total']) }}</h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3 mb-3 mb-xl-0">
				<div class="card shadow-sm border-0 h-100 stat-card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title text-muted text-uppercase fw-bold small">Active</h5>
							</div>
							<div class="col-auto">
								<div class="icon-shape bg-soft-success text-success rounded-circle">
									<i class="align-middle" data-feather="user-check"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-0 fw-bold">{{ number_format($stats['active']) }}</h3>
						<small class="text-muted">{{ number_format($stats['inactive']) }} Inactive</small>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3 mb-3 mb-xl-0">
				<div class="card shadow-sm border-0 h-100 stat-card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title text-muted text-uppercase fw-bold small">Wallet Verified</h5>
							</div>
							<div class="col-auto">
								<div class="icon-shape bg-soft-info text-info rounded-circle">
									<i class="align-middle" data-feather="shield"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-0 fw-bold">{{ number_format($stats['wallet_verified']) }}</h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card shadow-sm border-0 h-100 stat-card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title text-muted text-uppercase fw-bold small">KYC Approved</h5>
							</div>
							<div class="col-auto">
								<div class="icon-shape bg-soft-warning text-warning rounded-circle">
									<i class="align-middle" data-feather="file-check"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-0 fw-bold">{{ number_format($stats['kyc_approved']) }}</h3>
						<small class="text-muted">{{ number_format($stats['kyc_pending']) }} Pending</small>
					</div>
				</div>
			</div>
		</div>

		<!-- Advanced Filters (Server-side) -->
		<div class="collapse mb-4 {{ request()->hasAny(['search', 'status', 'wallet_verify', 'kyc_status', 'date_from', 'date_to']) ? 'show' : '' }}" id="filtersCollapse">
			<div class="card shadow-sm border-0">
				<div class="card-header bg-white border-bottom-0 pb-0">
					<h5 class="card-title mb-0 text-primary fw-bold">Advanced Filtering</h5>
				</div>
				<div class="card-body">
					<form method="GET" action="{{ route('view.users') }}" class="row g-3">
						<div class="col-12 col-md-6 col-lg-3">
							<label for="search" class="form-label small text-uppercase fw-bold text-muted">Global Search</label>
							<div class="input-group">
								<span class="input-group-text bg-light border-end-0"><i class="align-middle" data-feather="search"></i></span>
								<input type="text" class="form-control border-start-0 bg-light" id="search" name="search" 
									value="{{ request('search') }}" placeholder="Name, email, details...">
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-2">
							<label for="status" class="form-label small text-uppercase fw-bold text-muted">Status</label>
							<select class="form-select bg-light" id="status" name="status">
								<option value="">All Status</option>
								<option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
								<option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-lg-2">
							<label for="wallet_verify" class="form-label small text-uppercase fw-bold text-muted">Wallet</label>
							<select class="form-select bg-light" id="wallet_verify" name="wallet_verify">
								<option value="">All</option>
								<option value="1" {{ request('wallet_verify') == '1' ? 'selected' : '' }}>Verified</option>
								<option value="0" {{ request('wallet_verify') == '0' ? 'selected' : '' }}>Unverified</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-lg-2">
							<label for="kyc_status" class="form-label small text-uppercase fw-bold text-muted">KYC</label>
							<select class="form-select bg-light" id="kyc_status" name="kyc_status">
								<option value="">All</option>
								<option value="0" {{ request('kyc_status') == '0' ? 'selected' : '' }}>Pending</option>
								<option value="1" {{ request('kyc_status') == '1' ? 'selected' : '' }}>Approved</option>
								<option value="2" {{ request('kyc_status') == '2' ? 'selected' : '' }}>Declined</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-lg-3">
							<label class="form-label small text-uppercase fw-bold text-muted">Date Range</label>
							<div class="input-group">
								<input type="date" class="form-control bg-light" name="date_from" value="{{ request('date_from') }}" title="From">
								<span class="input-group-text border-start-0 border-end-0 bg-light text-muted">to</span>
								<input type="date" class="form-control bg-light" name="date_to" value="{{ request('date_to') }}" title="To">
							</div>
						</div>
						<div class="col-12 d-flex justify-content-end gap-2 mt-4">
							@if(request()->hasAny(['search', 'status', 'wallet_verify', 'kyc_status', 'date_from', 'date_to']))
							<a href="{{ route('view.users') }}" class="btn btn-light text-muted">
								<i class="align-middle me-1" data-feather="x"></i> Clear
							</a>
							@endif
							<button type="submit" class="btn btn-primary px-4 rounded-pill">
								<i class="align-middle me-1" data-feather="search"></i> Apply Filters
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Users List Card -->
		<div class="card shadow-sm border-0">
			<div class="card-header bg-white py-3 border-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
				<h5 class="card-title mb-0 fw-bold">Users List</h5>
				
				<!-- Instant JS Search -->
				<div class="position-relative" style="min-width: 250px;">
					<input type="text" id="instantSearch" class="form-control ps-5 rounded-pill bg-light border-0" placeholder="Quick find on this page...">
					<div class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
						<i class="align-middle" data-feather="search" width="16" height="16"></i>
					</div>
				</div>
			</div>
			
			<div class="card-body p-0">
				<!-- Desktop Table View -->
				<div class="table-responsive d-none d-md-block">
					<table class="table table-hover table-striped align-middle mb-0" id="usersTable">
						<thead class="bg-light">
							<tr>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">User</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">Contact</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">Status</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">Wallet</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">KYC</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">Registered</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small text-end">Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse($users as $user)
							<tr class="user-row">
								<td class="px-4 py-3">
									<div class="d-flex align-items-center">
										<div class="avatar-initial rounded-circle bg-gradient-primary text-white d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 40px; height: 40px; font-weight: bold; font-size: 14px;">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
										<div>
											<div class="fw-bold text-dark search-name">{{ $user->name }}</div>
											<div class="small text-muted">ID: #{{ $user->id }}</div>
										</div>
									</div>
								</td>
								<td class="px-4 py-3">
									<div class="d-flex flex-column">
										<a href="mailto:{{ $user->email }}" class="text-decoration-none small fw-medium search-email">{{ $user->email }}</a>
										@if($user->phone)
										<small class="text-muted search-phone">{{ $user->phone }}</small>
										@endif
									</div>
								</td>
								<td class="px-4 py-3">
									@if($user->is_activated == '1')
									<span class="badge bg-soft-success text-success rounded-pill px-3">Active</span>
									@else
									<span class="badge bg-soft-warning text-warning rounded-pill px-3">Inactive</span>
									@endif
								</td>
								<td class="px-4 py-3">
									<div class="d-flex flex-column gap-1">
										@if($user->wallet_verify)
											<span class="badge bg-soft-success text-success rounded-pill w-auto align-self-start"><i class="align-middle me-1" data-feather="shield" width="12"></i> Verified</span>
										@else
											<span class="badge bg-soft-danger text-danger rounded-pill w-auto align-self-start"><i class="align-middle me-1" data-feather="shield-off" width="12"></i> Unverified</span>
										@endif
										
										@if($user->wallet_type)
											<small class="text-muted">
												{{ ucfirst($user->wallet_type) }}
												@if($user->wallet_linked)
												<i class="align-middle text-primary ms-1" data-feather="link" width="12" title="Linked"></i>
												@endif
											</small>
										@endif
									</div>
								</td>
								<td class="px-4 py-3">
									@if($user->id_card_status == '0')
										<span class="badge bg-soft-warning text-warning rounded-pill">Pending</span>
									@elseif($user->id_card_status == '1')
										<span class="badge bg-soft-success text-success rounded-pill">Approved</span>
									@elseif($user->id_card_status == '2')
										<span class="badge bg-soft-danger text-danger rounded-pill">Declined</span>
									@else
										<span class="badge bg-light text-muted border rounded-pill">None</span>
									@endif
								</td>
								<td class="px-4 py-3">
									<div class="small text-muted">{{ $user->created_at->format('M d, Y') }}</div>
								</td>
								<td class="px-4 py-3 text-end">
									<div class="btn-group shadow-sm rounded-pill" role="group">
										<a href="{{ url('profile/' . $user->id) }}" class="btn btn-sm btn-outline-primary" title="View Profile">
											<i class="align-middle" data-feather="eye" width="16"></i> <span class="d-none d-lg-inline-block small ms-1">View</span>
										</a>
										<a href="{{ url('delete/' . $user->id) }}" 
											class="btn btn-sm btn-outline-danger" 
											title="Delete User"
											onclick="return confirm('Are you sure? This action is permanent.')">
											<i class="align-middle" data-feather="trash-2" width="16"></i>
										</a>
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="10" class="text-center py-5">
									<div class="d-flex flex-column align-items-center">
										<div class="bg-light rounded-circle p-3 mb-3">
											<i class="align-middle text-muted" data-feather="users" width="32" height="32"></i>
										</div>
										<h5 class="text-muted fw-bold">No users found</h5>
										<p class="text-muted small mb-0">Try adjusting your search filters</p>
									</div>
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>

				<!-- Mobile Card View -->
				<div class="d-md-none bg-light p-3">
					<div id="mobileUserList">
						@forelse($users as $user)
						<div class="card mb-3 shadow-sm border-0 user-item">
							<div class="card-body p-3">
								<div class="d-flex justify-content-between align-items-start mb-3">
									<div class="d-flex align-items-center">
										<div class="avatar-initial rounded-circle bg-gradient-primary text-white d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 40px; height: 40px; font-weight: bold; font-size: 14px;">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
										<div>
											<h6 class="mb-0 fw-bold text-dark search-name">{{ $user->name }}</h6>
											<small class="text-muted">#{{ $user->id }}</small>
										</div>
									</div>
									@if($user->is_activated == '1')
									<span class="badge bg-soft-success text-success rounded-pill">Active</span>
									@else
									<span class="badge bg-soft-warning text-warning rounded-pill">Inactive</span>
									@endif
								</div>
								
								<div class="mb-3">
									<div class="d-flex align-items-center mb-1">
										<i class="text-muted me-2" data-feather="mail" width="14"></i>
										<a href="mailto:{{ $user->email }}" class="text-decoration-none text-dark small search-email">{{ $user->email }}</a>
									</div>
									@if($user->phone)
									<div class="d-flex align-items-center">
										<i class="text-muted me-2" data-feather="phone" width="14"></i>
										<span class="text-dark small search-phone">{{ $user->phone }}</span>
									</div>
									@endif
								</div>
								
								<div class="row g-2 mb-3">
									<div class="col-6">
										<div class="p-2 bg-light rounded text-center">
											<small class="d-block text-uppercase text-muted fw-bold" style="font-size: 10px;">Wallet</small>
											@if($user->wallet_verify)
											<span class="text-success small fw-bold"><i class="me-1" data-feather="check"></i> Verified</span>
											@else
											<span class="text-danger small fw-bold"><i class="me-1" data-feather="x"></i> Unverified</span>
											@endif
										</div>
									</div>
									<div class="col-6">
										<div class="p-2 bg-light rounded text-center">
											<small class="d-block text-uppercase text-muted fw-bold" style="font-size: 10px;">KYC</small>
											@if($user->id_card_status == '1')
											<span class="text-success small fw-bold">Approved</span>
											@elseif($user->id_card_status == '0')
											<span class="text-warning small fw-bold">Pending</span>
											@else
											<span class="text-muted small fw-bold">-</span>
											@endif
										</div>
									</div>
								</div>
								
								<div class="d-grid gap-2 d-flex">
									<a href="{{ url('profile/' . $user->id) }}" class="btn btn-primary btn-sm flex-fill rounded-pill">
										View Profile
									</a>
									<a href="{{ url('delete/' . $user->id) }}" 
										class="btn btn-outline-danger btn-sm flex-fill rounded-pill" 
										onclick="return confirm('Are you sure?')">
										Delete
									</a>
								</div>
							</div>
						</div>
						@empty
						<div class="text-center py-5">
							<p class="text-muted">No users found</p>
						</div>
						@endforelse
					</div>
				</div>
				
				<!-- Horizontal Pagination -->
				<div class="card-footer bg-white py-3 border-top">
					<div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
						<div class="text-muted small text-center text-md-start">
							Showing <strong>{{ $users->firstItem() ?? 0 }}</strong> to <strong>{{ $users->lastItem() ?? 0 }}</strong> of <strong>{{ $users->total() }}</strong> users
						</div>
						<div class="pagination-container">
							{{ $users->links('pagination::bootstrap-4') }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<style>
/* Custom Styles for Modern Look */
.bg-gradient-primary {
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.bg-soft-primary { background-color: rgba(102, 126, 234, 0.1); }
.bg-soft-success { background-color: rgba(40, 167, 69, 0.1); }
.bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }
.bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); }
.bg-soft-info { background-color: rgba(23, 162, 184, 0.1); }

/* Card & Stats Improvements */
.stat-card {
	transition: all 0.3s ease;
}
.stat-card:hover {
	transform: translateY(-5px);
	box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important;
}
.icon-shape {
	width: 48px;
	height: 48px;
	display: flex;
	align-items: center;
	justify-content: center;
}

/* Horizontal Pagination Styling */
.pagination-container .pagination {
	margin-bottom: 0;
	display: flex;
	flex-direction: row; /* Force horizontal */
	justify-content: center;
	gap: 5px;
}
.pagination-container .page-item .page-link {
	border-radius: 50%; /* Circular buttons */
	width: 36px;
	height: 36px;
	padding: 0;
	display: flex;
	align-items: center;
	justify-content: center;
	color: #6c757d;
	border: 1px solid #dee2e6;
	margin: 0;
	transition: all 0.2s;
}
.pagination-container .page-item.active .page-link {
	background-color: #667eea;
	border-color: #667eea;
	color: white;
	box-shadow: 0 2px 5px rgba(102, 126, 234, 0.4);
}
.pagination-container .page-item .page-link:hover:not(.active) {
	background-color: #e9ecef;
	color: #495057;
}

/* Mobile Adjustments */
@media (max-width: 768px) {
	.pagination-container .pagination {
		flex-wrap: wrap;
	}
}

</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Feather Icons
		if (typeof feather !== 'undefined') {
			feather.replace();
		}

		// Instant JS Filter (Enhanced to search EVERYTHING)
		const searchInput = document.getElementById('instantSearch');
		const tableRows = document.querySelectorAll('#usersTable tbody tr.user-row');
		const mobileItems = document.querySelectorAll('#mobileUserList .user-item');

		if(searchInput) {
			searchInput.addEventListener('keyup', function() {
				const query = this.value.toLowerCase().trim();
				
				// Filter Table Rows
				if(tableRows.length > 0) {
					tableRows.forEach(row => {
						// Search the entire text content of the row
						const rowText = row.innerText.toLowerCase();
						
						if(rowText.includes(query)) {
							row.style.display = '';
						} else {
							row.style.display = 'none';
						}
					});
				}

				// Filter Mobile Cards
				if(mobileItems.length > 0) {
					mobileItems.forEach(item => {
						// Search the entire text content of the card
						const itemText = item.innerText.toLowerCase();
						
						if(itemText.includes(query)) {
							item.style.display = '';
						} else {
							item.style.display = 'none';
						}
					});
				}
			});
		}
	});
</script>

@include('dashboard.footer')
