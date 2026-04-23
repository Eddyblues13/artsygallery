@include('dashboard.header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-12">
				<div class="card shadow-sm">
					<div class="card-header bg-primary text-white">
						<h1 class="card-title mb-0">
							<i class="align-middle" data-feather="link"></i> Link ETH Withdrawal Wallet
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
									You're trying to withdraw <small class="text-muted">{{
										$activeCurrency->currency_symbol ?? '$' }}{{
										number_format($pendingAmount, 2) }}</small>
									<b class="eth-conversion" style="color: #6f42c1;"
										data-usd="{{ \App\Helpers\CurrencyHelper::convert($pendingAmount) }}">≈ {{
										\App\Helpers\CurrencyHelper::formatEth($pendingAmount) }}</b>.
									Please link your ETH wallet details to proceed.
								</div>
							</div>
						</div>
						@endif

						<div class="row">
							<div class="col-lg-8 mx-auto">
								<form method="POST" action="{{ route('store.linked.withdrawal.method') }}">
									@csrf
									<input type="hidden" name="method_type" value="{{ $methodType }}">

									<div class="card border-info mb-4">
										<div class="card-header bg-info text-white">
											<h5 class="card-title mb-0">
												<i class="align-middle" data-feather="activity"></i> ETH Wallet Details
											</h5>
										</div>
										<div class="card-body">
											<div class="row g-3">
												<div class="col-md-6">
													<label class="form-label fw-bold">Network / Coin <span
															class="text-danger">*</span></label>
													<select class="form-select form-select-lg" name="crypto_type"
														required>
														<option value="">Select network</option>
														<option value="ETH" {{ old('crypto_type', $linkedMethod->
															crypto_type ?? '') == 'ETH' ? 'selected' : '' }}>ETH
														</option>
														<option value="ERC20" {{ old('crypto_type', $linkedMethod->
															crypto_type ?? '') == 'ERC20' ? 'selected' : '' }}>ERC20
														</option>
													</select>
												</div>
												<div class="col-md-12">
													<label class="form-label fw-bold">ETH Wallet Address <span
															class="text-danger">*</span></label>
													<input type="text" class="form-control form-control-lg"
														name="crypto_wallet_address" placeholder="0x..."
														value="{{ old('crypto_wallet_address', $linkedMethod->crypto_wallet_address ?? '') }}"
														required>
													<small class="text-muted">Only ETH-compatible wallet addresses are
														accepted for withdrawals.</small>
												</div>
											</div>
										</div>
									</div>

									<div class="d-grid gap-2">
										<button type="submit" class="btn btn-primary btn-lg py-3">
											<i class="align-middle"
												data-feather="{{ $linkedMethod ? 'refresh-cw' : 'link' }}"></i>
											{{ $linkedMethod ? 'Update' : 'Link' }} ETH Wallet
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

<script>
	function refreshEthPrices() {
		fetch('{{ route("api.eth.price") }}')
			.then(r => r.json())
			.then(data => {
				if (data.eth_price_usd) {
					document.querySelectorAll('.eth-conversion').forEach(el => {
						const usd = parseFloat(el.dataset.usd);
						if (usd && data.eth_price_usd > 0) {
							const eth = (usd / data.eth_price_usd).toFixed(6);
							el.textContent = '≈ ' + eth + ' ETH';
						}
					});
				}
			}).catch(() => {});
	}
	setInterval(refreshEthPrices, 60000);
</script>

@include('dashboard.footer')