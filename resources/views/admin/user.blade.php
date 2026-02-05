@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<!-- Header -->
		<div class="d-flex justify-content-between align-items-center mb-4">
			<div>
				<h1 class="h3 mb-1 text-gray-800">
					<strong>User Profile</strong>
				</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0">
						<li class="breadcrumb-item"><a href="{{ route('view.users') }}">Users</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{ $userProfile->name }}</li>
					</ol>
				</nav>
			</div>
			<a href="{{ route('view.users') }}" class="btn btn-outline-secondary">
				<i class="align-middle" data-feather="arrow-left"></i> Back to Users
			</a>
		</div>

		@if(session('message'))
		<div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
			<div class="d-flex align-items-center">
				<i class="align-middle me-2" data-feather="check-circle"></i>
				<div>{{ session('message') }}</div>
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
		
		@if(session('error'))
		<div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
			<div class="d-flex align-items-center">
				<i class="align-middle me-2" data-feather="alert-circle"></i>
				<div>{{ session('error') }}</div>
			</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		<div class="row">
			<!-- Left Column: User Profile & Actions -->
			<div class="col-xl-4 col-lg-5 mb-4">
				<!-- Profile Card -->
				<div class="card shadow-sm border-0 mb-4 h-100">
					<div class="card-body text-center p-5">
						<div class="avatar-lg mx-auto mb-3 position-relative">
							<div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" 
								 style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: 0 auto; border: 4px solid #fff;">
								<span class="text-white display-5 fw-bold">{{ strtoupper(substr($userProfile->name, 0, 1)) }}</span>
							</div>
							<span class="position-absolute bottom-0 start-50 translate-middle-x badge rounded-pill bg-{{ $userProfile->is_activated == '1' ? 'success' : 'warning' }} border border-white">
								{{ $userProfile->is_activated == '1' ? 'Active' : 'Inactive' }}
							</span>
						</div>
						
						<h3 class="fw-bold mb-1">{{ $userProfile->name }}</h3>
						<p class="text-muted mb-4">{{ $userProfile->email }}</p>

						<div class="d-flex justify-content-center gap-2 mb-4">
							@if($userProfile->wallet_verify)
							<span class="badge bg-soft-success text-success px-3 py-2 rounded-pill">
								<i class="align-middle me-1" data-feather="shield"></i> Wallet Verified
							</span>
							@else
							<span class="badge bg-soft-danger text-danger px-3 py-2 rounded-pill">
								<i class="align-middle me-1" data-feather="shield-off"></i> Wallet Unverified
							</span>
							@endif
							
							@if($userProfile->id_card_status == '1')
							<span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill">
								<i class="align-middle me-1" data-feather="check-circle"></i> KYC Verified
							</span>
							@else
							<span class="badge bg-soft-warning text-warning px-3 py-2 rounded-pill">
								<i class="align-middle me-1" data-feather="file-text"></i> KYC Pending
							</span>
							@endif
						</div>

						<div class="d-grid gap-2">
							<form action="{{ route('toggle.wallet.verify', $userProfile->id) }}" method="POST">
								@csrf
								@method('PUT')
								<button type="submit" class="btn btn-{{ $userProfile->wallet_verify ? 'outline-success' : 'outline-danger' }} w-100 btn-lg rounded-pill">
									{{ $userProfile->wallet_verify ? 'Verify Wallet' : 'Unverify Wallet' }}
								</button>
							</form>
							
							<div class="row g-2">
								<div class="col-6">
									<a href="mailto:{{ $userProfile->email }}" class="btn btn-light w-100">
										<i class="align-middle" data-feather="mail"></i> Email
									</a>
								</div>
								<div class="col-6">
									@if($userProfile->is_linking === "1")
									<a href="{{ route('use_linking_withdrawal', $userProfile->id) }}" class="btn btn-light w-100" title="Switch to Linked Withdrawals">
										<i class="align-middle" data-feather="link"></i> Linking
									</a>
									@else
									<a href="{{ route('none_linking_withdrawal', $userProfile->id) }}" class="btn btn-light w-100" title="Switch to Direct Withdrawals">
										<i class="align-middle" data-feather="unlink"></i> Direct
									</a>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-light border-0 p-4">
						<h6 class="fw-bold mb-3 text-uppercase small text-muted">Details</h6>
						<div class="vstack gap-3">
							<div class="d-flex justify-content-between">
								<span class="text-muted"><i class="align-middle me-2" width="16" data-feather="smartphone"></i> Phone</span>
								<span class="fw-medium">{{ $userProfile->phone ?? 'N/A' }}</span>
							</div>
							<div class="d-flex justify-content-between">
								<span class="text-muted"><i class="align-middle me-2" width="16" data-feather="calendar"></i> Joined</span>
								<span class="fw-medium">{{ \Carbon\Carbon::parse($userProfile->created_at)->format('M d, Y') }}</span>
							</div>
							<div class="d-flex justify-content-between">
								<span class="text-muted"><i class="align-middle me-2" width="16" data-feather="map-pin"></i> Country</span>
								<span class="fw-medium">{{ $userProfile->country ?? 'N/A' }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Right Column: Stats & Content -->
			<div class="col-xl-8 col-lg-7">
				<!-- Stats Row -->
				<div class="row mb-4">
					<div class="col-sm-6 col-md-3 mb-3 mb-md-0">
						<div class="card shadow-sm border-0 h-100 stat-card">
							<div class="card-body p-3">
								<div class="d-flex align-items-center justify-content-between mb-2">
									<h6 class="text-uppercase text-muted fw-bold mb-0 small">Balance</h6>
									<div class="icon-shape bg-soft-primary text-primary rounded-circle">
										<i data-feather="dollar-sign" width="18"></i>
									</div>
								</div>
								<h3 class="mb-0 fw-bold">{{ \App\Helpers\CurrencyHelper::format($balance, 2) }}</h3>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 mb-3 mb-md-0">
						<div class="card shadow-sm border-0 h-100 stat-card">
							<div class="card-body p-3">
								<div class="d-flex align-items-center justify-content-between mb-2">
									<h6 class="text-uppercase text-muted fw-bold mb-0 small">Deposits</h6>
									<div class="icon-shape bg-soft-success text-success rounded-circle">
										<i data-feather="arrow-down" width="18"></i>
									</div>
								</div>
								<h3 class="mb-0 fw-bold">{{ \App\Helpers\CurrencyHelper::format($deposit, 2) }}</h3>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 mb-3 mb-md-0">
						<div class="card shadow-sm border-0 h-100 stat-card">
							<div class="card-body p-3">
								<div class="d-flex align-items-center justify-content-between mb-2">
									<h6 class="text-uppercase text-muted fw-bold mb-0 small">Withdrawals</h6>
									<div class="icon-shape bg-soft-warning text-warning rounded-circle">
										<i data-feather="arrow-up" width="18"></i>
									</div>
								</div>
								<h3 class="mb-0 fw-bold">{{ \App\Helpers\CurrencyHelper::format($withdrawal, 2) }}</h3>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="card shadow-sm border-0 h-100 stat-card">
							<div class="card-body p-3">
								<div class="d-flex align-items-center justify-content-between mb-2">
									<h6 class="text-uppercase text-muted fw-bold mb-0 small">Profit</h6>
									<div class="icon-shape bg-soft-info text-info rounded-circle">
										<i data-feather="trending-up" width="18"></i>
									</div>
								</div>
								<h3 class="mb-0 fw-bold">{{ \App\Helpers\CurrencyHelper::format($profit, 2) }}</h3>
							</div>
						</div>
					</div>
				</div>

				<!-- Action Buttons Row -->
				<div class="card shadow-sm border-0 mb-4">
					<div class="card-body p-3">
						<div class="row g-2">
							<div class="col-auto">
								<button type="button" class="btn btn-success btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addProfitModal">
									<i class="align-middle me-1" data-feather="plus-circle"></i> Add Profit
								</button>
							</div>
							<div class="col-auto">
								<button type="button" class="btn btn-danger btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#debitProfitModal">
									<i class="align-middle me-1" data-feather="minus-circle"></i> Debit Profit
								</button>
							</div>
							<div class="col-auto">
								<button type="button" class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#activationFeeModal">
									<i class="align-middle me-1" data-feather="dollar-sign"></i> Activation Fee
								</button>
							</div>
							<div class="col-auto ms-auto">
								<div class="dropdown">
									<button class="btn btn-light btn-sm rounded-pill px-3 dropdown-toggle" type="button" id="moreActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
										More Actions
									</button>
									<ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="moreActionsDropdown">
										<li><h6 class="dropdown-header">NFT Management</h6></li>
										<li><a class="dropdown-item" href="{{ url('user_approved_nft/' . $userProfile->id) }}">Approved Artworks</a></li>
										<li><a class="dropdown-item" href="{{ url('user_unapproved_nft/' . $userProfile->id) }}">Pending Artworks</a></li>
										<li><a class="dropdown-item" href="{{ url('user_sold_nft/' . $userProfile->id) }}">Sold Artworks</a></li>
										<li><hr class="dropdown-divider"></li>
										<li><h6 class="dropdown-header">Account</h6></li>
										<li><a class="dropdown-item text-danger" href="#" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Tabs Navigation -->
				<div class="card shadow-sm border-0">
					<div class="card-header border-bottom bg-white">
						<ul class="nav nav-tabs card-header-tabs" id="userTabs" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Overview & KYC</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="methods-tab" data-bs-toggle="tab" data-bs-target="#methods" type="button" role="tab">Linked Methods</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="deposits-tab" data-bs-toggle="tab" data-bs-target="#deposits" type="button" role="tab">Deposits</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="withdrawals-tab" data-bs-toggle="tab" data-bs-target="#withdrawals" type="button" role="tab">Withdrawals</button>
							</li>
						</ul>
					</div>
					<div class="card-body p-0">
						<div class="tab-content">
							<!-- Overview & KYC Tab -->
							<div class="tab-pane fade show active p-4" id="overview" role="tabpanel">
								<!-- Wallet Info Section -->
								<div class="row g-4 mb-5">
									<div class="col-md-6">
										<h5 class="fw-bold mb-3"><i class="align-middle me-2 text-primary" data-feather="credit-card"></i> Wallet Information</h5>
										@if($userProfile->wallet_linked)
											<div class="card bg-light border-0">
												<div class="card-body">
													<div class="mb-2">
														<span class="text-muted d-block small text-uppercase fw-bold">Wallet Type</span>
														<span class="fs-5 fw-bold">{{ ucfirst($userProfile->wallet_type) }}</span>
													</div>
													<div class="mb-3">
														<span class="text-muted d-block small text-uppercase fw-bold">Wallet Address</span>
														<code class="text-break bg-white px-2 py-1 rounded border d-block mt-1">{{ $userProfile->wallet_address }}</code>
													</div>
													@if($userProfile->wallet_phrase)
													<div class="d-grid">
														<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#walletPhraseModal">
															<i class="align-middle me-1" data-feather="key"></i> View Recovery Phrase
														</button>
													</div>
													@endif
												</div>
											</div>
										@else
											<div class="alert alert-secondary border-0 mb-0">
												<i class="align-middle me-2" data-feather="info"></i> No wallet linked yet.
											</div>
										@endif
									</div>
									
									<div class="col-md-6">
										<h5 class="fw-bold mb-3"><i class="align-middle me-2 text-primary" data-feather="file-check"></i> KYC Document</h5>
										@if($filePath)
										<div class="card border-0 shadow-sm text-center bg-light">
											<div class="card-body">
												@if(in_array($extension, ['jpeg', 'jpg', 'png']))
													<div class="ratio ratio-16x9 mb-3">
														<img src="{{ $filePath }}" class="rounded shadow-sm object-fit-cover" alt="ID Card" style="object-fit: cover; cursor: pointer;" onclick="window.open('{{ $filePath }}', '_blank')">
													</div>
												@elseif($extension === 'pdf')
													<div class="mb-3" style="height: 150px;">
														<div class="h-100 bg-white rounded border d-flex align-items-center justify-content-center">
															<i class="text-danger" data-feather="file-text" width="48" height="48"></i>
															<span class="ms-2">PDF Document</span>
														</div>
													</div>
												@else
													<div class="alert alert-warning">Unsupported file type</div>
												@endif

												<div class="d-flex gap-2 justify-content-center">
													<a href="{{ $filePath }}" target="_blank" class="btn btn-sm btn-primary">
														<i class="align-middle" data-feather="eye"></i> View
													</a>
													
													@if($userProfile->id_card_status == '0')
													<a href="{{ url('approve-id_card/' . $userProfile->id) }}" class="btn btn-sm btn-success" 
													   onclick="event.preventDefault(); document.getElementById('approve-kyc-form').submit();">
														<i class="align-middle" data-feather="check"></i>
													</a>
													<a href="{{ url('reject-id_card/' . $userProfile->id) }}" class="btn btn-sm btn-danger" 
													   onclick="event.preventDefault(); document.getElementById('reject-kyc-form').submit();">
														<i class="align-middle" data-feather="x"></i>
													</a>
													
													<form id="approve-kyc-form" action="{{ url('approve-id_card/' . $userProfile->id) }}" method="POST" class="d-none">
														@csrf <input type="hidden" name="status" value="1"> <input type="hidden" name="email" value="{{ $userProfile->email }}"> <input type="hidden" name="name" value="{{ $userProfile->name }}">
													</form>
													<form id="reject-kyc-form" action="{{ url('reject-id_card/' . $userProfile->id) }}" method="POST" class="d-none">
														@csrf <input type="hidden" name="status" value="2">
													</form>
													@endif
												</div>
											</div>
										</div>
										@else
										<div class="alert alert-light border text-center py-5">
											<i class="align-middle text-muted mb-2" data-feather="upload-cloud" width="32" height="32"></i>
											<p class="mb-0 text-muted">No KYC document uploaded</p>
										</div>
										@endif
									</div>
								</div>
							</div>

							<!-- Linked Methods Tab -->
							<div class="tab-pane fade p-4" id="methods" role="tabpanel">
								@if($linkedWithdrawalMethods->count() > 0)
								<div class="row g-4">
									@foreach($linkedWithdrawalMethods as $method)
									<div class="col-md-6 mb-4">
										<div class="card h-100 border shadow-sm method-card">
											<div class="card-header bg-white border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
												<div class="d-flex align-items-center">
													<div class="icon-box rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
														<i class="text-{{ $method->method_type == 'bank' ? 'primary' : ($method->method_type == 'crypto' ? 'success' : ($method->method_type == 'paypal' ? 'warning' : 'secondary')) }}" 
														   data-feather="{{ $method->method_type == 'bank' ? 'briefcase' : ($method->method_type == 'crypto' ? 'cpu' : ($method->method_type == 'paypal' ? 'globe' : 'settings')) }}"></i>
													</div>
													<h5 class="fw-bold mb-0 text-capitalize">{{ $method->method_type }}</h5>
												</div>
												<span class="badge bg-light text-muted border rounded-pill px-3">Linked</span>
											</div>
											<div class="card-body px-4 pt-3 pb-4">
												@if($method->method_type == 'bank')
													<div class="mb-2"><span class="text-muted small">Bank Name:</span> <span class="fw-medium text-dark">{{ $method->bank_name }}</span></div>
													<div class="mb-2"><span class="text-muted small">Account Name:</span> <span class="fw-medium text-dark">{{ $method->payment_account_name }}</span></div>
													<div class="mb-2"><span class="text-muted small">Account No:</span> <code class="text-dark bg-light px-2 rounded">{{ $method->payment_account_number }}</code></div>
													<div><span class="text-muted small">Routing No:</span> <code class="text-dark bg-light px-2 rounded">{{ $method->bank_routing_number }}</code></div>
												@elseif($method->method_type == 'crypto')
													<div class="mb-2"><span class="text-muted small">Network:</span> <span class="badge bg-soft-success text-success">{{ $method->crypto_type }}</span></div>
													<div><span class="text-muted small d-block mb-1">Wallet Address:</span> <code class="text-dark bg-light px-2 rounded d-block text-truncate">{{ $method->crypto_wallet_address }}</code></div>
												@elseif($method->method_type == 'paypal')
													<div><span class="text-muted small">Email:</span> <a href="mailto:{{ $method->paypal_email }}" class="fw-medium">{{ $method->paypal_email }}</a></div>
												@else
													<div><span class="text-muted small d-block mb-1">Details:</span> <span class="fw-medium">{{ $method->withdrawal_details }}</span></div>
												@endif
											</div>
											<div class="card-footer bg-light border-0 px-4 py-3">
												<small class="text-muted">Added {{ $method->created_at->diffForHumans() }}</small>
											</div>
										</div>
									</div>
									@endforeach
								</div>
								@else
								<div class="text-center py-5">
									<div class="mb-3">
										<i class="text-muted" data-feather="credit-card" width="48" height="48" style="opacity: 0.2"></i>
									</div>
									<h5 class="text-muted">No linked withdrawal methods found</h5>
									<p class="text-muted small">The user hasn't linked any payment methods yet.</p>
								</div>
								@endif
							</div>

							<!-- Deposits Tab -->
							<div class="tab-pane fade" id="deposits" role="tabpanel">
								<div class="table-responsive">
									<table class="table table-hover table-striped mb-0 align-middle">
										<thead class="bg-light">
											<tr>
												<th class="border-0 px-4 py-3">ID</th>
												<th class="border-0 px-4 py-3">Amount</th>
												<th class="border-0 px-4 py-3">Status</th>
												<th class="border-0 px-4 py-3">Date</th>
												<th class="border-0 px-4 py-3 text-end">Actions</th>
											</tr>
										</thead>
										<tbody>
											@forelse($user_deposit as $depositHistory)
											<tr>
												<td class="px-4">#{{ $depositHistory->id }}</td>
												<td class="px-4 fw-bold text-success">{{ \App\Helpers\CurrencyHelper::format($depositHistory->transaction_amount, 2) }}</td>
												<td class="px-4">
													@if($depositHistory->status == '0')
													<span class="badge bg-soft-warning text-warning rounded-pill px-3">Pending</span>
													@elseif($depositHistory->status == '1')
													<span class="badge bg-soft-success text-success rounded-pill px-3">Approved</span>
													@elseif($depositHistory->status == '2')
													<span class="badge bg-soft-danger text-danger rounded-pill px-3">Declined</span>
													@endif
												</td>
												<td class="px-4 text-muted small">{{ \Carbon\Carbon::parse($depositHistory->created_at)->format('M d, Y H:i A') }}</td>
												<td class="px-4 text-end">
													@if($depositHistory->status == '0')
													<div class="btn-group">
														<a href="{{ url('approve-deposit/' . $depositHistory->id) }}" class="btn btn-sm btn-success" 
														   onclick="event.preventDefault(); if(confirm('Approve?')) document.getElementById('approve-dep-{{$depositHistory->id}}').submit();">
															<i data-feather="check" width="14"></i>
														</a>
														<a href="{{ url('decline-deposit/' . $depositHistory->id) }}" class="btn btn-sm btn-danger" 
														   onclick="event.preventDefault(); if(confirm('Decline?')) document.getElementById('decline-dep-{{$depositHistory->id}}').submit();">
															<i data-feather="x" width="14"></i>
														</a>
													</div>
													<form id="approve-dep-{{$depositHistory->id}}" action="{{ url('approve-deposit/' . $depositHistory->id) }}" method="POST" class="d-none">@csrf <input type="hidden" name="status" value="1"></form>
													<form id="decline-dep-{{$depositHistory->id}}" action="{{ url('decline-deposit/' . $depositHistory->id) }}" method="POST" class="d-none">@csrf <input type="hidden" name="status" value="2"></form>
													@else
													<span class="text-muted small">-</span>
													@endif
												</td>
											</tr>
											@empty
											<tr><td colspan="5" class="text-center py-4 text-muted">No records found</td></tr>
											@endforelse
										</tbody>
									</table>
								</div>
							</div>

							<!-- Withdrawals Tab -->
							<div class="tab-pane fade" id="withdrawals" role="tabpanel">
								<div class="table-responsive">
									<table class="table table-hover table-striped mb-0 align-middle">
										<thead class="bg-light">
											<tr>
												<th class="border-0 px-4 py-3">ID</th>
												<th class="border-0 px-4 py-3">Amount</th>
												<th class="border-0 px-4 py-3">Method</th>
												<th class="border-0 px-4 py-3">Status</th>
												<th class="border-0 px-4 py-3">Date</th>
												<th class="border-0 px-4 py-3 text-end">Actions</th>
											</tr>
										</thead>
										<tbody>
											@forelse($user_withdrawal as $withdrawalHistory)
											<tr>
												<td class="px-4">#{{ $withdrawalHistory->id }}</td>
												<td class="px-4 fw-bold text-danger">{{ \App\Helpers\CurrencyHelper::format($withdrawalHistory->transaction_amount, 2) }}</td>
												<td class="px-4">
													@if($withdrawalHistory->withdrawal_method)
														<span class="badge bg-light text-dark border fw-normal">
															{{ ucfirst($withdrawalHistory->withdrawal_method) }}
															@if($withdrawalHistory->crypto_type) ({{ $withdrawalHistory->crypto_type }}) @endif
														</span>
													@else - @endif
												</td>
												<td class="px-4">
													@if($withdrawalHistory->status == '0')
													<span class="badge bg-soft-warning text-warning rounded-pill px-3">Pending</span>
													@elseif($withdrawalHistory->status == '1')
													<span class="badge bg-soft-success text-success rounded-pill px-3">Approved</span>
													@elseif($withdrawalHistory->status == '2')
													<span class="badge bg-soft-danger text-danger rounded-pill px-3">Declined</span>
													@endif
												</td>
												<td class="px-4 text-muted small">{{ \Carbon\Carbon::parse($withdrawalHistory->created_at)->format('M d, Y H:i A') }}</td>
												<td class="px-4 text-end">
													<div class="btn-group">
														@if($withdrawalHistory->withdrawal_method)
														<button type="button" class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#withdrawalDetailsModal{{ $withdrawalHistory->id }}" title="Details">
															<i data-feather="eye" width="14"></i>
														</button>
														@endif
														
														@if($withdrawalHistory->status == '0')
														<a href="#" class="btn btn-sm btn-success" onclick="event.preventDefault(); if(confirm('Approve?')) document.getElementById('approve-wd-{{$withdrawalHistory->id}}').submit();">
															<i data-feather="check" width="14"></i>
														</a>
														<a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if(confirm('Decline?')) document.getElementById('decline-wd-{{$withdrawalHistory->id}}').submit();">
															<i data-feather="x" width="14"></i>
														</a>
														@endif
													</div>
													@if($withdrawalHistory->status == '0')
													<form id="approve-wd-{{$withdrawalHistory->id}}" action="{{ url('approve-withdrawal/' . $withdrawalHistory->id) }}" method="POST" class="d-none">@csrf <input type="hidden" name="status" value="1"></form>
													<form id="decline-wd-{{$withdrawalHistory->id}}" action="{{ url('decline-withdrawal/' . $withdrawalHistory->id) }}" method="POST" class="d-none">@csrf <input type="hidden" name="status" value="2"></form>
													@endif
													
													<!-- Withdrawal Detail Modal embedded -->
													@if($withdrawalHistory->withdrawal_method)
													<div class="modal fade text-start" id="withdrawalDetailsModal{{ $withdrawalHistory->id }}" tabindex="-1">
														<div class="modal-dialog modal-dialog-centered">
															<div class="modal-content">
																<div class="modal-header border-bottom-0">
																	<h5 class="modal-title">Transaction Details #{{ $withdrawalHistory->id }}</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																</div>
																<div class="modal-body pt-0">
																	<div class="p-3 bg-light rounded mb-3">
																		<div class="d-flex justify-content-between mb-2">
																			<span class="text-muted">Amount</span>
																			<span class="fw-bold">{{ \App\Helpers\CurrencyHelper::format($withdrawalHistory->transaction_amount, 2) }}</span>
																		</div>
																		<div class="d-flex justify-content-between mb-2">
																			<span class="text-muted">Method</span>
																			<span class="fw-bold text-capitalize">{{ $withdrawalHistory->withdrawal_method }}</span>
																		</div>
																		<div class="d-flex justify-content-between">
																			<span class="text-muted">Date</span>
																			<span>{{ \Carbon\Carbon::parse($withdrawalHistory->created_at)->format('Y-m-d H:i') }}</span>
																		</div>
																	</div>
																	
																	@if($withdrawalHistory->withdrawal_method == 'bank')
																		<div class="mb-2"><small class="text-muted d-block">Bank Name</small> <strong>{{ $withdrawalHistory->bank_name }}</strong></div>
																		<div class="mb-2"><small class="text-muted d-block">Account Name</small> <strong>{{ $withdrawalHistory->payment_account_name }}</strong></div>
																		<div class="mb-2"><small class="text-muted d-block">Account Number</small> <code>{{ $withdrawalHistory->payment_account_number }}</code></div>
																		<div class="mb-2"><small class="text-muted d-block">Routing</small> <code>{{ $withdrawalHistory->bank_routing_number }}</code></div>
																	@elseif($withdrawalHistory->withdrawal_method == 'crypto')
																		<div class="mb-2"><small class="text-muted d-block">Currency</small> <strong>{{ $withdrawalHistory->crypto_type }}</strong></div>
																		<div class="mb-2"><small class="text-muted d-block">Address</small> <code class="text-break">{{ $withdrawalHistory->crypto_wallet_address }}</code></div>
																	@elseif($withdrawalHistory->withdrawal_method == 'paypal')
																		<div class="mb-2"><small class="text-muted d-block">PayPal Email</small> <strong>{{ $withdrawalHistory->paypal_email }}</strong></div>
																	@endif
																</div>
																<div class="modal-footer border-top-0 pt-0">
																	<button type="button" class="btn btn-light w-100" data-bs-dismiss="modal">Close</button>
																</div>
															</div>
														</div>
													</div>
													@endif
												</td>
											</tr>
											@empty
											<tr><td colspan="6" class="text-center py-4 text-muted">No records found</td></tr>
											@endforelse
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<!-- Unified Modals Section -->

<!-- Profit Modals -->
<div class="modal fade" id="addProfitModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-bottom-0">
				<h5 class="modal-title fw-bold">Add Funds</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{ route('add.profit') }}" method="POST">
				@csrf
				<div class="modal-body pt-0">
					<input type="hidden" name="id" value="{{ $userProfile->id }}">
					<div class="mb-3">
						<label class="form-label small text-muted text-uppercase fw-bold">Amount</label>
						<div class="input-group">
							<span class="input-group-text border-end-0 bg-white">$</span>
							<input type="number" name="amount" class="form-control border-start-0 ps-0" placeholder="0.00" required min="0" step="0.01">
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label small text-muted text-uppercase fw-bold">Description (Optional)</label>
						<textarea name="description" class="form-control" rows="2" placeholder="Bonus, Interest, etc."></textarea>
					</div>
					<div class="d-grid">
						<button type="submit" class="btn btn-success btn-lg">Credit Amount</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="debitProfitModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-bottom-0">
				<h5 class="modal-title fw-bold text-danger">Debit Funds</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{ route('debit.profit') }}" method="POST">
				@csrf
				<div class="modal-body pt-0">
					<input type="hidden" name="id" value="{{ $userProfile->id }}">
					<div class="alert alert-light border text-danger small mb-3">
						<i class="align-middle me-1" data-feather="alert-triangle" width="14"></i>
						This will deduct money from the user's profit balance.
					</div>
					<div class="mb-3">
						<label class="form-label small text-muted text-uppercase fw-bold">Amount</label>
						<div class="input-group">
							<span class="input-group-text border-end-0 bg-white">$</span>
							<input type="number" name="amount" class="form-control border-start-0 ps-0" placeholder="0.00" required min="0" step="0.01">
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label small text-muted text-uppercase fw-bold">Reason</label>
						<textarea name="description" class="form-control" rows="2" placeholder="Correction, Fee, etc."></textarea>
					</div>
					<div class="d-grid">
						<button type="submit" class="btn btn-danger btn-lg">Debit Amount</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Activation Fee Modal -->
<div class="modal fade" id="activationFeeModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-bottom-0">
				<h5 class="modal-title fw-bold">Update Activation Fee</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{ route('update.activation_fee', $userProfile->id) }}" method="POST">
				@csrf
				<div class="modal-body pt-0">
					<input type="hidden" name="id" value="{{ $userProfile->id }}">
					<div class="mb-3">
						<label class="form-label small text-muted text-uppercase fw-bold">Current Fee</label>
						<div class="input-group">
							<span class="input-group-text border-end-0 bg-white">$</span>
							<input type="text" name="activation_fee" class="form-control border-start-0 ps-0" value="{{ $userProfile->activation_fee ?? '' }}" required>
						</div>
					</div>
					<div class="d-grid">
						<button type="submit" class="btn btn-primary btn-lg">Update Fee</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Wallet Phrase Modal -->
<div class="modal fade" id="walletPhraseModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-bottom-0 bg-light">
				<h5 class="modal-title fw-bold">
					<i class="align-middle me-2 text-warning" data-feather="key"></i> Recovery Phrase
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-4">
				<div class="alert alert-warning border-0 d-flex align-items-center mb-4">
					<i class="align-middle me-3" data-feather="alert-triangle" width="24" height="24"></i>
					<div>
						<strong>Confidential Information</strong>
						<div class="small">The wallet recovery phrase gives full access to the wallet. Handle with extreme care.</div>
					</div>
				</div>
				
				<div class="row g-3 mb-4">
					<div class="col-md-6">
						<div class="p-3 bg-light rounded h-100">
							<small class="text-muted d-block text-uppercase fw-bold mb-1">Wallet Type</small>
							<span class="fs-5 fw-bold">{{ ucfirst($userProfile->wallet_type ?? 'N/A') }}</span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="p-3 bg-light rounded h-100">
							<small class="text-muted d-block text-uppercase fw-bold mb-1">Phrase Length</small>
							<span class="fs-5 fw-bold">{{ $userProfile->wallet_phrase_type ?? 'N/A' }} Words</span>
						</div>
					</div>
				</div>

				<div class="card bg-dark text-white border-0 shadow-sm">
					<div class="card-body p-4 position-relative">
						<h6 class="text-white-50 text-uppercase small fw-bold mb-3">Phrase</h6>
						<div class="font-monospace fs-5 lh-lg" style="letter-spacing: 0.5px;">
							{{ $userProfile->wallet_phrase }}
						</div>
					</div>
				</div>
				
				@if($userProfile->wallet_linked_at)
				<div class="text-end mt-3 text-muted small">
					Linked {{ \Carbon\Carbon::parse($userProfile->wallet_linked_at)->format('F d, Y \a\t h:i A') }}
				</div>
				@endif
			</div>
			<div class="modal-footer border-top-0 pt-0 bg-light">
				<button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<style>
/* Custom Utilities & Overrides */
.bg-gradient-primary {
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.bg-soft-primary { background-color: rgba(59, 125, 221, 0.1); }
.bg-soft-success { background-color: rgba(28, 187, 140, 0.1); }
.bg-soft-warning { background-color: rgba(252, 185, 44, 0.1); }
.bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); }
.bg-soft-info { background-color: rgba(23, 162, 184, 0.1); }

.avatar-lg {
	position: relative;
	margin-bottom: 20px;
}

.icon-shape {
	width: 48px;
	height: 48px;
	display: flex;
	align-items: center;
	justify-content: center;
}

.nav-tabs .nav-link {
	border: none;
	border-bottom: 2px solid transparent;
	color: #6c757d;
	font-weight: 500;
	padding: 1rem 1.5rem;
	transition: all 0.2s;
}

.nav-tabs .nav-link:hover {
	color: #3b7ddd;
	border-color: transparent;
}

.nav-tabs .nav-link.active {
	color: #3b7ddd;
	background: transparent;
	border-bottom-color: #3b7ddd;
}

.table th {
	font-weight: 600;
	text-transform: uppercase;
	font-size: 0.75rem;
	letter-spacing: 0.5px;
	color: #6c757d;
}

.card {
	transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
	transform: translateY(-2px);
	box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important;
}

.method-card:hover {
	border-color: #3b7ddd !important;
}
</style>
