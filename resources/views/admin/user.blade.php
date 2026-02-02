@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="h3 mb-0">
				<strong>User Profile</strong> - {{ $userProfile->name }}
			</h1>
			<a href="{{ route('view.users') }}" class="btn btn-outline-secondary">
				<i class="align-middle" data-feather="arrow-left"></i> Back to Users
			</a>
		</div>

		@if(session('message'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong><i class="align-middle" data-feather="check-circle"></i> Success!</strong> {{ session('message') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		@if(session('status'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong><i class="align-middle" data-feather="check-circle"></i> Success!</strong> {{ session('status') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		<!-- User Statistics Cards -->
		<div class="row mb-4">
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Balance</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-primary">
									<i class="align-middle" data-feather="dollar-sign"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($balance, 2) }}</b></h3>
						<div class="mb-0">
							<span class="text-muted">{{ number_format($balance_eth, 4) }} ETH</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Total Deposits</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-success">
									<i class="align-middle" data-feather="arrow-down"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($deposit, 2) }}</b></h3>
						<div class="mb-0">
							<span class="text-muted">{{ number_format($deposit_eth, 4) }} ETH</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Total Withdrawals</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-warning">
									<i class="align-middle" data-feather="arrow-up"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($withdrawal, 2) }}</b></h3>
						<div class="mb-0">
							<span class="text-muted">{{ number_format($withdrawal_eth, 4) }} ETH</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Total Profit</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-info">
									<i class="align-middle" data-feather="trending-up"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($profit, 2) }}</b></h3>
						<div class="mb-0">
							<span class="text-muted">{{ number_format($profit_eth, 4) }} ETH</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row g-4">
			<!-- User Profile Card -->
			<div class="col-lg-4 col-md-6">
				<div class="card shadow-sm">
					<div class="card-header bg-gradient-primary text-white">
						<h5 class="card-title mb-0">
							<i class="align-middle" data-feather="user"></i> User Information
						</h5>
					</div>
					<div class="card-body">
						<div class="text-center mb-4">
							<div class="avatar-lg mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
								<span style="font-size: 2rem; color: white; font-weight: bold;">{{ strtoupper(substr($userProfile->name, 0, 1)) }}</span>
							</div>
							<h4 class="mb-1">{{ $userProfile->name }}</h4>
							<p class="text-muted mb-3">{{ $userProfile->email }}</p>
						</div>

						<!-- Quick Actions -->
						<div class="d-grid gap-2 mb-4">
							@if($userProfile->is_linking === "1")
							<a href="{{ route('use_linking_withdrawal', $userProfile->id) }}" class="btn btn-success">
								<i class="align-middle" data-feather="link"></i> Use Linking Withdrawal
							</a>
							@elseif($userProfile->is_linking === "0")
							<a href="{{ route('none_linking_withdrawal', $userProfile->id) }}" class="btn btn-danger">
								<i class="align-middle" data-feather="unlink"></i> Use Non-Linking Withdrawal
							</a>
							@endif

							<form action="{{ route('toggle.wallet.verify', $userProfile->id) }}" method="POST">
								@csrf
								@method('PUT')
								<button type="submit" class="btn btn-{{ $userProfile->wallet_verify ? 'success' : 'danger' }} w-100">
									<i class="align-middle" data-feather="{{ $userProfile->wallet_verify ? 'shield' : 'shield-off' }}"></i>
									{{ $userProfile->wallet_verify ? 'Wallet Verified' : 'Wallet Not Verified' }}
								</button>
							</form>
						</div>

						<hr>

						<div class="list-group list-group-flush">
							<div class="list-group-item d-flex justify-content-between align-items-center px-0">
								<span><i class="align-middle me-2" data-feather="phone"></i> <strong>Phone:</strong></span>
								<span>{{ $userProfile->phone ?? 'N/A' }}</span>
							</div>
							<div class="list-group-item d-flex justify-content-between align-items-center px-0">
								<span><i class="align-middle me-2" data-feather="calendar"></i> <strong>Registered:</strong></span>
								<span>{{ \Carbon\Carbon::parse($userProfile->created_at)->format('M d, Y') }}</span>
							</div>
							<div class="list-group-item d-flex justify-content-between align-items-center px-0">
								<span><i class="align-middle me-2" data-feather="info"></i> <strong>Account Status:</strong></span>
								@if($userProfile->is_activated == '1')
								<span class="badge bg-success">Active</span>
								@else
								<span class="badge bg-warning text-dark">Inactive</span>
								@endif
							</div>
							<div class="list-group-item d-flex justify-content-between align-items-center px-0">
								<span><i class="align-middle me-2" data-feather="shield"></i> <strong>Wallet Status:</strong></span>
								@if($userProfile->wallet_verify)
								<span class="badge bg-success">Verified</span>
								@else
								<span class="badge bg-danger">Unverified</span>
								@endif
							</div>
							<div class="list-group-item d-flex justify-content-between align-items-center px-0">
								<span><i class="align-middle me-2" data-feather="file-check"></i> <strong>KYC Status:</strong></span>
								@if($userProfile->id_card_status == '0')
								<span class="badge bg-warning text-dark">Pending</span>
								@elseif($userProfile->id_card_status == '1')
								<span class="badge bg-success">Approved</span>
								@elseif($userProfile->id_card_status == '2')
								<span class="badge bg-danger">Declined</span>
								@else
								<span class="badge bg-secondary">Not Submitted</span>
								@endif
							</div>
							@if($userProfile->wallet_type)
							<div class="list-group-item d-flex justify-content-between align-items-center px-0">
								<span><i class="align-middle me-2" data-feather="wallet"></i> <strong>Wallet Type:</strong></span>
								<span class="badge bg-primary">{{ ucfirst($userProfile->wallet_type) }}</span>
							</div>
							@endif
							@if($userProfile->wallet_address)
							<div class="list-group-item px-0">
								<span><i class="align-middle me-2" data-feather="hash"></i> <strong>Wallet Address:</strong></span>
								<div class="mt-2">
									<code class="text-break small">{{ $userProfile->wallet_address }}</code>
								</div>
							</div>
							@endif
							@if($userProfile->wallet_linked)
							<div class="list-group-item d-flex justify-content-between align-items-center px-0">
								<span><i class="align-middle me-2" data-feather="link"></i> <strong>Wallet Linked:</strong></span>
								<span class="badge bg-success">Yes</span>
							</div>
							@if($userProfile->wallet_phrase)
							<div class="list-group-item px-0">
								<span><i class="align-middle me-2" data-feather="key"></i> <strong>Wallet Phrase ({{ $userProfile->wallet_phrase_type ?? 'N/A' }} words):</strong></span>
								<div class="mt-2">
									<button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#walletPhraseModal">
										<i class="align-middle" data-feather="eye"></i> View Wallet Phrase
									</button>
								</div>
							</div>
							@endif
							@if($userProfile->wallet_linked_at)
							<div class="list-group-item d-flex justify-content-between align-items-center px-0">
								<span><i class="align-middle me-2" data-feather="calendar"></i> <strong>Linked At:</strong></span>
								<span>{{ \Carbon\Carbon::parse($userProfile->wallet_linked_at)->format('M d, Y H:i A') }}</span>
							</div>
							@endif
							@endif

						</div>
					</div>
				</div>
			</div>

			<!-- KYC Approval Card -->
			<div class="col-lg-4 col-md-6">
				<div class="card shadow-sm h-100">
					<div class="card-header bg-primary text-white">
						<h5 class="card-title mb-0">
							<i class="align-middle" data-feather="file-check"></i> KYC Verification
						</h5>
					</div>
					<div class="card-body d-flex flex-column">
						@if($filePath)
						@if(in_array($extension, ['jpeg', 'jpg', 'png']))
						<div class="mb-4 text-center">
							<img src="{{ $filePath }}" class="img-fluid rounded border" alt="ID Card" style="max-height: 300px; cursor: pointer;" onclick="window.open('{{ $filePath }}', '_blank')">
						</div>
						@elseif($extension === 'pdf')
						<div class="mb-4 text-center" style="height: 300px;">
							<embed src="{{ $filePath }}" type="application/pdf" width="100%" height="100%" class="border rounded">
						</div>
						@else
						<div class="alert alert-warning">
							<p class="text-center text-muted mb-0">Unsupported file type.</p>
						</div>
						@endif
						@else
						<div class="alert alert-info">
							<p class="text-center text-muted mb-0">No KYC document uploaded.</p>
						</div>
						@endif

						<div class="mt-auto">
							@if($userProfile->id_card_status == '0')
							<div class="d-grid gap-2">
								<form action="{{ url('approve-id_card/' . $userProfile->id) }}" method="POST" class="d-inline">
									@csrf
									<input type="hidden" name="status" value="1">
									<input type="hidden" name="email" value="{{ $userProfile->email }}">
									<input type="hidden" name="name" value="{{ $userProfile->name }}">
									<button type="submit" class="btn btn-success btn-lg w-100" onclick="return confirm('Approve this KYC document?')">
										<i class="align-middle" data-feather="check-circle"></i> Approve KYC
									</button>
								</form>
								<form action="{{ url('reject-id_card/' . $userProfile->id) }}" method="POST" class="d-inline">
									@csrf
									<input type="hidden" name="status" value="2">
									<button type="submit" class="btn btn-danger btn-lg w-100" onclick="return confirm('Reject this KYC document?')">
										<i class="align-middle" data-feather="x-circle"></i> Reject KYC
									</button>
								</form>
							</div>
							@elseif($userProfile->id_card_status == '1')
							<div class="alert alert-success text-center mb-0">
								<i class="align-middle" data-feather="check-circle"></i> KYC Approved
							</div>
							@else
							<div class="alert alert-danger text-center mb-0">
								<i class="align-middle" data-feather="x-circle"></i> KYC Rejected
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>

			<!-- Management Actions Card -->
			<div class="col-lg-4 col-md-6">
				<div class="card shadow-sm h-100">
					<div class="card-header bg-info text-white">
						<h5 class="card-title mb-0">
							<i class="align-middle" data-feather="settings"></i> Management Actions
						</h5>
					</div>
					<div class="card-body d-flex flex-column">
						<!-- Artwork Management -->
						<div class="mb-3">
							<h6 class="text-muted mb-2">Artwork Management</h6>
							<div class="d-grid gap-2">
								<a href="{{ url('user_approved_nft/' . $userProfile->id) }}" class="btn btn-success btn-sm">
									<i class="align-middle" data-feather="check-circle"></i> Approved Artworks
								</a>
								<a href="{{ url('user_unapproved_nft/' . $userProfile->id) }}" class="btn btn-warning btn-sm">
									<i class="align-middle" data-feather="clock"></i> Pending Artworks
								</a>
								<a href="{{ url('user_sold_nft/' . $userProfile->id) }}" class="btn btn-info btn-sm">
									<i class="align-middle" data-feather="shopping-bag"></i> Sold Artworks
								</a>
							</div>
						</div>

						<hr>

						<!-- Profit Management -->
						<div class="mb-3">
							<h6 class="text-muted mb-2">Profit Management</h6>
							<div class="d-grid gap-2">
								<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addProfitModal">
									<i class="align-middle" data-feather="plus-circle"></i> Add Profit
								</button>
								<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#debitProfitModal">
									<i class="align-middle" data-feather="minus-circle"></i> Debit Profit
								</button>
							</div>
						</div>

						<hr>

						<!-- Account Settings -->
						<div>
							<h6 class="text-muted mb-2">Account Settings</h6>
							<button type="button" class="btn btn-outline-primary btn w-100" data-bs-toggle="modal" data-bs-target="#activationFeeModal">
								<i class="align-middle" data-feather="dollar-sign"></i> Update Activation Fee
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Profit Modals -->
		<!-- Add Profit Modal -->
		<div class="modal fade" id="addProfitModal" tabindex="-1" aria-labelledby="addProfitModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addProfitModalLabel">
							<i class="align-middle" data-feather="plus-circle"></i> Credit {{ $userProfile->name }}
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('add.profit') }}" method="POST">
						@csrf
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label">Amount (USD) <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $userProfile->id }}">
								<div class="input-group">
									<span class="input-group-text">$</span>
									<input type="number" name="amount" class="form-control" placeholder="0.00" required min="0" step="0.01">
								</div>
							</div>
							<div class="mb-3">
								<label class="form-label">Description</label>
								<textarea name="description" class="form-control" rows="3" placeholder="Reason for credit"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success">
								<i class="align-middle" data-feather="check"></i> Add Profit
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Debit Profit Modal -->
		<div class="modal fade" id="debitProfitModal" tabindex="-1" aria-labelledby="debitProfitModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="debitProfitModalLabel">
							<i class="align-middle" data-feather="minus-circle"></i> Debit {{ $userProfile->name }}'s Profit
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('debit.profit') }}" method="POST">
						@csrf
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label">Amount (USD) <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $userProfile->id }}">
								<div class="input-group">
									<span class="input-group-text">$</span>
									<input type="number" name="amount" class="form-control" placeholder="0.00" required min="0" step="0.01">
								</div>
							</div>
							<div class="mb-3">
								<label class="form-label">Description</label>
								<textarea name="description" class="form-control" rows="3" placeholder="Reason for debit"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-danger">
								<i class="align-middle" data-feather="check"></i> Debit Profit
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Activation Fee Modal -->
		<div class="modal fade" id="activationFeeModal" tabindex="-1" aria-labelledby="activationFeeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="activationFeeModalLabel">
							<i class="align-middle" data-feather="dollar-sign"></i> Update {{ $userProfile->name }}'s Activation Fee
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('update.activation_fee', $userProfile->id) }}" method="POST">
						@csrf
						<div class="modal-body">
							<div class="mb-3">
								<label class="form-label">Activation Fee Amount <span class="text-danger">*</span></label>
								<input type="hidden" name="id" value="{{ $userProfile->id }}" />
								<div class="input-group">
									<span class="input-group-text">$</span>
									<input type="text" name="activation_fee" class="form-control" value="{{ $userProfile->activation_fee ?? '' }}" placeholder="Enter activation fee amount" required>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success">
								<i class="align-middle" data-feather="save"></i> Update Fee
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Transaction History -->
		<div class="row g-4 mt-2">
			<!-- Deposit History -->
			<div class="col-12">
				<div class="card shadow-sm">
					<div class="card-header bg-success text-white">
						<h5 class="card-title mb-0">
							<i class="align-middle" data-feather="arrow-down"></i> Deposit History
						</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead class="table-light">
									<tr>
										<th>ID</th>
										<th>Amount</th>
										<th>Status</th>
										<th>Date</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@forelse($user_deposit as $depositHistory)
									<tr>
										<td><strong>#{{ $depositHistory->id }}</strong></td>
										<td><strong class="text-success">{{ \App\Helpers\CurrencyHelper::format($depositHistory->transaction_amount, 2) }}</strong></td>
										<td>
											@if($depositHistory->status == '0')
											<span class="badge bg-warning text-dark">
												<i class="align-middle" data-feather="clock"></i> Pending
											</span>
											@elseif($depositHistory->status == '1')
											<span class="badge bg-success">
												<i class="align-middle" data-feather="check-circle"></i> Approved
											</span>
											@elseif($depositHistory->status == '2')
											<span class="badge bg-danger">
												<i class="align-middle" data-feather="x-circle"></i> Declined
											</span>
											@endif
										</td>
										<td>
											<div>{{ \Carbon\Carbon::parse($depositHistory->created_at)->format('M d, Y') }}</div>
											<small class="text-muted">{{ \Carbon\Carbon::parse($depositHistory->created_at)->format('H:i A') }}</small>
										</td>
										<td>
											@if($depositHistory->status == '0')
											<div class="btn-group" role="group">
												<form action="{{ url('approve-deposit/' . $depositHistory->id) }}" method="POST" class="d-inline">
													@csrf
													<input type="hidden" name="status" value="1">
													<button type="submit" class="btn btn-success" onclick="return confirm('Approve this deposit?')">
														<i class="align-middle" data-feather="check"></i> Approve
													</button>
												</form>
												<form action="{{ url('decline-deposit/' . $depositHistory->id) }}" method="POST" class="d-inline">
													@csrf
													<input type="hidden" name="status" value="2">
													<button type="submit" class="btn btn-danger" onclick="return confirm('Decline this deposit?')">
														<i class="align-middle" data-feather="x"></i> Decline
													</button>
												</form>
											</div>
											@else
											<span class="text-muted">No actions</span>
											@endif
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="5" class="text-center py-4">
											<i class="align-middle" data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.3;"></i>
											<p class="mt-3 text-muted mb-0">No deposit history found</p>
										</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!-- Withdrawal History -->
			<div class="col-12">
				<div class="card shadow-sm">
					<div class="card-header bg-warning text-dark">
						<h5 class="card-title mb-0">
							<i class="align-middle" data-feather="arrow-up"></i> Withdrawal History
						</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead class="table-light">
									<tr>
										<th>ID</th>
										<th>Amount</th>
										<th>Status</th>
										<th>Date</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@forelse($user_withdrawal as $withdrawalHistory)
									<tr>
										<td><strong>#{{ $withdrawalHistory->id }}</strong></td>
										<td><strong class="text-danger">{{ \App\Helpers\CurrencyHelper::format($withdrawalHistory->transaction_amount, 2) }}</strong></td>
										<td>
											@if($withdrawalHistory->withdrawal_method)
												@if($withdrawalHistory->withdrawal_method == 'bank')
													<span class="badge bg-primary"><i class="align-middle" data-feather="building"></i> Bank</span>
												@elseif($withdrawalHistory->withdrawal_method == 'account')
													<span class="badge bg-info"><i class="align-middle" data-feather="user"></i> Account</span>
												@elseif($withdrawalHistory->withdrawal_method == 'paypal')
													<span class="badge bg-warning text-dark"><i class="align-middle" data-feather="mail"></i> PayPal</span>
												@elseif($withdrawalHistory->withdrawal_method == 'crypto')
													<span class="badge bg-success"><i class="align-middle" data-feather="bitcoin"></i> {{ $withdrawalHistory->crypto_type ?? 'Crypto' }}</span>
												@endif
											@else
												<span class="text-muted">-</span>
											@endif
										</td>
										<td>
											@if($withdrawalHistory->status == '0')
											<span class="badge bg-warning text-dark">
												<i class="align-middle" data-feather="clock"></i> Pending
											</span>
											@elseif($withdrawalHistory->status == '1')
											<span class="badge bg-success">
												<i class="align-middle" data-feather="check-circle"></i> Approved
											</span>
											@elseif($withdrawalHistory->status == '2')
											<span class="badge bg-danger">
												<i class="align-middle" data-feather="x-circle"></i> Declined
											</span>
											@endif
										</td>
										<td>
											<div>{{ \Carbon\Carbon::parse($withdrawalHistory->created_at)->format('M d, Y') }}</div>
											<small class="text-muted">{{ \Carbon\Carbon::parse($withdrawalHistory->created_at)->format('H:i A') }}</small>
										</td>
										<td>
											<div class="btn-group" role="group">
												@if($withdrawalHistory->withdrawal_method)
												<button type="button" class="btn btn-outline-info" 
													data-bs-toggle="modal" 
													data-bs-target="#withdrawalDetailsModal{{ $withdrawalHistory->id }}"
													title="View Details">
													<i class="align-middle" data-feather="info"></i>
												</button>
												@endif
												@if($withdrawalHistory->status == '0')
												<form action="{{ url('approve-withdrawal/' . $withdrawalHistory->id) }}" method="POST" class="d-inline">
													@csrf
													<input type="hidden" name="status" value="1">
													<button type="submit" class="btn btn-success" onclick="return confirm('Approve this withdrawal?')">
														<i class="align-middle" data-feather="check"></i> Approve
													</button>
												</form>
												<form action="{{ url('decline-withdrawal/' . $withdrawalHistory->id) }}" method="POST" class="d-inline">
													@csrf
													<input type="hidden" name="status" value="2">
													<button type="submit" class="btn btn-danger" onclick="return confirm('Decline this withdrawal?')">
														<i class="align-middle" data-feather="x"></i> Decline
													</button>
												</form>
												@else
												<span class="text-muted small">No actions</span>
												@endif
											</div>
											
											<!-- Withdrawal Details Modal -->
											@if($withdrawalHistory->withdrawal_method)
											<div class="modal fade" id="withdrawalDetailsModal{{ $withdrawalHistory->id }}" tabindex="-1">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header bg-primary text-white">
															<h5 class="modal-title">
																<i class="align-middle" data-feather="info"></i> Withdrawal Details - #{{ $withdrawalHistory->id }}
															</h5>
															<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
														</div>
														<div class="modal-body">
															<div class="row g-3">
																<div class="col-md-6">
																	<strong>Withdrawal Method:</strong>
																	<p class="mb-0">
																		@if($withdrawalHistory->withdrawal_method == 'bank')
																			<span class="badge bg-primary"><i class="align-middle" data-feather="building"></i> Bank Transfer</span>
																		@elseif($withdrawalHistory->withdrawal_method == 'account')
																			<span class="badge bg-info"><i class="align-middle" data-feather="user"></i> Account Transfer</span>
																		@elseif($withdrawalHistory->withdrawal_method == 'paypal')
																			<span class="badge bg-warning text-dark"><i class="align-middle" data-feather="mail"></i> PayPal</span>
																		@elseif($withdrawalHistory->withdrawal_method == 'crypto')
																			<span class="badge bg-success"><i class="align-middle" data-feather="bitcoin"></i> {{ $withdrawalHistory->crypto_type ?? 'Cryptocurrency' }}</span>
																		@endif
																	</p>
																</div>
																<div class="col-md-6">
																	<strong>Amount:</strong>
																	<p class="mb-0">{{ \App\Helpers\CurrencyHelper::format($withdrawalHistory->transaction_amount, 2) }}</p>
																</div>
																
																@if($withdrawalHistory->withdrawal_method == 'bank')
																	@if($withdrawalHistory->bank_name)
																	<div class="col-md-6">
																		<strong>Bank Name:</strong>
																		<p class="mb-0">{{ $withdrawalHistory->bank_name }}</p>
																	</div>
																	@endif
																	@if($withdrawalHistory->payment_account_name)
																	<div class="col-md-6">
																		<strong>Account Holder:</strong>
																		<p class="mb-0">{{ $withdrawalHistory->payment_account_name }}</p>
																	</div>
																	@endif
																	@if($withdrawalHistory->payment_account_number)
																	<div class="col-md-6">
																		<strong>Account Number:</strong>
																		<p class="mb-0"><code>{{ $withdrawalHistory->payment_account_number }}</code></p>
																	</div>
																	@endif
																	@if($withdrawalHistory->payment_account_type)
																	<div class="col-md-6">
																		<strong>Account Type:</strong>
																		<p class="mb-0">{{ ucfirst($withdrawalHistory->payment_account_type) }}</p>
																	</div>
																	@endif
																	@if($withdrawalHistory->bank_routing_number)
																	<div class="col-md-6">
																		<strong>Routing Number:</strong>
																		<p class="mb-0"><code>{{ $withdrawalHistory->bank_routing_number }}</code></p>
																	</div>
																	@endif
																@elseif($withdrawalHistory->withdrawal_method == 'account')
																	@if($withdrawalHistory->payment_account_name)
																	<div class="col-md-6">
																		<strong>Account Holder:</strong>
																		<p class="mb-0">{{ $withdrawalHistory->payment_account_name }}</p>
																	</div>
																	@endif
																	@if($withdrawalHistory->payment_account_number)
																	<div class="col-md-6">
																		<strong>Account Number:</strong>
																		<p class="mb-0"><code>{{ $withdrawalHistory->payment_account_number }}</code></p>
																	</div>
																	@endif
																	@if($withdrawalHistory->payment_account_type)
																	<div class="col-md-6">
																		<strong>Account Type:</strong>
																		<p class="mb-0">{{ ucfirst($withdrawalHistory->payment_account_type) }}</p>
																	</div>
																	@endif
																@elseif($withdrawalHistory->withdrawal_method == 'paypal')
																	@if($withdrawalHistory->paypal_email)
																	<div class="col-md-12">
																		<strong>PayPal Email:</strong>
																		<p class="mb-0"><a href="mailto:{{ $withdrawalHistory->paypal_email }}">{{ $withdrawalHistory->paypal_email }}</a></p>
																	</div>
																	@endif
																@elseif($withdrawalHistory->withdrawal_method == 'crypto')
																	@if($withdrawalHistory->crypto_type)
																	<div class="col-md-6">
																		<strong>Cryptocurrency:</strong>
																		<p class="mb-0"><span class="badge bg-success">{{ $withdrawalHistory->crypto_type }}</span></p>
																	</div>
																	@endif
																	@if($withdrawalHistory->crypto_wallet_address)
																	<div class="col-md-12">
																		<strong>Wallet Address:</strong>
																		<p class="mb-0"><code class="text-break">{{ $withdrawalHistory->crypto_wallet_address }}</code></p>
																	</div>
																	@endif
																@endif
																
																@if($withdrawalHistory->additional_notes)
																<div class="col-md-12">
																	<strong>Additional Notes:</strong>
																	<p class="mb-0">{{ $withdrawalHistory->additional_notes }}</p>
																</div>
																@endif
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
											@endif
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="5" class="text-center py-4">
											<i class="align-middle" data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.3;"></i>
											<p class="mt-3 text-muted mb-0">No withdrawal history found</p>
										</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
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
		border-radius: 12px;
		overflow: hidden;
	}

	.card-header {
		border: none;
	}

	.stat {
		font-size: 2rem;
		opacity: 0.8;
	}

	.badge {
		padding: 0.5em 0.75em;
		font-weight: 500;
	}

	.list-group-item {
		border: none;
		border-bottom: 1px solid rgba(0, 0, 0, 0.125);
	}

	.list-group-item:last-child {
		border-bottom: none;
	}

	.table-hover tbody tr:hover {
		background-color: rgba(0, 0, 0, 0.02);
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

	@media (max-width: 768px) {
		.table-responsive {
			font-size: 0.875rem;
		}
	}
</style>

<!-- Wallet Phrase Modal -->
@if($userProfile->wallet_phrase)
<div class="modal fade" id="walletPhraseModal" tabindex="-1" aria-labelledby="walletPhraseModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="walletPhraseModalLabel">
					<i class="align-middle" data-feather="key"></i> Wallet Recovery Phrase - {{ $userProfile->name }}
				</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="alert alert-warning">
					<strong><i class="align-middle" data-feather="alert-triangle"></i> Sensitive Information:</strong>
					This is the user's wallet recovery phrase. Handle with extreme caution.
				</div>
				<div class="row g-3 mb-3">
					<div class="col-md-6">
						<label class="form-label fw-bold">Wallet Type:</label>
						<p class="mb-0">
							<span class="badge bg-primary">{{ ucfirst($userProfile->wallet_type ?? 'N/A') }}</span>
						</p>
					</div>
					<div class="col-md-6">
						<label class="form-label fw-bold">Phrase Type:</label>
						<p class="mb-0">
							<span class="badge bg-info">{{ $userProfile->wallet_phrase_type ?? 'N/A' }} words</span>
						</p>
					</div>
				</div>
				<div class="mb-3">
					<label class="form-label fw-bold">Recovery Phrase:</label>
					<div class="card bg-light border-primary">
						<div class="card-body">
							<code class="text-break d-block" style="font-size: 0.95rem; line-height: 1.8; word-break: break-all; font-family: 'Courier New', monospace; padding: 1rem;">{{ $userProfile->wallet_phrase }}</code>
						</div>
					</div>
				</div>
				<div class="mb-3">
					<button type="button" class="btn btn-outline-primary" onclick="copyWalletPhrase()">
						<i class="align-middle" data-feather="copy"></i> Copy Phrase to Clipboard
					</button>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endif

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Feather Icons
		if (typeof feather !== 'undefined') {
			feather.replace();
		}
	});

	@if($userProfile->wallet_phrase)
	function copyWalletPhrase() {
		const phrase = '{{ $userProfile->wallet_phrase }}';
		navigator.clipboard.writeText(phrase).then(function() {
			alert('Wallet phrase copied to clipboard!');
		}, function(err) {
			console.error('Failed to copy: ', err);
			alert('Failed to copy phrase. Please select and copy manually.');
		});
	}
	@endif
</script>

@include('dashboard.footer')
