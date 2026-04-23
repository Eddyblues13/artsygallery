@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="page-header mb-4">
			<div
				class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
				<div>
					<h1 class="h3 mb-1 text-dark fw-bold">
						<i class="align-middle me-2 text-primary" data-feather="users"></i>All Users
					</h1>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 small">
							<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
									class="text-decoration-none">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Users</li>
						</ol>
					</nav>
				</div>
				<div class="d-flex gap-2 w-100 w-md-auto page-actions">
					<a href="{{ route('view.users') }}" class="btn btn-light border border-light-subtle shadow-sm"
						title="Refresh" data-ajax-filter-link="#admin-users-results">
						<i class="align-middle" data-feather="refresh-cw"></i>
					</a>
					<button class="btn btn-primary shadow-sm rounded-pill px-4" type="button" data-bs-toggle="collapse"
						data-bs-target="#filtersCollapse"
						aria-expanded="{{ request()->hasAny(['search', 'status', 'wallet_verify', 'kyc_status', 'date_from', 'date_to']) ? 'true' : 'false' }}">
						<i class="align-middle me-2" data-feather="filter"></i> Filters
					</button>
				</div>
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
		<div class="row mb-4 g-3">
			<div class="col-sm-6 col-xl-3">
				<div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
					<div class="card-body p-4">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h6 class="text-muted text-uppercase fw-bold small mb-2">Total Users</h6>
								<h3 class="fw-bold text-dark mb-0">{{ number_format($stats['total']) }}</h3>
							</div>
							<div class="icon-shape bg-primary text-white">
								<i class="align-middle" data-feather="users"></i>
							</div>
						</div>
					</div>
					<div class="stat-card-bar bg-primary"></div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
					<div class="card-body p-4">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h6 class="text-muted text-uppercase fw-bold small mb-2">Active Users</h6>
								<h3 class="fw-bold text-dark mb-0">{{ number_format($stats['active']) }}</h3>
								<small class="text-muted">{{ number_format($stats['inactive']) }} Inactive</small>
							</div>
							<div class="icon-shape bg-success text-white">
								<i class="align-middle" data-feather="user-check"></i>
							</div>
						</div>
					</div>
					<div class="stat-card-bar bg-success"></div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
					<div class="card-body p-4">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h6 class="text-muted text-uppercase fw-bold small mb-2">Wallet Verified</h6>
								<h3 class="fw-bold text-dark mb-0">{{ number_format($stats['wallet_verified']) }}</h3>
							</div>
							<div class="icon-shape bg-info text-white">
								<i class="align-middle" data-feather="shield"></i>
							</div>
						</div>
					</div>
					<div class="stat-card-bar bg-info"></div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
					<div class="card-body p-4">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<h6 class="text-muted text-uppercase fw-bold small mb-2">KYC Approved</h6>
								<h3 class="fw-bold text-dark mb-0">{{ number_format($stats['kyc_approved']) }}</h3>
								<small class="text-muted">{{ number_format($stats['kyc_pending']) }} Pending</small>
							</div>
							<div class="icon-shape bg-warning text-white">
								<i class="align-middle" data-feather="file-check"></i>
							</div>
						</div>
					</div>
					<div class="stat-card-bar bg-warning"></div>
				</div>
			</div>
		</div>

		<!-- Advanced Filters (Server-side) -->
		<div class="collapse mb-4 {{ request()->hasAny(['search', 'status', 'wallet_verify', 'kyc_status', 'date_from', 'date_to']) ? 'show' : '' }}"
			id="filtersCollapse">
			<div class="card border-0 shadow-sm">
				<div class="card-header bg-gradient border-0 py-4">
					<h5 class="card-title mb-0 text-white fw-bold d-flex align-items-center gap-2">
						<i class="align-middle" data-feather="sliders"></i> Advanced Filtering
					</h5>
				</div>
				<div class="card-body p-4">
					<form method="GET" action="{{ route('view.users') }}" class="row g-4"
						data-ajax-filter="#admin-users-results">
						<div class="col-12 col-md-6 col-lg-3">
							<label for="search" class="form-label small text-uppercase fw-bold text-muted">Global
								Search</label>
							<div class="input-group input-group-lg">
								<span class="input-group-text bg-light border-0"><i class="align-middle text-muted"
										data-feather="search"></i></span>
								<input type="text" class="form-control border-0 bg-light" id="search" name="search"
									value="{{ request('search') }}" placeholder="Name, email...">
							</div>
						</div>
						<div class="col-12 col-md-6 col-lg-2">
							<label for="status"
								class="form-label small text-uppercase fw-bold text-muted">Status</label>
							<select class="form-select form-select-lg bg-light border-0" id="status" name="status">
								<option value="">All Status</option>
								<option value="1" {{ request('status')=='1' ? 'selected' : '' }}>Active</option>
								<option value="0" {{ request('status')=='0' ? 'selected' : '' }}>Inactive</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-lg-2">
							<label for="wallet_verify"
								class="form-label small text-uppercase fw-bold text-muted">Wallet</label>
							<select class="form-select form-select-lg bg-light border-0" id="wallet_verify"
								name="wallet_verify">
								<option value="">All</option>
								<option value="1" {{ request('wallet_verify')=='1' ? 'selected' : '' }}>Verified
								</option>
								<option value="0" {{ request('wallet_verify')=='0' ? 'selected' : '' }}>Unverified
								</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-lg-2">
							<label for="kyc_status"
								class="form-label small text-uppercase fw-bold text-muted">KYC</label>
							<select class="form-select form-select-lg bg-light border-0" id="kyc_status"
								name="kyc_status">
								<option value="">All</option>
								<option value="0" {{ request('kyc_status')=='0' ? 'selected' : '' }}>Pending</option>
								<option value="1" {{ request('kyc_status')=='1' ? 'selected' : '' }}>Approved</option>
								<option value="2" {{ request('kyc_status')=='2' ? 'selected' : '' }}>Declined</option>
							</select>
						</div>
						<div class="col-12 col-md-6 col-lg-3">
							<label class="form-label small text-uppercase fw-bold text-muted">Date Range</label>
							<div class="input-group input-group-lg">
								<input type="date" class="form-control bg-light border-0" name="date_from"
									value="{{ request('date_from') }}" title="From">
								<span class="input-group-text border-0 bg-light text-muted">to</span>
								<input type="date" class="form-control bg-light border-0" name="date_to"
									value="{{ request('date_to') }}" title="To">
							</div>
						</div>
						<div class="col-12 d-flex justify-content-end gap-3 mt-3">
							@if(request()->hasAny(['search', 'status', 'wallet_verify', 'kyc_status', 'date_from',
							'date_to']))
							<a href="{{ route('view.users') }}" class="btn btn-light text-muted border"
								data-ajax-filter-link="#admin-users-results">
								<i class="align-middle me-2" data-feather="x"></i> Clear Filters
							</a>
							@endif
							<button type="submit" class="btn btn-primary px-5 rounded-pill">
								<i class="align-middle me-2" data-feather="search"></i> Apply Filters
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Users List Card -->
		<div class="card border-0 shadow-sm" id="admin-users-results" data-ajax-container>
			<div
				class="card-header bg-gradient border-0 py-4 px-4 d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
				<h5 class="card-title mb-0 fw-bold text-white d-flex align-items-center gap-2">
					<i class="align-middle" data-feather="list"></i> Users Directory
				</h5>

				<!-- Instant JS Search -->
				<div class="position-relative quick-search-wrap w-lg-auto">
					<input type="text" id="instantSearch"
						class="form-control rounded-pill ps-5 bg-white border-0 shadow-sm"
						placeholder="Quick search...">
					<div class="position-absolute top-50 start-0 translate-middle-y ps-4 text-muted">
						<i class="align-middle" data-feather="search" width="16" height="16"></i>
					</div>
				</div>
			</div>

			<div class="card-body p-0">
				<!-- Desktop Table View -->
				<div class="table-responsive d-none d-xl-block">
					<table class="table table-hover align-middle mb-0 modern-table" id="usersTable">
						<thead class="bg-light-subtle">
							<tr>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">User</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">Contact</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">Status</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">Wallet</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">KYC</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small">Registered</th>
								<th class="border-0 px-4 py-3 fw-bold text-muted text-uppercase small text-end">Actions
								</th>
							</tr>
						</thead>
						<tbody>
							@forelse($users as $user)
							<tr class="user-row border-bottom">
								<td class="px-4 py-3">
									<div class="d-flex align-items-center">
										@if($user->profile_picture)
										<img src="{{ $user->profile_picture }}" alt="{{ $user->name }}"
											class="rounded-circle me-3 shadow-sm border border-light"
											style="width: 40px; height: 40px; object-fit: cover;">
										@else
										<div class="avatar-initial rounded-circle bg-gradient-primary text-white d-flex align-items-center justify-content-center me-3 shadow-sm"
											style="width: 40px; height: 40px; font-weight: bold; font-size: 14px;">{{
											strtoupper(substr($user->name, 0, 1)) }}</div>
										@endif
										<div>
											<div class="fw-bold text-dark search-name">{{ $user->name }}</div>
											<div class="small text-muted">ID: #{{ $user->id }}</div>
										</div>
									</div>
								</td>
								<td class="px-4 py-3">
									<div class="d-flex flex-column">
										<a href="mailto:{{ $user->email }}"
											class="text-decoration-none small fw-medium search-email">{{ $user->email
											}}</a>
										@if($user->phone)
										<small class="text-muted search-phone">{{ $user->phone }}</small>
										@endif
									</div>
								</td>
								<td class="px-4 py-3">
									@if($user->is_activated == '1')
									<span class="badge bg-success rounded-pill px-3 py-2"><i class="align-middle me-1"
											data-feather="check" width="12"></i> Active</span>
									@else
									<span class="badge bg-warning rounded-pill px-3 py-2"><i class="align-middle me-1"
											data-feather="alert-circle" width="12"></i> Inactive</span>
									@endif
								</td>
								<td class="px-4 py-3">
									<div class="d-flex flex-column gap-1">
										@if($user->wallet_verify)
										<span
											class="badge bg-success bg-opacity-10 text-success rounded-pill w-auto align-self-start"><i
												class="align-middle me-1" data-feather="shield" width="12"></i>
											Verified</span>
										@else
										<span
											class="badge bg-danger bg-opacity-10 text-danger rounded-pill w-auto align-self-start"><i
												class="align-middle me-1" data-feather="shield-off" width="12"></i>
											Unverified</span>
										@endif

										@if($user->wallet_type)
										<small class="text-muted">
											{{ ucfirst($user->wallet_type) }}
											@if($user->wallet_linked)
											<i class="align-middle text-primary ms-1" data-feather="link" width="12"
												title="Linked"></i>
											@endif
										</small>
										@endif
									</div>
								</td>
								<td class="px-4 py-3">
									@if($user->id_card_status == '0')
									<span
										class="badge bg-warning bg-opacity-10 text-warning rounded-pill">Pending</span>
									@elseif($user->id_card_status == '1')
									<span
										class="badge bg-success bg-opacity-10 text-success rounded-pill">Approved</span>
									@elseif($user->id_card_status == '2')
									<span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">Declined</span>
									@else
									<span class="badge bg-light text-muted border rounded-pill">None</span>
									@endif
								</td>
								<td class="px-4 py-3">
									<div class="small text-muted">{{ $user->created_at->format('M d, Y') }}</div>
								</td>
								<td class="px-4 py-3 text-end">
									<div class="btn-group shadow-sm rounded-pill" role="group">
										<a href="{{ url('profile/' . $user->id) }}" class="btn btn-sm btn-primary"
											title="View Profile">
											<i class="align-middle" data-feather="eye" width="16"></i> <span
												class="d-none d-lg-inline-block small ms-1">View</span>
										</a>
										<a href="{{ url('delete/' . $user->id) }}" class="btn btn-sm btn-danger"
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
										<div class="bg-light rounded-circle p-4 mb-3">
											<i class="align-middle text-muted" data-feather="inbox" width="40"
												height="40"></i>
										</div>
										<h5 class="text-muted fw-bold">No users found</h5>
										<p class="text-muted small mb-0">Try adjusting your search or filters</p>
									</div>
								</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>

				<!-- Mobile/Laptop Card View -->
				<div class="d-xl-none p-4" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
					<div id="mobileUserList" class="row g-3">
						@forelse($users as $user)
						<div class="col-12 col-lg-6 user-item">
							<div class="card h-100 border-0 shadow-sm overflow-hidden modern-card">
								<div class="card-body p-4">
									<div class="d-flex justify-content-between align-items-start mb-3">
										<div class="d-flex align-items-center flex-1">
											@if($user->profile_picture)
											<img src="{{ $user->profile_picture }}" alt="{{ $user->name }}"
												class="rounded-circle me-3 shadow-sm border border-light"
												style="width: 45px; height: 45px; object-fit: cover;">
											@else
											<div class="avatar-initial rounded-circle bg-gradient-primary text-white d-flex align-items-center justify-content-center me-3 shadow-sm"
												style="width: 45px; height: 45px; font-weight: bold; font-size: 16px;">
												{{
												strtoupper(substr($user->name, 0, 1)) }}</div>
											@endif
											<div>
												<h6 class="mb-0 fw-bold text-dark search-name">{{ $user->name }}</h6>
												<small class="text-muted">#{{ $user->id }}</small>
											</div>
										</div>
										@if($user->is_activated == '1')
										<span class="badge bg-success rounded-pill py-2">Active</span>
										@else
										<span class="badge bg-warning rounded-pill py-2">Inactive</span>
										@endif
									</div>

									<div class="mb-3 pb-3 border-bottom">
										<div class="d-flex align-items-center mb-2">
											<i class="text-muted me-2" data-feather="mail" width="14"></i>
											<a href="mailto:{{ $user->email }}"
												class="text-decoration-none text-dark small search-email">{{
												$user->email
												}}</a>
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
											<div class="p-3 bg-light rounded-3 text-center">
												<small class="d-block text-uppercase text-muted fw-bold"
													style="font-size: 10px;">Wallet</small>
												@if($user->wallet_verify)
												<span class="text-success small fw-bold"><i class="me-1"
														data-feather="check"></i> Verified</span>
												@else
												<span class="text-danger small fw-bold"><i class="me-1"
														data-feather="x"></i> Unverified</span>
												@endif
											</div>
										</div>
										<div class="col-6">
											<div class="p-3 bg-light rounded-3 text-center">
												<small class="d-block text-uppercase text-muted fw-bold"
													style="font-size: 10px;">KYC</small>
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
										<a href="{{ url('profile/' . $user->id) }}"
											class="btn btn-primary btn-sm rounded-pill fw-bold">
											<i class="align-middle me-1" data-feather="eye"></i> View Profile
										</a>
										<a href="{{ url('delete/' . $user->id) }}"
											class="btn btn-danger btn-sm rounded-pill fw-bold"
											onclick="return confirm('Are you sure?')">
											<i class="align-middle me-1" data-feather="trash-2"></i> Delete
										</a>
									</div>
								</div>
								<div class="card-footer bg-light border-0 p-2 text-center">
									<small class="text-muted">Registered {{ $user->created_at->format('M d, Y')
										}}</small>
								</div>
							</div>
						</div>
						@empty
						<div class="col-12 text-center py-5">
							<p class="text-muted">No users found</p>
						</div>
						@endforelse
					</div>
				</div>

				<!-- Horizontal Pagination -->
				<div class="card-footer bg-light border-top p-4">
					@include('admin.partials.pagination', ['paginator' => $users, 'label' => 'users'])
				</div>
			</div>
		</div>
	</div>
</main>

<style>
	/* Modern Color Palette */
	:root {
		--primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		--success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
		--info-gradient: linear-gradient(135deg, #0093E9 0%, #80D0C7 100%);
		--warning-gradient: linear-gradient(135deg, #FA709A 0%, #FEE140 100%);
	}

	/* Page Header */
	.page-header {
		border-bottom: 1px solid rgba(0, 0, 0, 0.05);
		padding-bottom: 1.5rem;
	}

	/* Gradient Background for Headers */
	.bg-gradient {
		background: var(--primary-gradient) !important;
		color: white;
	}

	.card-header.bg-gradient {
		border-radius: 0.5rem 0.5rem 0 0 !important;
	}

	/* Modern Gradients */
	.bg-gradient-primary {
		background: var(--primary-gradient) !important;
	}

	.bg-gradient-success {
		background: var(--success-gradient) !important;
	}

	.bg-gradient-info {
		background: var(--info-gradient) !important;
	}

	.bg-gradient-warning {
		background: var(--warning-gradient) !important;
	}

	/* Stats Cards */
	.stat-card {
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		position: relative;
		overflow: hidden;
	}

	.stat-card:hover {
		transform: translateY(-8px);
		box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1) !important;
	}

	.stat-card-bar {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		height: 4px;
		width: 100%;
	}

	.icon-shape {
		width: 56px;
		height: 56px;
		display: flex;
		align-items: center;
		justify-content: center;
		border-radius: 12px;
		font-size: 24px;
	}

	/* Modern Card Styles */
	.card {
		transition: all 0.3s ease;
	}

	.modern-card {
		transition: all 0.3s ease;
	}

	.modern-card:hover {
		transform: translateY(-4px);
		box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
	}

	/* Table Styling */
	.modern-table {
		border-collapse: collapse;
	}

	.modern-table tbody tr {
		transition: all 0.2s ease;
	}

	.modern-table tbody tr:hover {
		background-color: rgba(102, 126, 234, 0.05) !important;
	}

	.modern-table thead {
		background-color: #f8f9fa !important;
	}

	.modern-table thead th {
		border-top: none !important;
		border-bottom: 2px solid #e9ecef !important;
	}

	/* Badge Styles */
	.badge {
		font-size: 0.75rem;
		font-weight: 600;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		padding: 0.4rem 0.8rem !important;
		transition: all 0.2s ease;
	}

	.badge:hover {
		transform: translateY(-2px);
	}

	/* Button Styles */
	.btn {
		transition: all 0.3s ease;
		font-weight: 500;
	}

	.btn-primary {
		background: var(--primary-gradient) !important;
		border: none;
	}

	.btn-primary:hover {
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4) !important;
	}

	.btn-success {
		background: var(--success-gradient) !important;
		border: none;
	}

	.btn-danger {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
		border: none;
	}

	.btn-danger:hover {
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4) !important;
	}

	/* Quick Search Wrap */
	.quick-search-wrap {
		min-width: 240px;
		max-width: 380px;
		transition: all 0.3s ease;
	}

	.quick-search-wrap input {
		transition: all 0.3s ease;
		font-weight: 500;
	}

	.quick-search-wrap input:focus {
		box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
		transform: translateY(-2px);
	}

	/* Filter Section */
	.card-header.bg-gradient~.card-body {
		padding: 2rem 2rem;
	}

	/* Input Groups */
	.input-group-lg .form-control,
	.input-group-lg .form-select {
		padding: 0.75rem 1rem;
		font-size: 0.95rem;
		border-radius: 0.5rem;
	}

	.form-control:focus,
	.form-select:focus {
		border-color: #667eea;
		box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
	}

	/* Light Subtle Background */
	.bg-light-subtle {
		background-color: #f8f9fa !important;
	}

	/* Responsive Design */
	@media (min-width: 992px) {
		#filtersCollapse {
			display: block !important;
			height: auto !important;
			visibility: visible !important;
		}

		.quick-search-wrap {
			max-width: 320px;
		}

		.w-lg-auto {
			width: auto !important;
		}
	}

	@media (max-width: 1199.98px) {
		.page-actions .btn {
			flex: 1 1 auto;
		}

		.quick-search-wrap {
			max-width: 100%;
		}
	}

	@media (max-width: 768px) {
		#instantSearch {
			font-size: 0.9rem;
		}

		.quick-search-wrap {
			max-width: 100%;
			min-width: 0;
		}

		.btn[title="Refresh"] {
			min-width: 44px;
		}

		.icon-shape {
			width: 48px;
			height: 48px;
			font-size: 20px;
		}

		.stat-card:hover {
			transform: translateY(-4px);
		}

		.modern-card:hover {
			transform: translateY(-2px);
		}

		.btn-group {
			width: 100%;
		}

		.btn-group .btn {
			flex: 1;
		}
	}

	/* Animation */
	@keyframes slideInUp {
		from {
			opacity: 0;
			transform: translateY(20px);
		}

		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	.card {
		animation: slideInUp 0.5s ease-out;
	}

	/* Card Footer */
	.card-footer {
		border-top: 1px solid rgba(0, 0, 0, 0.05);
	}
</style>

<script>
	(function () {
		function bindInstantSearch() {
			if (typeof feather !== 'undefined') {
				feather.replace();
			}

			const searchInput = document.getElementById('instantSearch');
			if (!searchInput || searchInput.dataset.bound === '1') {
				return;
			}

			searchInput.dataset.bound = '1';
			searchInput.addEventListener('input', function () {
				const query = this.value.toLowerCase().trim();
				const tableRows = document.querySelectorAll('#usersTable tbody tr.user-row');
				const mobileItems = document.querySelectorAll('#mobileUserList .user-item');

				tableRows.forEach(function (row) {
					const rowText = (row.innerText || '').toLowerCase();
					row.style.display = rowText.includes(query) ? '' : 'none';
				});

				mobileItems.forEach(function (item) {
					const itemText = (item.innerText || '').toLowerCase();
					item.style.display = itemText.includes(query) ? '' : 'none';
				});
			});
		}

		function bindLiveAjaxFilter() {
			const form = document.querySelector('form[data-ajax-filter="#admin-users-results"]');
			if (!form || form.dataset.liveBound === '1') {
				return;
			}

			form.dataset.liveBound = '1';
			let timer = null;

			const textInput = form.querySelector('input[name="search"]');
			if (textInput) {
				textInput.addEventListener('input', function () {
					clearTimeout(timer);
					timer = setTimeout(function () {
						form.requestSubmit();
					}, 350);
				});
			}

			form.querySelectorAll('select, input[type="date"]').forEach(function (el) {
				el.addEventListener('change', function () {
					form.requestSubmit();
				});
			});
		}

		document.addEventListener('DOMContentLoaded', function () {
			bindInstantSearch();
			bindLiveAjaxFilter();
		});

		document.addEventListener('ajax:content-updated', function () {
			bindInstantSearch();
			bindLiveAjaxFilter();
		});
	})();
</script>

@include('dashboard.footer')