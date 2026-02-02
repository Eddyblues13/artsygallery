@include('admin.dashboard_header')

<main class="content">
    <div class="container-fluid p-0">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <h1 class="h3 mb-0"><strong>All Artworks</strong></h1>
            
            <button class="btn btn-primary d-md-none w-100" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse">
                <i class="align-middle" data-feather="filter"></i> Show Filters
            </button>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4 g-3">
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="card-subtitle text-muted">Total</h6>
                            <i class="align-middle text-primary" data-feather="image"></i>
                        </div>
                        <h3 class="mb-0">{{ number_format($stats['total']) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="card-subtitle text-muted">Approved</h6>
                            <i class="align-middle text-success" data-feather="check-circle"></i>
                        </div>
                        <h3 class="mb-0">{{ number_format($stats['approved']) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="card-subtitle text-muted">Pending</h6>
                            <i class="align-middle text-warning" data-feather="clock"></i>
                        </div>
                        <h3 class="mb-0">{{ number_format($stats['pending']) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="card-subtitle text-muted">Sold</h6>
                            <i class="align-middle text-info" data-feather="shopping-bag"></i>
                        </div>
                        <h3 class="mb-0">{{ number_format($stats['sold']) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Collapse -->
        <div class="collapse d-md-block mb-4" id="filtersCollapse">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('users.uploaded.nft') }}" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Search / Key Words</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i data-feather="search"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="search" 
                                    value="{{ request('search') }}" placeholder="Artwork name, owner...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-muted">Status</label>
                            <select class="form-select" name="status">
                                <option value="">All Status</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Approved</option>
                                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Sold</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-muted">Min Price</label>
                            <input type="number" class="form-control" name="price_min" 
                                value="{{ request('price_min') }}" placeholder="Min" step="0.01">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-muted">Max Price</label>
                            <input type="number" class="form-control" name="price_max" 
                                value="{{ request('price_max') }}" placeholder="Max" step="0.01">
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            @if(request()->hasAny(['search', 'status', 'price_min', 'price_max']))
                            <a href="{{ route('users.uploaded.nft') }}" class="btn btn-light w-100" title="Clear">
                                <i data-feather="x"></i>
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">Artwork List</h5>
            </div>
            <div class="card-body p-0">
                <!-- Desktop Table View -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4" style="width: 80px;">Image</th>
                                <th>Details</th>
                                <th>Owner / Artist</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nfts as $artwork)
                            <tr>
                                <td class="ps-4">
                                    <div class="position-relative" style="width: 60px; height: 60px;">
                                        @if(Str::startsWith($artwork->ntf_image, ['http', 'https']))
                                            <img src="{{ $artwork->ntf_image }}" class="rounded shadow-sm w-100 h-100 object-fit-cover" 
                                                alt="{{ $artwork->ntf_name }}" 
                                                onerror="this.src='https://via.placeholder.com/60x60?text=NFT'">
                                        @else
                                            <img src="{{ asset('user/uploads/nfts/' . $artwork->ntf_image) }}" class="rounded shadow-sm w-100 h-100 object-fit-cover" 
                                                alt="{{ $artwork->ntf_name }}"
                                                onerror="this.src='https://via.placeholder.com/60x60?text=NFT'">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-1 text-dark fw-bold">{{ $artwork->ntf_name }}</h6>
                                    <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                        {{ Str::limit($artwork->ntf_description, 50) }}
                                    </small>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium text-dark">{{ $artwork->ntf_owner }}</span>
                                        @if($artwork->user)
                                        <small class="text-muted">{{ $artwork->user->email }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">${{ number_format($artwork->nft_price, 2) }}</div>
                                    <small class="text-muted">{{ number_format($artwork->nft_eth_price ?? 0, 4) }} ETH</small>
                                </td>
                                <td>
                                    @if($artwork->status == '1')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">Approved</span>
                                    @elseif($artwork->status == '0')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 rounded-pill">Pending</span>
                                    @elseif($artwork->status == '2')
                                        <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill">Sold</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.edit.nft', $artwork->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="align-middle" data-feather="edit-2"></i>
                                        </a>
                                        <a href="{{ route('admin.delete.nft', $artwork->id) }}" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Are you sure you want to delete this NFT?')" title="Delete">
                                            <i class="align-middle" data-feather="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i data-feather="inbox" style="width: 48px; height: 48px; opacity: 0.5"></i>
                                        <p class="mt-2">No artworks found matching your criteria</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="d-md-none bg-light p-3">
                    @forelse($nfts as $artwork)
                    <div class="card mb-3 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                        <div class="d-flex">
                            <div class="flex-shrink-0" style="width: 100px;">
                                @if(Str::startsWith($artwork->ntf_image, ['http', 'https']))
                                    <img src="{{ $artwork->ntf_image }}" class="h-100 w-100 object-fit-cover" 
                                        alt="{{ $artwork->ntf_name }}" 
                                        onerror="this.src='https://via.placeholder.com/100x100?text=NFT'">
                                @else
                                    <img src="{{ asset('user/uploads/nfts/' . $artwork->ntf_image) }}" class="h-100 w-100 object-fit-cover" 
                                        alt="{{ $artwork->ntf_name }}"
                                        onerror="this.src='https://via.placeholder.com/100x100?text=NFT'">
                                @endif
                            </div>
                            <div class="flex-grow-1 p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">{{ Str::limit($artwork->ntf_name, 20) }}</h6>
                                        <small class="text-muted">{{ $artwork->ntf_owner }}</small>
                                    </div>
                                    @if($artwork->status == '1')
                                        <span class="badge bg-success p-1 rounded-circle" title="Approved"> </span>
                                    @elseif($artwork->status == '0')
                                        <span class="badge bg-warning p-1 rounded-circle" title="Pending"> </span>
                                    @elseif($artwork->status == '2')
                                        <span class="badge bg-info p-1 rounded-circle" title="Sold"> </span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <span class="h6 text-primary fw-bold">${{ number_format($artwork->nft_price, 2) }}</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.edit.nft', $artwork->id) }}" class="btn btn-sm btn-outline-primary flex-fill">Edit</a>
                                    <a href="{{ route('admin.delete.nft', $artwork->id) }}" class="btn btn-sm btn-outline-danger flex-fill"
                                        onclick="return confirm('Delete this NFT?')">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <p class="text-muted">No artworks found</p>
                    </div>
                    @endforelse
                </div>

                <!-- Footer / Pagination -->
                @if($nfts->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    <div class="d-flex justify-content-center">
                        {{ $nfts->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>

<style>
    .object-fit-cover {
        object-fit: cover !important;
    }
    .badge-subtle {
        font-weight: 500;
        font-size: 0.75rem;
    }
    .bg-success-subtle { background-color: #d1e7dd !important; }
    .text-success { color: #0f5132 !important; }
    .bg-warning-subtle { background-color: #fff3cd !important; }
    .text-warning { color: #664d03 !important; }
    .bg-info-subtle { background-color: #cff4fc !important; }
    .text-info { color: #055160 !important; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    });
</script>

@include('dashboard.footer')
