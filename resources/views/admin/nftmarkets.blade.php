@include('admin.dashboard_header')

<main class="content">
	<div class="container-fluid p-0">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="h3 mb-0"><strong>Artwork Marketplace</strong></h1>
			<div>
				<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse">
					<i class="align-middle" data-feather="filter"></i> Filters
				</button>
			</div>
		</div>

		<!-- Statistics Cards -->
		<div class="row mb-4">
			<div class="col-sm-6 col-xl-4">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Total Artworks</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-primary">
									<i class="align-middle" data-feather="image"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ number_format($stats['total']) }}</b></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-4">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Total Market Value</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-success">
									<i class="align-middle" data-feather="dollar-sign"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($stats['total_value'], 2) }}</b></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-4">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Average Price</h5>
							</div>
							<div class="col-auto">
								<div class="stat text-info">
									<i class="align-middle" data-feather="trending-up"></i>
								</div>
							</div>
						</div>
						<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($stats['average_price'], 2) }}</b></h3>
					</div>
				</div>
			</div>
		</div>

		<!-- Filters Collapse -->
		<div class="collapse mb-4" id="filtersCollapse">
			<div class="card">
				<div class="card-body">
					<form method="GET" action="{{ route('admin.buy.nft') }}" class="row g-3">
						<div class="col-md-4">
							<label for="search" class="form-label">Search</label>
							<input type="text" class="form-control" id="search" name="search" 
								value="{{ request('search') }}" placeholder="Artwork name, owner, artist...">
						</div>
						<div class="col-md-2">
							<label for="price_min" class="form-label">Min Price ($)</label>
							<input type="number" class="form-control" id="price_min" name="price_min" 
								value="{{ request('price_min') }}" placeholder="0" step="0.01" min="0">
						</div>
						<div class="col-md-2">
							<label for="price_max" class="form-label">Max Price ($)</label>
							<input type="number" class="form-control" id="price_max" name="price_max" 
								value="{{ request('price_max') }}" placeholder="Any" step="0.01" min="0">
						</div>
						<div class="col-md-2">
							<label for="sort" class="form-label">Sort By</label>
							<select class="form-select" id="sort" name="sort">
								<option value="updated_at" {{ request('sort') == 'updated_at' ? 'selected' : '' }}>Latest</option>
								<option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
								<option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
								<option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
							</select>
						</div>
						<div class="col-md-2 d-flex align-items-end">
							<button type="submit" class="btn btn-primary w-100">
								<i class="align-middle" data-feather="search"></i> Search
							</button>
						</div>
						@if(request()->hasAny(['search', 'price_min', 'price_max', 'sort']))
						<div class="col-12">
							<a href="{{ route('admin.buy.nft') }}" class="btn btn-outline-secondary btn-sm">
								<i class="align-middle" data-feather="x"></i> Clear Filters
							</a>
						</div>
						@endif
					</form>
				</div>
			</div>
		</div>

		<!-- Artworks Grid -->
		<div class="row g-4">
			@forelse($buy_nft as $artwork)
			<div class="col-lg-3 col-md-4 col-sm-6">
				<div class="card h-100 shadow-sm border-0 artwork-card">
					<div class="position-relative">
						@if($artwork->ntf_image)
						<img src="{{ asset('user/uploads/nfts/' . $artwork->ntf_image) }}" 
							class="card-img-top artwork-image" 
							alt="{{ $artwork->ntf_name }}"
							onerror="this.src='https://via.placeholder.com/400x400?text=Artwork'">
						@else
						<img src="https://via.placeholder.com/400x400?text=Artwork" 
							class="card-img-top artwork-image" 
							alt="{{ $artwork->ntf_name }}">
						@endif
						<div class="position-absolute top-0 end-0 m-2">
							<span class="badge bg-success">
								<i class="align-middle" data-feather="check-circle"></i> Approved
							</span>
						</div>
						<div class="artwork-overlay">
							<button type="button" class="btn btn-primary" 
								data-bs-toggle="modal" 
								data-bs-target="#artworkModal{{ $artwork->id }}">
								<i class="align-middle" data-feather="eye"></i> View Details
							</button>
						</div>
					</div>
					<div class="card-body">
						<h5 class="card-title mb-2">
							<button type="button" class="btn btn-link text-decoration-none text-dark p-0" 
								data-bs-toggle="modal" 
								data-bs-target="#artworkModal{{ $artwork->id }}">
								{{ Str::limit($artwork->ntf_name, 30) }}
							</button>
						</h5>
						@if($artwork->ntf_owner)
						<p class="text-muted small mb-2">
							<i class="align-middle" data-feather="user"></i> 
							<strong>Owner:</strong> {{ $artwork->ntf_owner }}
						</p>
						@endif
						@if($artwork->user)
						<p class="text-muted small mb-2">
							<i class="align-middle" data-feather="user-check"></i> 
							<strong>Artist:</strong> 
							<a href="{{ url('profile/' . $artwork->user->id) }}" class="text-decoration-none">
								{{ $artwork->user->name }}
							</a>
						</p>
						@endif
						@if($artwork->ntf_description)
						<p class="card-text small text-muted mb-3">
							{{ Str::limit($artwork->ntf_description, 80) }}
						</p>
						@endif
					</div>
					<div class="card-footer bg-white border-top">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								<div class="fw-bold text-primary">{{ \App\Helpers\CurrencyHelper::format($artwork->nft_price, 2) }}</div>
							</div>
							<button type="button" class="btn btn-primary" 
								data-bs-toggle="modal" 
								data-bs-target="#artworkModal{{ $artwork->id }}">
								<i class="align-middle" data-feather="eye"></i> View
							</button>
						</div>
					</div>

					<!-- Artwork Details Modal -->
					<div class="modal fade" id="artworkModal{{ $artwork->id }}" tabindex="-1">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Artwork Details</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6">
											@if($artwork->ntf_image)
											<img src="{{ asset('user/uploads/nfts/' . $artwork->ntf_image) }}" 
												class="img-fluid rounded" 
												alt="{{ $artwork->ntf_name }}"
												onerror="this.src='https://via.placeholder.com/400x400?text=Artwork'">
											@else
											<img src="https://via.placeholder.com/400x400?text=Artwork" 
												class="img-fluid rounded" 
												alt="{{ $artwork->ntf_name }}">
											@endif
										</div>
										<div class="col-md-6">
											<h4 class="mb-3">{{ $artwork->ntf_name }}</h4>
											
											<div class="mb-3">
												<strong>Price:</strong>
												<div class="h5 text-primary">{{ \App\Helpers\CurrencyHelper::format($artwork->nft_price, 2) }}</div>
											</div>

											@if($artwork->ntf_owner)
											<div class="mb-3">
												<strong><i class="align-middle" data-feather="user"></i> Owner:</strong>
												<p class="mb-0">{{ $artwork->ntf_owner }}</p>
											</div>
											@endif

											@if($artwork->user)
											<div class="mb-3">
												<strong><i class="align-middle" data-feather="user-check"></i> Artist:</strong>
												<p class="mb-0">
													<a href="{{ url('profile/' . $artwork->user->id) }}" class="text-decoration-none">
														{{ $artwork->user->name }}
													</a>
													<br>
													<small class="text-muted">{{ $artwork->user->email }}</small>
												</p>
											</div>
											@endif

											@if($artwork->ntf_description)
											<div class="mb-3">
												<strong><i class="align-middle" data-feather="file-text"></i> Description:</strong>
												<p class="mb-0">{{ $artwork->ntf_description }}</p>
											</div>
											@endif

											<div class="mb-3">
												<strong><i class="align-middle" data-feather="calendar"></i> Listed:</strong>
												<p class="mb-0">{{ $artwork->created_at->format('M d, Y') }}</p>
											</div>

											<div class="mb-3">
												<strong><i class="align-middle" data-feather="info"></i> Status:</strong>
												<span class="badge bg-success ms-2">
													<i class="align-middle" data-feather="check-circle"></i> Approved
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									@if($artwork->user)
									<a href="{{ url('profile/' . $artwork->user->id) }}" class="btn btn-outline-primary">
										<i class="align-middle" data-feather="user"></i> View Artist Profile
									</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@empty
			<div class="col-12">
				<div class="card">
					<div class="card-body text-center py-5">
						<i class="align-middle" data-feather="image" style="width: 64px; height: 64px; opacity: 0.3;"></i>
						<h5 class="mt-3 text-muted">No artworks found</h5>
						<p class="text-muted">Try adjusting your search or filters</p>
						@if(request()->hasAny(['search', 'price_min', 'price_max', 'sort']))
						<a href="{{ route('admin.buy.nft') }}" class="btn btn-outline-primary">
							Clear filters to see all artworks
						</a>
						@endif
					</div>
				</div>
			</div>
			@endforelse
		</div>

		<!-- Pagination -->
		@if($buy_nft->hasPages())
		<div class="d-flex justify-content-between align-items-center mt-4">
			<div class="text-muted">
				Showing {{ $buy_nft->firstItem() ?? 0 }} to {{ $buy_nft->lastItem() ?? 0 }} of {{ $buy_nft->total() }} artworks
			</div>
			<div>
				{{ $buy_nft->links() }}
			</div>
		</div>
		@endif
	</div>
</main>

<style>
	.artwork-card {
		transition: transform 0.3s ease, box-shadow 0.3s ease;
		border-radius: 12px;
		overflow: hidden;
	}

	.artwork-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
	}

	.artwork-image {
		height: 250px;
		object-fit: cover;
		transition: transform 0.3s ease;
		width: 100%;
	}

	.artwork-card:hover .artwork-image {
		transform: scale(1.05);
	}

	.artwork-overlay {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: rgba(0, 0, 0, 0.7);
		display: flex;
		align-items: center;
		justify-content: center;
		opacity: 0;
		transition: opacity 0.3s ease;
	}

	.artwork-card:hover .artwork-overlay {
		opacity: 1;
	}

	.card-footer {
		border-radius: 0 0 12px 12px;
	}

	.stat {
		font-size: 2rem;
		opacity: 0.8;
	}

	.badge {
		padding: 0.5em 0.75em;
		font-weight: 500;
	}

	@media (max-width: 768px) {
		.artwork-image {
			height: 200px;
		}
	}
</style>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Feather Icons
		if (typeof feather !== 'undefined') {
			feather.replace();
		}
	});
</script>

@include('dashboard.footer')
