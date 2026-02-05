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
								@if(count($linkedMethodTypes ?? []) > 0)
								You have {{ count($linkedMethodTypes) }} withdrawal method(s) linked. Select a method above.
								@else
								Please link a withdrawal method before you can withdraw.
								@endif
							</small>
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
	});
</script>

@include('dashboard.footer')
