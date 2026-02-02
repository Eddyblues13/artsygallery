@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="h3 mb-0"><strong>Currency Settings</strong></h1>
			<div>
				<a href="{{ route('admin.currency.update.rates') }}" class="btn btn-info me-2" onclick="return confirm('This will update exchange rates from CoinGecko API. Continue?')">
					<i class="align-middle" data-feather="refresh-cw"></i> Update Exchange Rates
				</a>
				<a href="{{ route('admin.currency.create') }}" class="btn btn-primary">
					<i class="align-middle" data-feather="plus"></i> Add New Currency
				</a>
			</div>
		</div>

		@include('dashboard.alert')

		<!-- Active Currency Card -->
		@if($activeCurrency)
		<div class="card mb-4 border-success">
			<div class="card-header bg-success text-white">
				<h5 class="mb-0"><i class="align-middle" data-feather="check-circle"></i> Active Currency</h5>
			</div>
			<div class="card-body">
				<div class="row align-items-center">
					<div class="col-md-8">
						<h3 class="mb-1">{{ $activeCurrency->currency_symbol }} {{ $activeCurrency->currency_code }}</h3>
						<p class="text-muted mb-0">{{ $activeCurrency->currency_name }}</p>
						<small class="text-muted">Exchange Rate: 1 USD = {{ number_format($activeCurrency->exchange_rate, 4) }} {{ $activeCurrency->currency_code }}</small>
					</div>
					<div class="col-md-4 text-end">
						<span class="badge bg-success fs-6">Currently Active</span>
					</div>
				</div>
			</div>
		</div>
		@endif

		<!-- Currencies Table -->
		<div class="card">
			<div class="card-header">
				<h5 class="card-title mb-0">All Currencies</h5>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th>Symbol</th>
								<th>Exchange Rate</th>
								<th>Status</th>
								<th>Position</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@forelse($currencies as $currency)
							<tr class="{{ $currency->is_active ? 'table-success' : '' }}">
								<td><strong>{{ $currency->currency_code }}</strong></td>
								<td>{{ $currency->currency_name }}</td>
								<td><strong>{{ $currency->currency_symbol }}</strong></td>
								<td>
									<span class="badge bg-info">1 USD = {{ number_format($currency->exchange_rate, 4) }} {{ $currency->currency_code }}</span>
								</td>
								<td>
									@if($currency->is_active)
										<span class="badge bg-success">Active</span>
									@else
										<span class="badge bg-secondary">Inactive</span>
									@endif
								</td>
								<td>{{ $currency->position }}</td>
								<td>
									<div class="btn-group" role="group">
										@if(!$currency->is_active)
										<a href="{{ route('admin.currency.activate', $currency->id) }}" 
										   class="btn btn-sm btn-success" 
										   onclick="return confirm('Activate {{ $currency->currency_code }}? All prices will be converted automatically.')"
										   title="Activate">
											<i class="align-middle" data-feather="check"></i>
										</a>
										@endif
										<a href="{{ route('admin.currency.edit', $currency->id) }}" class="btn btn-sm btn-primary" title="Edit">
											<i class="align-middle" data-feather="edit"></i>
										</a>
										@if(!$currency->is_active && $currency->currency_code !== 'USD')
										<a href="{{ route('admin.currency.delete', $currency->id) }}" 
										   class="btn btn-sm btn-danger" 
										   onclick="return confirm('Are you sure you want to delete {{ $currency->currency_code }}?')"
										   title="Delete">
											<i class="align-middle" data-feather="trash-2"></i>
										</a>
										@endif
									</div>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="7" class="text-center">No currencies found. <a href="{{ route('admin.currency.create') }}">Create one</a></td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- Info Alert -->
		<div class="alert alert-info mt-4">
			<h6><i class="align-middle" data-feather="info"></i> How Currency Conversion Works</h6>
			<ul class="mb-0">
				<li>All prices in the database are stored in USD</li>
				<li>When you activate a currency, all displayed prices are automatically converted using the exchange rate</li>
				<li>Exchange rates can be updated automatically from CoinGecko API or set manually</li>
				<li>Only one currency can be active at a time</li>
				<li>USD is the base currency and cannot be deleted</li>
			</ul>
		</div>
	</div>
</main>

@include('admin.footer')

<script>
	feather.replace();
</script>
