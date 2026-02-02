@include('dashboard.header')

<main class="content">
    <div class="container-fluid p-0">
        @include('dashboard.alert')

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0"><strong>My Collection</strong></h1>
            <a href="{{ route('upload.nft') }}" class="btn btn-primary shadow-sm">
                <i class="align-middle" data-feather="plus"></i> Add New NFT
            </a>
        </div>

        <div class="row g-4">
            @forelse($my_nft as $nft)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 shadow-sm border-0 nft-card overflow-hidden">
                    <div class="position-relative">
                        <!-- Image Display Logic -->
                        @if(Str::startsWith($nft->ntf_image, ['http', 'https']))
                            <img src="{{ $nft->ntf_image }}" 
                                 class="card-img-top nft-img" 
                                 alt="{{ $nft->ntf_name }}"
                                 onerror="this.src='https://via.placeholder.com/400?text=NFT'">
                        @else
                            <img src="{{ asset('user/uploads/nfts/' . $nft->ntf_image) }}" 
                                 class="card-img-top nft-img" 
                                 alt="{{ $nft->ntf_name }}"
                                 onerror="this.src='https://via.placeholder.com/400?text=NFT'">
                        @endif

                        <!-- Status Badge -->
                        <div class="position-absolute top-0 end-0 m-2">
                            @if($nft->status == '1')
                                <span class="badge bg-success shadow-sm">Approved</span>
                            @elseif($nft->status == '0')
                                <span class="badge bg-warning text-dark shadow-sm">Pending</span>
                            @elseif($nft->status == '2')
                                <span class="badge bg-info shadow-sm">Sold</span>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">{{ $nft->ntf_name }}</h5>
                        <p class="text-muted small mb-3 text-truncate">{{ $nft->ntf_description }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <div>
                                <small class="text-muted d-block">Current Price</small>
                                <span class="h5 fw-bold text-primary mb-0">
                                    {{ \App\Helpers\CurrencyHelper::format($nft->nft_price, 2) }}
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer bg-light border-0 py-3">
                        <div class="row g-2">
                            <div class="col-4">
                                <button class="btn btn-sm btn-outline-secondary w-100" onclick="shareNFT('{{ $nft->id }}')" title="Copy Link">
                                    <i data-feather="share-2" style="width: 14px; height: 14px;"></i>
                                </button>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('update.nft', $nft->id) }}" class="btn btn-sm btn-outline-primary w-100" title="Edit">
                                    <i data-feather="edit-2" style="width: 14px; height: 14px;"></i>
                                </a>
                            </div> 
                            <div class="col-4">
                                <a href="{{ route('delete.nft', $nft->id) }}" 
                                   class="btn btn-sm btn-outline-danger w-100" 
                                   onclick="return confirm('Do you want to delete this NFT?')" 
                                   title="Delete">
                                    <i data-feather="trash-2" style="width: 14px; height: 14px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="card border-0 shadow-sm py-5">
                    <div class="card-body">
                        <i data-feather="image" class="text-muted mb-3" style="width: 64px; height: 64px;"></i>
                        <h4>No NFTs found in your collection</h4>
                        <p class="text-muted">Start by uploading your first digital artwork.</p>
                        <a href="{{ route('upload.nft') }}" class="btn btn-primary mt-3">Upload NFT</a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</main>

<style>
    .nft-card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }
    .nft-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
    .nft-img {
        height: 250px;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    .nft-card:hover .nft-img {
        transform: scale(1.05);
    }
    .badge {
        padding: 0.5em 0.8em;
        font-weight: 600;
        border-radius: 6px;
    }
</style>

<script>
    function shareNFT(nftId) {
        const url = `{{ url('nft-purchase') }}/${nftId}`;
        const tempInput = document.createElement('input');
        tempInput.value = url;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        
        // Show a quick tooltip or toast instead of a clunky alert if possible
        alert('NFT Purchase link copied to clipboard!');
    }
</script>

@include('dashboard.footer')