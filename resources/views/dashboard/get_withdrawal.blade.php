@include('dashboard.header')

@if(session('success') && ($showWithdrawalModal ?? true))
{{-- Success modal after withdrawal (message and visibility set by admin) --}}
<div id="withdrawalNoticePop" class="withdrawal-notice-pop" role="alert">
	<div class="withdrawal-notice-pop-inner">
		<div class="withdrawal-notice-pop-icon">
			<i class="align-middle" data-feather="check-circle"></i>
		</div>
		<h4 class="withdrawal-notice-pop-title">Success</h4>
		<p class="withdrawal-notice-pop-message">{{ $withdrawalModalMessage ?? session('success') }}</p>
		<button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('withdrawalNoticePop').classList.remove('show')">OK</button>
	</div>
</div>
<style>
	.withdrawal-notice-pop {
		position: fixed;
		top: 0; left: 0; right: 0; bottom: 0;
		background: rgba(0,0,0,0.4);
		z-index: 9999;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 1rem;
		opacity: 0;
		visibility: hidden;
		transition: opacity 0.3s ease, visibility 0.3s ease;
	}
	.withdrawal-notice-pop.show { opacity: 1; visibility: visible; }
	.withdrawal-notice-pop-inner {
		background: #fff;
		border-radius: 12px;
		box-shadow: 0 10px 40px rgba(0,0,0,0.2);
		padding: 1.75rem;
		max-width: 400px;
		width: 100%;
		text-align: center;
	}
	.withdrawal-notice-pop-icon { color: #198754; margin-bottom: 0.75rem; }
	.withdrawal-notice-pop-icon svg { width: 48px; height: 48px; }
	.withdrawal-notice-pop-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; }
	.withdrawal-notice-pop-message { color: #555; margin-bottom: 1.25rem; }
</style>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var pop = document.getElementById('withdrawalNoticePop');
		if (pop) { pop.classList.add('show'); if (typeof feather !== 'undefined') feather.replace(); }
	});
</script>
@endif

<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-12">
				<div class="card shadow-sm">
					<div class="card-header bg-primary text-white">
						<h1 class="card-title mb-0">
							<i class="align-middle" data-feather="arrow-up-circle"></i> Request Withdrawal
						</h1>
					</div>

					<div class="card-body">
						@include('dashboard.alert')

						<form method="post" action="{{ route('make.withdrawal') }}" id="withdrawalForm">
							@csrf

							<!-- Amount -->
							<div class="mb-4">
								<label class="form-label fw-bold">
									<i class="align-middle" data-feather="dollar-sign"></i> Withdrawal Amount ({{ $activeCurrency->currency_code ?? 'USD' }})
									<span class="text-danger">*</span>
								</label>
								@if($activeCurrency ?? null)
								<small class="text-muted d-block mb-1">Display currency: {{ $activeCurrency->currency_name }} ({{ $activeCurrency->currency_symbol }})</small>
								@endif
								<div class="input-group input-group-lg">
									<span class="input-group-text">{{ $activeCurrency->currency_symbol ?? '$' }}</span>
									<input
										type="number"
										class="form-control"
										name="amount"
										id="amount"
										placeholder="Enter amount"
										required
										min="1"
										step="0.01"
										value="{{ old('amount') }}"
									>
								</div>
								<small class="text-muted">Minimum withdrawal: {{ $activeCurrency->currency_symbol ?? '$' }}1.00</small>
							</div>

							<!-- Method Selection (vertical, simple radios) -->
							<div class="mb-4">
								<label class="form-label fw-bold mb-3">
									<i class="align-middle" data-feather="credit-card"></i> Select Withdrawal Method
									<span class="text-danger">*</span>
								</label>

								<div class="border rounded-3 p-3 bg-light">
									<div class="form-check mb-2">
										<input
											class="form-check-input"
											type="radio"
											name="withdrawal_method"
											id="withdraw_bank"
											value="bank"
											{{ old('withdrawal_method') == 'bank' ? 'checked' : '' }}
											required
										>
										<label class="form-check-label" for="withdraw_bank">
											<strong>Bank Transfer</strong>
											<span class="text-muted d-block small">Send funds directly to your bank account</span>
										</label>
									</div>

									<div class="form-check mb-2">
										<input
											class="form-check-input"
											type="radio"
											name="withdrawal_method"
											id="withdraw_crypto"
											value="crypto"
											{{ old('withdrawal_method') == 'crypto' ? 'checked' : '' }}
											required
										>
										<label class="form-check-label" for="withdraw_crypto">
											<strong>Cryptocurrency</strong>
											<span class="text-muted d-block small">Withdraw to your external wallet</span>
										</label>
									</div>

									<div class="form-check mb-2">
										<input
											class="form-check-input"
											type="radio"
											name="withdrawal_method"
											id="withdraw_paypal"
											value="paypal"
											{{ old('withdrawal_method') == 'paypal' ? 'checked' : '' }}
											required
										>
										<label class="form-check-label" for="withdraw_paypal">
											<strong>PayPal</strong>
											<span class="text-muted d-block small">Withdraw to your PayPal account</span>
										</label>
									</div>

									<div class="form-check">
										<input
											class="form-check-input"
											type="radio"
											name="withdrawal_method"
											id="withdraw_other"
											value="other"
											{{ old('withdrawal_method') == 'other' ? 'checked' : '' }}
											required
										>
										<label class="form-check-label" for="withdraw_other">
											<strong>Other Method</strong>
											<span class="text-muted d-block small">Specify a custom withdrawal method</span>
										</label>
									</div>
								</div>

								<div class="mt-2">
									<small class="text-muted">
										After selecting a method, the specific details fields will appear below.
									</small>
								</div>
							</div>

							<!-- Method Fields (Hidden until a method is selected) -->
							<div id="methodFields" class="mt-3" style="display:none;">
								<!-- Bank -->
								<div id="bankFields" class="method-fields card border-primary mb-4" style="display:none;">
									<div class="card-header bg-primary text-white d-flex align-items-center">
										<i class="align-middle me-2" data-feather="shield"></i>
										<h5 class="card-title mb-0">Bank Account Details</h5>
									</div>
									<div class="card-body">
										<div class="row g-4">
											<div class="col-md-6">
												<label class="form-label fw-bold">Bank Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control form-control-lg" name="bank_name" placeholder="e.g. GTBank" value="{{ old('bank_name') }}" disabled>
											</div>
											<div class="col-md-6">
												<label class="form-label fw-bold">Account Holder Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control form-control-lg" name="payment_account_name" placeholder="Full name on account" value="{{ old('payment_account_name') }}" disabled>
											</div>
											<div class="col-md-6">
												<label class="form-label fw-bold">Account Number / IBAN <span class="text-danger">*</span></label>
												<input type="text" class="form-control form-control-lg" name="payment_account_number" placeholder="Account number / IBAN" value="{{ old('payment_account_number') }}" disabled>
											</div>
											<div class="col-md-6">
												<label class="form-label fw-bold">Account Type <span class="text-danger">*</span></label>
												<select class="form-select form-select-lg" name="payment_account_type" disabled>
													<option value="">Select account type</option>
													<option value="checking" {{ old('payment_account_type') == 'checking' ? 'selected' : '' }}>Checking</option>
													<option value="savings" {{ old('payment_account_type') == 'savings' ? 'selected' : '' }}>Savings</option>
													<option value="current" {{ old('payment_account_type') == 'current' ? 'selected' : '' }}>Current</option>
												</select>
											</div>
											<div class="col-md-6">
												<label class="form-label fw-bold">Routing / SWIFT <span class="text-danger">*</span></label>
												<input type="text" class="form-control form-control-lg" name="bank_routing_number" placeholder="Routing or SWIFT/BIC" value="{{ old('bank_routing_number') }}" disabled>
											</div>
										</div>
									</div>
								</div>

								<!-- Crypto -->
								<div id="cryptoFields" class="method-fields card border-success mb-4" style="display:none;">
									<div class="card-header bg-success text-white d-flex align-items-center">
										<i class="align-middle me-2" data-feather="activity"></i>
										<h5 class="card-title mb-0">Cryptocurrency Wallet Details</h5>
									</div>
									<div class="card-body">
										<div class="row g-4">
											<div class="col-md-6">
												<label class="form-label fw-bold">Cryptocurrency <span class="text-danger">*</span></label>
												<select class="form-select form-select-lg" name="crypto_type" disabled>
													<option value="">Select coin</option>
													<option value="BTC" {{ old('crypto_type') == 'BTC' ? 'selected' : '' }}>Bitcoin (BTC)</option>
													<option value="ETH" {{ old('crypto_type') == 'ETH' ? 'selected' : '' }}>Ethereum (ETH)</option>
													<option value="USDT" {{ old('crypto_type') == 'USDT' ? 'selected' : '' }}>Tether (USDT)</option>
													<option value="USDC" {{ old('crypto_type') == 'USDC' ? 'selected' : '' }}>USD Coin (USDC)</option>
													<option value="BNB" {{ old('crypto_type') == 'BNB' ? 'selected' : '' }}>BNB</option>
													<option value="MATIC" {{ old('crypto_type') == 'MATIC' ? 'selected' : '' }}>Polygon (MATIC)</option>
												</select>
											</div>
											<div class="col-md-6">
												<label class="form-label fw-bold">Wallet Address <span class="text-danger">*</span></label>
												<input type="text" class="form-control form-control-lg" name="crypto_wallet_address" placeholder="Paste your wallet address" value="{{ old('crypto_wallet_address') }}" disabled>
												<small class="text-muted">Double-check your address. Crypto transactions are irreversible.</small>
											</div>
										</div>
									</div>
								</div>

								<!-- PayPal -->
								<div id="paypalFields" class="method-fields card border-warning mb-4" style="display:none;">
									<div class="card-header bg-warning text-dark d-flex align-items-center">
										<i class="align-middle me-2" data-feather="mail"></i>
										<h5 class="card-title mb-0">PayPal Details</h5>
									</div>
									<div class="card-body">
										<div class="row g-4">
											<div class="col-md-8">
												<label class="form-label fw-bold">PayPal Email <span class="text-danger">*</span></label>
												<input type="email" class="form-control form-control-lg" name="paypal_email" placeholder="your-email@provider.com" value="{{ old('paypal_email') }}" disabled>
											</div>
										</div>
									</div>
								</div>

								<!-- Other -->
								<div id="otherFields" class="method-fields card border-secondary mb-4" style="display:none;">
									<div class="card-header bg-secondary text-white d-flex align-items-center">
										<i class="align-middle me-2" data-feather="settings"></i>
										<h5 class="card-title mb-0">Custom Withdrawal Method</h5>
									</div>
									<div class="card-body">
										<label class="form-label fw-bold">Method Details <span class="text-danger">*</span></label>
										<textarea
											class="form-control form-control-lg"
											name="withdrawal_details"
											rows="3"
											placeholder="Enter the method + account details..."
											disabled
										>{{ old('withdrawal_details') }}</textarea>
									</div>
								</div>
							</div>

							<!-- Submit -->
							<div class="d-grid gap-2 mt-4">
								<button type="submit" class="btn btn-primary btn-lg py-3">
									<i class="align-middle" data-feather="send"></i> Submit Withdrawal Request
								</button>
							</div>

						</form>
					</div><!-- /card-body -->
				</div><!-- /card -->
			</div>
		</div>
	</div>
</main>

<style>
	/* No special layout needed now; keep only any extra helpers if required */
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		if (window.feather) {
			feather.replace();
		}

		const methodFieldsWrap = document.getElementById('methodFields');
		const methodInputs = document.querySelectorAll('input[name="withdrawal_method"]');

		const sections = {
			bank: document.getElementById('bankFields'),
			crypto: document.getElementById('cryptoFields'),
			paypal: document.getElementById('paypalFields'),
			other: document.getElementById('otherFields'),
		};

		const requiredByMethod = {
			bank: ['bank_name', 'payment_account_name', 'payment_account_number', 'payment_account_type', 'bank_routing_number'],
			crypto: ['crypto_type', 'crypto_wallet_address'],
			paypal: ['paypal_email'],
			other: ['withdrawal_details'],
		};

		function setAllDisabled() {
			Object.values(sections).forEach(sec => {
				if (!sec) return;
				sec.style.display = 'none';
				sec.querySelectorAll('input, select, textarea').forEach(el => {
					el.disabled = true;
					el.required = false;
				});
			});
			methodFieldsWrap.style.display = 'none';
		}

		function activateMethod(method) {
			setAllDisabled();

			const activeSection = sections[method];
			if (!activeSection) return;

			methodFieldsWrap.style.display = 'block';
			activeSection.style.display = 'block';

			activeSection.querySelectorAll('input, select, textarea').forEach(el => {
				el.disabled = false;
			});

			(requiredByMethod[method] || []).forEach(name => {
				const el = document.querySelector('[name="' + name + '"]');
				if (el) el.required = true;
			});
		}

		// Radio change (clicking label or input)
		methodInputs.forEach(input => {
			input.addEventListener('change', function () {
				if (this.checked) {
					activateMethod(this.value);
				}
			});
		});

		// Initial state (after validation errors, etc.)
		const checked = document.querySelector('input[name="withdrawal_method"]:checked');
		if (checked) {
			activateMethod(checked.value);
		} else {
			setAllDisabled();
		}
	});
</script>

@include('dashboard.footer')
