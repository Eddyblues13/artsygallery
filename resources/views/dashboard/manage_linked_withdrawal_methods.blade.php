@include('dashboard.header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-12">
				<div class="card shadow-sm">
					<div class="card-header bg-primary text-white">
						<h1 class="card-title mb-0">
							<i class="align-middle" data-feather="credit-card"></i> Manage Withdrawal Methods
						</h1>
					</div>

					<div class="card-body">
					@include('dashboard.alert')

						@if($linkedMethods->count() > 0)
						<div class="row">
							@foreach($linkedMethods as $method)
							<div class="col-md-6 col-lg-4 mb-4">
								<div class="card h-100 border-primary">
									<div class="card-header bg-primary text-white">
										<h5 class="card-title mb-0">
											<i class="align-middle" data-feather="{{ $method->getMaskedDetails()['icon'] }}"></i> 
											{{ $method->getMaskedDetails()['type'] }}
										</h5>
									</div>
									<div class="card-body">
										<p class="card-text"><strong>Details:</strong><br>{{ $method->getMaskedDetails()['details'] }}</p>
										<p class="text-muted small">Linked {{ $method->created_at->diffForHumans() }}</p>
									</div>
									<div class="card-footer bg-light">
										<div class="d-grid gap-2">
											<a href="{{ route('link.withdrawal.method', $method->method_type) }}" class="btn btn-sm btn-primary">
												<i class="align-middle" data-feather="edit-2"></i> Update
											</a>
											<form method="POST" action="{{ route('delete.linked.method', $method->id) }}" 
												onsubmit="return confirm('Are you sure you want to remove this withdrawal method?');">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-sm btn-danger w-100">
													<i class="align-middle" data-feather="trash-2"></i> Remove
												</button>
											</form>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						@else
						<div class="alert alert-info">
							<div class="d-flex align-items-center">
								<i class="align-middle me-3" data-feather="info" style="width: 32px; height: 32px;"></i>
								<div>
									<h5 class="mb-1">No Withdrawal Methods Linked</h5>
									<p class="mb-0">You haven't linked any withdrawal methods yet. Link a method to start withdrawing funds.</p>
								</div>
							</div>
						</div>
						@endif

						<div class="mt-4">
							<h5>Add New Withdrawal Method</h5>
							<div class="row">
								<div class="col-md-6 col-lg-3 mb-3">
									<a href="{{ route('link.withdrawal.method', 'bank') }}" class="btn btn-outline-primary w-100 py-3">
										<i class="align-middle" data-feather="shield"></i><br>Bank Transfer
									</a>
								</div>
								<div class="col-md-6 col-lg-3 mb-3">
									<a href="{{ route('link.withdrawal.method', 'crypto') }}" class="btn btn-outline-success w-100 py-3">
										<i class="align-middle" data-feather="activity"></i><br>Cryptocurrency
									</a>
								</div>
								<div class="col-md-6 col-lg-3 mb-3">
									<a href="{{ route('link.withdrawal.method', 'paypal') }}" class="btn btn-outline-warning w-100 py-3">
										<i class="align-middle" data-feather="mail"></i><br>PayPal
									</a>
								</div>
								<div class="col-md-6 col-lg-3 mb-3">
									<a href="{{ route('link.withdrawal.method', 'other') }}" class="btn btn-outline-secondary w-100 py-3">
										<i class="align-middle" data-feather="settings"></i><br>Other Method
									</a>
								</div>
							</div>
						</div>

						<div class="mt-4">
							<a href="{{ route('withdrawal') }}" class="btn btn-secondary">
								<i class="align-middle" data-feather="arrow-left"></i> Back to Withdrawals
							</a>
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
