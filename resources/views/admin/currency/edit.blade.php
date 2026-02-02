@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="mb-4">
			<a href="{{ route('admin.currency.settings') }}" class="btn btn-secondary mb-3">
				<i class="align-middle" data-feather="arrow-left"></i> Back to Currencies
			</a>
			<h1 class="h3 mb-0"><strong>Edit Currency</strong></h1>
		</div>

		@include('dashboard.alert')

		<div class="card">
			<div class="card-header">
				<h5 class="card-title mb-0">Currency Information</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('admin.currency.update', $currency->id) }}" method="POST">
					@csrf
					@method('PUT')

					<div class="row">
						<div class="col-md-12 mb-3">
							<label for="currency_select" class="form-label">Select Currency</label>
							<select class="form-select" id="currency_select" name="currency_select">
								<option value="">-- Select a Currency (Optional) --</option>
								@foreach($currencies as $curr)
								<option value="{{ $curr['code'] }}" 
										data-name="{{ $curr['name'] }}" 
										data-symbol="{{ $curr['symbol'] }}"
										{{ $currency->currency_code == $curr['code'] ? 'selected' : '' }}>
									{{ $curr['code'] }} - {{ $curr['name'] }} ({{ $curr['symbol'] }})
								</option>
								@endforeach
							</select>
							<small class="form-text text-muted">Select a currency to auto-fill Code, Name, Symbol, and Exchange Rate, or edit manually</small>
						</div>

						<div class="col-md-6 mb-3">
							<label for="currency_code" class="form-label">Currency Code <span class="text-danger">*</span></label>
							<input type="text" 
								   class="form-control @error('currency_code') is-invalid @enderror" 
								   id="currency_code" 
								   name="currency_code" 
								   value="{{ old('currency_code', $currency->currency_code) }}" 
								   placeholder="e.g., EUR, GBP, JPY" 
								   maxlength="3"
								   required>
							@error('currency_code')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
							<small class="form-text text-muted">ISO 4217 currency code (3 letters, uppercase)</small>
						</div>

						<div class="col-md-6 mb-3">
							<label for="currency_name" class="form-label">Currency Name <span class="text-danger">*</span></label>
							<input type="text" 
								   class="form-control @error('currency_name') is-invalid @enderror" 
								   id="currency_name" 
								   name="currency_name" 
								   value="{{ old('currency_name', $currency->currency_name) }}" 
								   placeholder="e.g., Euro, British Pound" 
								   required>
							@error('currency_name')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="col-md-6 mb-3">
							<label for="currency_symbol" class="form-label">Currency Symbol <span class="text-danger">*</span></label>
							<input type="text" 
								   class="form-control @error('currency_symbol') is-invalid @enderror" 
								   id="currency_symbol" 
								   name="currency_symbol" 
								   value="{{ old('currency_symbol', $currency->currency_symbol) }}" 
								   placeholder="e.g., €, £, ¥" 
								   maxlength="10"
								   required>
							@error('currency_symbol')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
							<small class="form-text text-muted">Symbol used to display prices (e.g., $, €, £)</small>
						</div>

						<div class="col-md-6 mb-3">
							<label for="exchange_rate" class="form-label">Exchange Rate (from USD) <span class="text-danger">*</span></label>
							<div class="input-group">
								<input type="number" 
									   step="0.00000001" 
									   class="form-control @error('exchange_rate') is-invalid @enderror" 
									   id="exchange_rate" 
									   name="exchange_rate" 
									   value="{{ old('exchange_rate', $currency->exchange_rate) }}" 
									   placeholder="1.00000000" 
									   min="0.00000001"
									   required>
								<button type="button" class="btn btn-outline-secondary" id="refreshRate" title="Refresh exchange rate">
									<i class="align-middle" data-feather="refresh-cw"></i>
								</button>
							</div>
							@error('exchange_rate')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
							<small class="form-text text-muted">Auto-fetched when currency is selected. How many units of this currency equal 1 USD</small>
						</div>

						<div class="col-md-6 mb-3">
							<label for="position" class="form-label">Position</label>
							<input type="number" 
								   class="form-control @error('position') is-invalid @enderror" 
								   id="position" 
								   name="position" 
								   value="{{ old('position', $currency->position) }}" 
								   min="0">
							@error('position')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
							<small class="form-text text-muted">Display order (lower numbers appear first)</small>
						</div>

						<div class="col-md-6 mb-3">
							<label class="form-label">Status</label>
							<div class="form-control-plaintext">
								@if($currency->is_active)
									<span class="badge bg-success">Active</span>
									<small class="text-muted d-block mt-1">To deactivate, activate another currency instead</small>
								@else
									<span class="badge bg-secondary">Inactive</span>
									<a href="{{ route('admin.currency.activate', $currency->id) }}" class="btn btn-sm btn-success mt-2">
										Activate This Currency
									</a>
								@endif
							</div>
						</div>
					</div>

					<div class="d-flex justify-content-end gap-2">
						<a href="{{ route('admin.currency.settings') }}" class="btn btn-secondary">Cancel</a>
						<button type="submit" class="btn btn-primary">
							<i class="align-middle" data-feather="save"></i> Update Currency
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>

@include('admin.footer')

<script>
	feather.replace();
	
	// Auto-fill all fields and fetch exchange rate when currency is selected
	document.getElementById('currency_select').addEventListener('change', async function(e) {
		const selectedOption = this.options[this.selectedIndex];
		if (selectedOption.value) {
			const code = selectedOption.value;
			const name = selectedOption.dataset.name;
			const symbol = selectedOption.dataset.symbol;
			
			// Get all input fields
			const codeInput = document.getElementById('currency_code');
			const nameInput = document.getElementById('currency_name');
			const symbolInput = document.getElementById('currency_symbol');
			const rateInput = document.getElementById('exchange_rate');
			
			// Auto-fill all fields with visual feedback
			codeInput.value = code;
			codeInput.style.backgroundColor = '#d4edda';
			setTimeout(() => { codeInput.style.backgroundColor = ''; }, 2000);
			
			nameInput.value = name;
			nameInput.style.backgroundColor = '#d4edda';
			setTimeout(() => { nameInput.style.backgroundColor = ''; }, 2000);
			
			symbolInput.value = symbol;
			symbolInput.style.backgroundColor = '#d4edda';
			setTimeout(() => { symbolInput.style.backgroundColor = ''; }, 2000);
			
			// Fetch and auto-fill exchange rate
			const originalValue = rateInput.value;
			rateInput.disabled = true;
			rateInput.value = 'Loading...';
			
			try {
				const response = await fetch(`{{ url('admin/currency/fetch-rate') }}/${code}`);
				const data = await response.json();
				
				if (data.success) {
					rateInput.value = data.rate;
					rateInput.style.backgroundColor = '#d4edda';
					setTimeout(() => {
						rateInput.style.backgroundColor = '';
					}, 2000);
				} else {
					rateInput.value = originalValue;
					alert('Could not fetch exchange rate automatically. Please enter it manually.');
				}
			} catch (error) {
				rateInput.value = originalValue;
				console.error('Error fetching exchange rate:', error);
				alert('Could not fetch exchange rate automatically. Please enter it manually.');
			} finally {
				rateInput.disabled = false;
			}
		}
	});
	
	// Auto-uppercase currency code
	document.getElementById('currency_code').addEventListener('input', function(e) {
		this.value = this.value.toUpperCase();
	});
	
	// Refresh exchange rate button
	document.getElementById('refreshRate').addEventListener('click', async function() {
		const code = document.getElementById('currency_code').value;
		if (!code) {
			alert('Please select or enter a currency code first');
			return;
		}
		
		const rateInput = document.getElementById('exchange_rate');
		const originalValue = rateInput.value;
		rateInput.disabled = true;
		rateInput.value = 'Loading...';
		this.disabled = true;
		
		try {
			const response = await fetch(`{{ url('admin/currency/fetch-rate') }}/${code}`);
			const data = await response.json();
			
			if (data.success) {
				rateInput.value = data.rate;
				rateInput.style.backgroundColor = '#d4edda';
				setTimeout(() => {
					rateInput.style.backgroundColor = '';
				}, 2000);
			} else {
				rateInput.value = originalValue;
				alert('Could not fetch exchange rate: ' + (data.message || 'Unknown error'));
			}
		} catch (error) {
			rateInput.value = originalValue;
			console.error('Error fetching exchange rate:', error);
			alert('Could not fetch exchange rate. Please try again or enter manually.');
		} finally {
			rateInput.disabled = false;
			this.disabled = false;
			feather.replace();
		}
	});
</script>
