@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="h3 mb-0"><strong>All Transactions</strong></h1>
			<div>
				<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse">
					<i class="align-middle" data-feather="filter"></i> Filters
				</button>
			</div>
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

		<!-- Statistics Cards -->
		<div class="row mb-4">
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Total Transactions</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-primary">
									<i class="align-middle" data-feather="list"></i>
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
								<h5 class="card-title">Pending</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-warning">
									<i class="align-middle" data-feather="clock"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['pending']) }}</b></h3>
						<div class="mb-0">
							<span class="text-warning">{{ \App\Helpers\CurrencyHelper::format($stats['pending_amount'], 2) }}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Approved</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-success">
									<i class="align-middle" data-feather="check-circle"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['approved']) }}</b></h3>
						<div class="mb-0">
							<span class="text-success">{{ \App\Helpers\CurrencyHelper::format($stats['total_amount'], 2) }}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Declined</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-danger">
									<i class="align-middle" data-feather="x-circle"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['declined']) }}</b></h3>
					</div>
				</div>
			</div>
		</div>

		<!-- Filters Collapse -->
		<div class="collapse mb-4" id="filtersCollapse">
			<div class="card">
				<div class="card-body">
					<form method="GET" action="{{ route('user.transaction') }}" class="row g-3">
						<div class="col-md-3">
							<label for="search" class="form-label">Search</label>
							<input type="text" class="form-control" id="search" name="search" 
								value="{{ request('search') }}" placeholder="User, amount, type...">
						</div>
						<div class="col-md-2">
							<label for="type" class="form-label">Type</label>
							<select class="form-select" id="type" name="type">
								<option value="">All Types</option>
								<option value="Deposit" {{ request('type') == 'Deposit' ? 'selected' : '' }}>Deposit</option>
								<option value="Withdrawal" {{ request('type') == 'Withdrawal' ? 'selected' : '' }}>Withdrawal</option>
								<option value="Profit" {{ request('type') == 'Profit' ? 'selected' : '' }}>Profit</option>
								<option value="DebitProfit" {{ request('type') == 'DebitProfit' ? 'selected' : '' }}>Debit Profit</option>
							</select>
						</div>
						<div class="col-md-2">
							<label for="status" class="form-label">Status</label>
							<select class="form-select" id="status" name="status">
								<option value="">All Status</option>
								<option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
								<option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Approved</option>
								<option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Declined</option>
							</select>
						</div>
						<div class="col-md-2">
							<label for="date_from" class="form-label">From Date</label>
							<input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
						</div>
						<div class="col-md-2">
							<label for="date_to" class="form-label">To Date</label>
							<input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
						</div>
						<div class="col-md-1 d-flex align-items-end">
							<button type="submit" class="btn btn-primary w-100">
								<i class="align-middle" data-feather="search"></i>
							</button>
						</div>
						@if(request()->hasAny(['search', 'type', 'status', 'date_from', 'date_to']))
						<div class="col-12">
							<a href="{{ route('user.transaction') }}" class="btn btn-outline-secondary btn-sm">
								<i class="align-middle" data-feather="x"></i> Clear Filters
							</a>
						</div>
						@endif
					</form>
				</div>
			</div>
		</div>

		<!-- Transactions Table -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Transaction History</h5>
					</div>
					<div class="card-body">
						<!-- Desktop Table View -->
						<div class="table-responsive d-none d-md-block">
							<table class="table table-hover table-striped">
								<thead class="table-light">
									<tr>
										<th>ID</th>
										<th>User</th>
										<th>Type</th>
										<th>Amount</th>
										<th>Status</th>
										<th>Date</th>
										<th>Proof</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@forelse($transactions as $transaction)
									<tr>
										<td><strong>#{{ $transaction->id }}</strong></td>
										<td>
											@if($transaction->user)
											<div class="d-flex align-items-center">
												<div>
													<a href="{{ url('profile/' . $transaction->user->id) }}" class="text-decoration-none">
														<strong>{{ $transaction->user->name }}</strong>
													</a>
													<br>
													<small class="text-muted">{{ $transaction->user->email }}</small>
												</div>
											</div>
											@else
											<span class="text-muted">User Deleted</span>
											@endif
										</td>
										<td>
											@if($transaction->transaction_type == 'Deposit')
											<span class="badge bg-info">
												<i class="align-middle" data-feather="arrow-down"></i> Deposit
											</span>
											@elseif($transaction->transaction_type == 'Withdrawal')
											<div>
												<span class="badge bg-warning text-dark">
													<i class="align-middle" data-feather="arrow-up"></i> Withdrawal
												</span>
												@if($transaction->withdrawal_method)
												<br>
												<small class="text-muted mt-1 d-block">
													@if($transaction->withdrawal_method == 'bank')
														<i class="align-middle" data-feather="building"></i> Bank Transfer
													@elseif($transaction->withdrawal_method == 'account')
														<i class="align-middle" data-feather="user"></i> Account Transfer
													@elseif($transaction->withdrawal_method == 'paypal')
														<i class="align-middle" data-feather="mail"></i> PayPal
													@elseif($transaction->withdrawal_method == 'crypto')
														<i class="align-middle" data-feather="bitcoin"></i> {{ $transaction->crypto_type ?? 'Crypto' }}
													@endif
												</small>
												@endif
											</div>
											@elseif($transaction->transaction_type == 'Profit')
											<span class="badge bg-success">
												<i class="align-middle" data-feather="trending-up"></i> Profit
											</span>
											@elseif($transaction->transaction_type == 'DebitProfit')
											<span class="badge bg-danger">
												<i class="align-middle" data-feather="trending-down"></i> Debit Profit
											</span>
											@else
											<span class="badge bg-secondary">{{ $transaction->transaction_type }}</span>
											@endif
										</td>
										<td>
											<strong class="text-primary">{{ \App\Helpers\CurrencyHelper::format($transaction->transaction_amount, 2) }}</strong>
										</td>
										<td>
											@if($transaction->status == '0')
											<span class="badge bg-warning text-dark">
												<i class="align-middle" data-feather="clock"></i> Pending
											</span>
											@elseif($transaction->status == '1')
											<span class="badge bg-success">
												<i class="align-middle" data-feather="check-circle"></i> Approved
											</span>
											@elseif($transaction->status == '2')
											<span class="badge bg-danger">
												<i class="align-middle" data-feather="x-circle"></i> Declined
											</span>
											@endif
										</td>
										<td>
											<div>{{ $transaction->created_at->format('M d, Y') }}</div>
											<small class="text-muted">{{ $transaction->created_at->format('H:i A') }}</small>
										</td>
										<td>
											<div class="btn-group" role="group">
												@if($transaction->transaction_type == 'Withdrawal' && $transaction->withdrawal_method)
												<button type="button" class="btn btn-outline-info" 
													data-bs-toggle="modal" 
													data-bs-target="#detailsModal{{ $transaction->id }}"
													title="View Withdrawal Details">
													<i class="align-middle" data-feather="info"></i> Details
												</button>
												@endif
												@if($transaction->transaction_proof)
												<button type="button" class="btn btn-outline-primary" 
													data-bs-toggle="modal" 
													data-bs-target="#proofModal{{ $transaction->id }}">
													<i class="align-middle" data-feather="eye"></i> Proof
												</button>
												@endif
											</div>
											
											<!-- Withdrawal Details Modal -->
											@if($transaction->transaction_type == 'Withdrawal' && $transaction->withdrawal_method)
											<div class="modal fade" id="detailsModal{{ $transaction->id }}" tabindex="-1">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header bg-primary text-white">
															<h5 class="modal-title">
																<i class="align-middle" data-feather="info"></i> Withdrawal Details - #{{ $transaction->id }}
															</h5>
															<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
														</div>
														<div class="modal-body">
															<div class="row g-3">
																<div class="col-md-6">
																	<strong>Withdrawal Method:</strong>
																	<p class="mb-0">
																		@if($transaction->withdrawal_method == 'bank')
																			<span class="badge bg-primary"><i class="align-middle" data-feather="building"></i> Bank Transfer</span>
																		@elseif($transaction->withdrawal_method == 'account')
																			<span class="badge bg-info"><i class="align-middle" data-feather="user"></i> Account Transfer</span>
																		@elseif($transaction->withdrawal_method == 'paypal')
																			<span class="badge bg-warning text-dark"><i class="align-middle" data-feather="mail"></i> PayPal</span>
																		@elseif($transaction->withdrawal_method == 'crypto')
																			<span class="badge bg-success"><i class="align-middle" data-feather="bitcoin"></i> {{ $transaction->crypto_type ?? 'Cryptocurrency' }}</span>
																		@endif
																	</p>
																</div>
																<div class="col-md-6">
																	<strong>Amount:</strong>
																	<p class="mb-0">{{ \App\Helpers\CurrencyHelper::format($transaction->transaction_amount, 2) }}</p>
																</div>
																
																@if($transaction->withdrawal_method == 'bank')
																	@if($transaction->bank_name)
																	<div class="col-md-6">
																		<strong>Bank Name:</strong>
																		<p class="mb-0">{{ $transaction->bank_name }}</p>
																	</div>
																	@endif
																	@if($transaction->payment_account_name)
																	<div class="col-md-6">
																		<strong>Account Holder:</strong>
																		<p class="mb-0">{{ $transaction->payment_account_name }}</p>
																	</div>
																	@endif
																	@if($transaction->payment_account_number)
																	<div class="col-md-6">
																		<strong>Account Number:</strong>
																		<p class="mb-0"><code>{{ $transaction->payment_account_number }}</code></p>
																	</div>
																	@endif
																	@if($transaction->payment_account_type)
																	<div class="col-md-6">
																		<strong>Account Type:</strong>
																		<p class="mb-0">{{ ucfirst($transaction->payment_account_type) }}</p>
																	</div>
																	@endif
																	@if($transaction->bank_routing_number)
																	<div class="col-md-6">
																		<strong>Routing Number:</strong>
																		<p class="mb-0"><code>{{ $transaction->bank_routing_number }}</code></p>
																	</div>
																	@endif
																@elseif($transaction->withdrawal_method == 'account')
																	@if($transaction->payment_account_name)
																	<div class="col-md-6">
																		<strong>Account Holder:</strong>
																		<p class="mb-0">{{ $transaction->payment_account_name }}</p>
																	</div>
																	@endif
																	@if($transaction->payment_account_number)
																	<div class="col-md-6">
																		<strong>Account Number:</strong>
																		<p class="mb-0"><code>{{ $transaction->payment_account_number }}</code></p>
																	</div>
																	@endif
																	@if($transaction->payment_account_type)
																	<div class="col-md-6">
																		<strong>Account Type:</strong>
																		<p class="mb-0">{{ ucfirst($transaction->payment_account_type) }}</p>
																	</div>
																	@endif
																@elseif($transaction->withdrawal_method == 'paypal')
																	@if($transaction->paypal_email)
																	<div class="col-md-12">
																		<strong>PayPal Email:</strong>
																		<p class="mb-0"><a href="mailto:{{ $transaction->paypal_email }}">{{ $transaction->paypal_email }}</a></p>
																	</div>
																	@endif
																@elseif($transaction->withdrawal_method == 'crypto')
																	@if($transaction->crypto_type)
																	<div class="col-md-6">
																		<strong>Cryptocurrency:</strong>
																		<p class="mb-0"><span class="badge bg-success">{{ $transaction->crypto_type }}</span></p>
																	</div>
																	@endif
																	@if($transaction->crypto_wallet_address)
																	<div class="col-md-12">
																		<strong>Wallet Address:</strong>
																		<p class="mb-0"><code class="text-break">{{ $transaction->crypto_wallet_address }}</code></p>
																	</div>
																	@endif
																@endif
																
																@if($transaction->additional_notes)
																<div class="col-md-12">
																	<strong>Additional Notes:</strong>
																	<p class="mb-0">{{ $transaction->additional_notes }}</p>
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
											
											<!-- Proof Modal -->
											@if($transaction->transaction_proof)
											<div class="modal fade" id="proofModal{{ $transaction->id }}" tabindex="-1">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Transaction Proof - #{{ $transaction->id }}</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
														</div>
														<div class="modal-body text-center">
															<img src="{{ $transaction->transaction_proof }}" 
																alt="Transaction Proof" 
																class="img-fluid rounded">
														</div>
													</div>
												</div>
											</div>
											@endif
										</td>
										<td>
											@if($transaction->status == '0')
												@if($transaction->transaction_type == 'Deposit')
												<div class="btn-group" role="group">
													<form action="{{ url('approve-deposit/' . $transaction->id) }}" method="POST" class="d-inline">
														@csrf
														<button type="submit" class="btn btn-success" 
															onclick="return confirm('Are you sure you want to approve this deposit?')">
															<i class="align-middle" data-feather="check"></i> Approve
														</button>
													</form>
													<form action="{{ url('decline-deposit/' . $transaction->id) }}" method="POST" class="d-inline">
														@csrf
														<button type="submit" class="btn btn-danger"
															onclick="return confirm('Are you sure you want to decline this deposit?')">
															<i class="align-middle" data-feather="x"></i> Decline
														</button>
													</form>
												</div>
												@elseif($transaction->transaction_type == 'Withdrawal')
												<div class="btn-group" role="group">
													<form action="{{ url('approve-withdrawal/' . $transaction->id) }}" method="POST" class="d-inline">
														@csrf
														<input type="hidden" name="status" value="1">
														<button type="submit" class="btn btn-success"
															onclick="return confirm('Are you sure you want to approve this withdrawal?')">
															<i class="align-middle" data-feather="check"></i> Approve
														</button>
													</form>
													<form action="{{ url('decline-withdrawal/' . $transaction->id) }}" method="POST" class="d-inline">
														@csrf
														<input type="hidden" name="status" value="2">
														<button type="submit" class="btn btn-danger"
															onclick="return confirm('Are you sure you want to decline this withdrawal?')">
															<i class="align-middle" data-feather="x"></i> Decline
														</button>
													</form>
												</div>
												@endif
											@else
											<span class="text-muted small">No actions</span>
											@endif
										</td>
									</tr>
									@empty
									<tr>
										<td colspan="8" class="text-center py-5">
											<i class="align-middle" data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.3;"></i>
											<p class="mt-3 text-muted">No transactions found</p>
											@if(request()->hasAny(['search', 'type', 'status', 'date_from', 'date_to']))
											<a href="{{ route('user.transaction') }}" class="btn btn-outline-primary">
												Clear filters to see all transactions
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
							@forelse($transactions as $transaction)
							<div class="card mb-3">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-start mb-2">
										<div>
											<h6 class="mb-1">
												@if($transaction->transaction_type == 'Deposit')
													<span class="badge bg-info"><i class="align-middle" data-feather="arrow-down"></i> Deposit</span>
												@elseif($transaction->transaction_type == 'Withdrawal')
													<span class="badge bg-warning text-dark"><i class="align-middle" data-feather="arrow-up"></i> Withdrawal</span>
												@elseif($transaction->transaction_type == 'Profit')
													<span class="badge bg-success"><i class="align-middle" data-feather="trending-up"></i> Profit</span>
												@elseif($transaction->transaction_type == 'DebitProfit')
													<span class="badge bg-danger"><i class="align-middle" data-feather="trending-down"></i> Debit Profit</span>
												@else
													<span class="badge bg-secondary">{{ $transaction->transaction_type }}</span>
												@endif
											</h6>
											<small class="text-muted">#{{ $transaction->id }}</small>
										</div>
										<div class="text-end">
											<strong class="text-primary d-block">{{ \App\Helpers\CurrencyHelper::format($transaction->transaction_amount, 2) }}</strong>
											@if($transaction->status == '0')
												<span class="badge bg-warning text-dark"><i class="align-middle" data-feather="clock"></i> Pending</span>
											@elseif($transaction->status == '1')
												<span class="badge bg-success"><i class="align-middle" data-feather="check-circle"></i> Approved</span>
											@elseif($transaction->status == '2')
												<span class="badge bg-danger"><i class="align-middle" data-feather="x-circle"></i> Declined</span>
											@endif
										</div>
									</div>

									<div class="mb-2">
										<small class="text-muted d-block">User:</small>
										@if($transaction->user)
											<a href="{{ url('profile/' . $transaction->user->id) }}" class="text-decoration-none">
												{{ $transaction->user->name }}
											</a>
										@else
											<span class="text-muted">User Deleted</span>
										@endif
									</div>

									<div class="mb-2">
										<small class="text-muted d-block">Date:</small>
										{{ $transaction->created_at->format('M d, Y H:i A') }}
									</div>

									@if($transaction->transaction_type == 'Withdrawal' && $transaction->withdrawal_method)
									<div class="mb-3">
										<button type="button" class="btn btn-outline-info btn-sm w-100" 
											data-bs-toggle="modal" 
											data-bs-target="#mobileDetailsModal{{ $transaction->id }}">
											<i class="align-middle" data-feather="info"></i> View Details
										</button>
										
										<!-- Duplicate Modal for Mobile with unique ID -->
										<div class="modal fade" id="mobileDetailsModal{{ $transaction->id }}" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-primary text-white">
														<h5 class="modal-title">Withdrawal Details</h5>
														<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body">
														<!-- Same content as desktop modal, simplified -->
														<p><strong>Method:</strong> {{ ucfirst($transaction->withdrawal_method) }}</p>
														@if($transaction->withdrawal_method == 'bank')
															<p><strong>Bank:</strong> {{ $transaction->bank_name ?? 'N/A' }}</p>
															<p><strong>Account:</strong> {{ $transaction->payment_account_number ?? 'N/A' }}</p>
														@elseif($transaction->withdrawal_method == 'crypto')
															<p><strong>Address:</strong> <span class="text-break">{{ $transaction->crypto_wallet_address ?? 'N/A' }}</span></p>
														@endif
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif

									@if($transaction->transaction_proof)
									<div class="mb-3">
										<button type="button" class="btn btn-outline-primary btn-sm w-100" 
											data-bs-toggle="modal" 
											data-bs-target="#mobileProofModal{{ $transaction->id }}">
											<i class="align-middle" data-feather="eye"></i> View Proof
										</button>
										
										<div class="modal fade" id="mobileProofModal{{ $transaction->id }}" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Proof</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body text-center">
														<img src="{{ $transaction->transaction_proof }}" class="img-fluid rounded" alt="Proof">
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif

									@if($transaction->status == '0')
									<div class="d-grid gap-2 d-flex">
										@if($transaction->transaction_type == 'Deposit')
											<form action="{{ url('approve-deposit/' . $transaction->id) }}" method="POST" class="flex-fill">
												@csrf
												<button type="submit" class="btn btn-success w-100" onclick="return confirm('Approve deposit?')">Approve</button>
											</form>
											<form action="{{ url('decline-deposit/' . $transaction->id) }}" method="POST" class="flex-fill">
												@csrf
												<button type="submit" class="btn btn-danger w-100" onclick="return confirm('Decline deposit?')">Decline</button>
											</form>
										@elseif($transaction->transaction_type == 'Withdrawal')
											<form action="{{ url('approve-withdrawal/' . $transaction->id) }}" method="POST" class="flex-fill">
												@csrf
												<input type="hidden" name="status" value="1">
												<button type="submit" class="btn btn-success w-100" onclick="return confirm('Approve withdrawal?')">Approve</button>
											</form>
											<form action="{{ url('decline-withdrawal/' . $transaction->id) }}" method="POST" class="flex-fill">
												@csrf
												<input type="hidden" name="status" value="2">
												<button type="submit" class="btn btn-danger w-100" onclick="return confirm('Decline withdrawal?')">Decline</button>
											</form>
										@endif
									</div>
									@endif
								</div>
							</div>
							@empty
							<div class="text-center py-5">
								<p class="text-muted">No transactions found</p>
							</div>
							@endforelse
						</div>
						
						<!-- Pagination -->
						<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 gap-3">
							<div class="text-muted text-center text-md-start">
								Showing <strong>{{ $transactions->firstItem() ?? 0 }}</strong> to <strong>{{ $transactions->lastItem() ?? 0 }}</strong> of <strong>{{ $transactions->total() }}</strong> transactions
							</div>
							<div class="pagination-wrapper">
								{{ $transactions->links('pagination::bootstrap-4') }}
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
		margin: 0 2px;
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

	@media (max-width: 768px) {
		.table-responsive {
			font-size: 0.875rem;
		}
		
		/* Mobile specific adjustments */
		.d-md-none .card {
			border-left: 4px solid #3b7ddd; /* Sidebar color accent */
		}
		
		.d-md-none .card .badge {
			font-size: 0.8rem;
		}
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Feather Icons
		if (typeof feather !== 'undefined') {
			feather.replace();
		}

		// Auto-submit form on filter change (optional)
		const filterInputs = document.querySelectorAll('#filtersCollapse select, #filtersCollapse input[type="date"]');
		filterInputs.forEach(input => {
			input.addEventListener('change', function() {
				// Optional: auto-submit on change
				// this.form.submit();
			});
		});
	});
</script>


@include('dashboard.footer')
