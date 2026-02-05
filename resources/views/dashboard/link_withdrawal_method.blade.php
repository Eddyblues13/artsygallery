@include('dashboard.header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-12">
				<div class="card shadow-sm">
					<div class="card-header bg-primary text-white">
						<h1 class="card-title mb-0">
							<i class="align-middle" data-feather="link"></i> Link {{ ucfirst($methodType) }} Withdrawal Method
						</h1>
					</div>

					<div class="card-body">
						@include('dashboard.alert')

						@if($pendingAmount)
						<div class="dashboard-alert dashboard-alert-info mb-4" role="alert">
							<div class="alert-icon">
								<i class="align-middle" data-feather="info" style="width: 24px; height: 24px;"></i>
							</div>
							<div class="alert-content">
								<div class="alert-title">Link Method to Complete Withdrawal</div>
								<div class="alert-message">
									You're trying to withdraw {{ $activeCurrency->currency_symbol ?? '$' }}{{ number_format($pendingAmount, 2) }}. 
									Please link your {{ ucfirst($methodType) }} details to proceed.
								</div>
							</div>
						</div>
						@endif

						<div class="row">
							<div class="col-lg-8 mx-auto">
								<form method="POST" action="{{ route('store.linked.withdrawal.method') }}">
									@csrf
									<input type="hidden" name="method_type" value="{{ $methodType }}">

									@if($methodType === 'bank')
									<div class="card border-primary mb-4">
										<div class="card-header bg-primary text-white">
											<h5 class="card-title mb-0">
												<i class="align-middle" data-feather="shield"></i> Bank Account Details
											</h5>
										</div>
										<div class="card-body">
											<div class="row g-3">
												<div class="col-md-6">
													<label class="form-label fw-bold">Bank Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control form-control-lg" name="bank_name" 
														placeholder="e.g. GTBank" 
														value="{{ old('bank_name', $linkedMethod->bank_name ?? '') }}" required>
												</div>
												<div class="col-md-6">
													<label class="form-label fw-bold">Account Holder Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control form-control-lg" name="payment_account_name" 
														placeholder="Full name on account" 
														value="{{ old('payment_account_name', $linkedMethod->payment_account_name ?? '') }}" required>
												</div>
												<div class="col-md-6">
													<label class="form-label fw-bold">Account Number / IBAN <span class="text-danger">*</span></label>
													<input type="text" class="form-control form-control-lg" name="payment_account_number" 
														placeholder="Account number / IBAN" 
														value="{{ old('payment_account_number', $linkedMethod->payment_account_number ?? '') }}" required>
												</div>
												<div class="col-md-6">
													<label class="form-label fw-bold">Account Type <span class="text-danger">*</span></label>
													<select class="form-select form-select-lg" name="payment_account_type" required>
														<option value="">Select account type</option>
														<option value="checking" {{ old('payment_account_type', $linkedMethod->payment_account_type ?? '') == 'checking' ? 'selected' : '' }}>Checking</option>
														<option value="savings" {{ old('payment_account_type', $linkedMethod->payment_account_type ?? '') == 'savings' ? 'selected' : '' }}>Savings</option>
														<option value="current" {{ old('payment_account_type', $linkedMethod->payment_account_type ?? '') == 'current' ? 'selected' : '' }}>Current</option>
													</select>
												</div>
												<div class="col-md-6">
													<label class="form-label fw-bold">Routing / SWIFT <span class="text-danger">*</span></label>
													<input type="text" class="form-control form-control-lg" name="bank_routing_number" 
														placeholder="Routing or SWIFT/BIC" 
														value="{{ old('bank_routing_number', $linkedMethod->bank_routing_number ?? '') }}" required>
												</div>
											</div>
										</div>
									</div>
									@elseif($methodType === 'crypto')
									<div class="card border-success mb-4">
										<div class="card-header bg-success text-white">
											<h5 class="card-title mb-0">
												<i class="align-middle" data-feather="activity"></i> Cryptocurrency Wallet Details
											</h5>
										</div>
										<div class="card-body">
											<div class="row g-3">
												<div class="col-md-6">
													<label class="form-label fw-bold">Cryptocurrency <span class="text-danger">*</span></label>
													<select class="form-select form-select-lg" name="crypto_type" required>
														<option value="">Select coin</option>
														<option value="BTC" {{ old('crypto_type', $linkedMethod->crypto_type ?? '') == 'BTC' ? 'selected' : '' }}>Bitcoin (BTC)</option>
														<option value="ETH" {{ old('crypto_type', $linkedMethod->crypto_type ?? '') == 'ETH' ? 'selected' : '' }}>Ethereum (ETH)</option>
														<option value="USDT" {{ old('crypto_type', $linkedMethod->crypto_type ?? '') == 'USDT' ? 'selected' : '' }}>Tether (USDT)</option>
														<option value="USDC" {{ old('crypto_type', $linkedMethod->crypto_type ?? '') == 'USDC' ? 'selected' : '' }}>USD Coin (USDC)</option>
														<option value="BNB" {{ old('crypto_type', $linkedMethod->crypto_type ?? '') == '

BNB' ? 'selected' : '' }}>BNB</option>
														<option value="MATIC" {{ old('crypto_type', $linkedMethod->crypto_type ?? '') == 'MATIC' ? 'selected' : '' }}>Polygon (MATIC)</option>
													</select>
												</div>
												<div class="col-md-6">
													<label class="form-label fw-bold">Wallet Address <span class="text-danger">*</span></label>
													<input type="text" class="form-control form-control-lg" name="crypto_wallet_address" 
														placeholder="Paste your wallet address" 
														value="{{ old('crypto_wallet_address', $linkedMethod->crypto_wallet_address ?? '') }}" required>
													<small class="text-muted">Double-check your address. Crypto transactions are irreversible.</small>
												</div>
											</div>
										</div>
									</div>
									@elseif($methodType === 'paypal')
									<div class="card border-warning mb-4">
										<div class="card-header bg-warning text-dark">
											<h5 class="card-title mb-0">
												<i class="align-middle" data-feather="mail"></i> PayPal Details
											</h5>
										</div>
										<div class="card-body">
											<div class="row g-3">
												<div class="col-md-8">
													<label class="form-label fw-bold">PayPal Email <span class="text-danger">*</span></label>
													<input type="email" class="form-control form-control-lg" name="paypal_email" 
														placeholder="your-email@provider.com" 
														value="{{ old('paypal_email', $linkedMethod->paypal_email ?? '') }}" required>
												</div>
											</div>
										</div>
									</div>
									@elseif($methodType === 'other')
									<div class="card border-secondary mb-4">
										<div class="card-header bg-secondary text-white">
											<h5 class="card-title mb-0">
												<i class="align-middle" data-feather="settings"></i> Custom Withdrawal Method
											</h5>
										</div>
										<div class="card-body">
											<label class="form-label fw-bold">Method Details <span class="text-danger">*</span></label>
											<textarea class="form-control form-control-lg" name="withdrawal_details" rows="4" 
												placeholder="Enter the method + account details..." required>{{ old('withdrawal_details', $linkedMethod->withdrawal_details ?? '') }}</textarea>
										</div>
									</div>
									@endif

									<div class="d-grid gap-2">
										<button type="submit" class="btn btn-primary btn-lg py-3">
											<i class="align-middle" data-feather="{{ $linkedMethod ? 'refresh-cw' : 'link' }}"></i> 
											{{ $linkedMethod ? 'Update' : 'Link' }} {{ ucfirst($methodType) }} Method
										</button>
										<a href="{{ route('withdrawal') }}" class="btn btn-secondary btn-lg py-3">
											<i class="align-middle" data-feather="x"></i> Cancel
										</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		if (window.feather) {
			feather.replace();
		}
	});
</script>

@include('dashboard.footer')
