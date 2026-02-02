@include('dashboard.header')

<style>
    .nft-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .nft-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    .nft-image-wrapper {
        position: relative;
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        overflow: hidden;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .nft-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .nft-card:hover .nft-image {
        transform: scale(1.05);
    }

    .nft-card-header {
        padding: 1rem;
        background: #fff;
        border-bottom: 1px solid #f0f0f0;
    }

    .nft-card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .nft-card-body {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        background: #fff;
    }

    .nft-price-section {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .price-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .price-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    .price-label {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 500;
    }

    .price-value {
        font-size: 1rem;
        font-weight: 700;
        color: #333;
        margin-left: auto;
    }

    .nft-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-top: 1px solid #f0f0f0;
        margin-top: auto;
    }

    .seller-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6c757d;
    }

    .country-flag {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        object-fit: cover;
    }

    .views-count {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.875rem;
        color: #6c757d;
    }

    .buy-btn {
        width: 100%;
        padding: 0.75rem;
        font-weight: 600;
        border-radius: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff;
        transition: all 0.3s ease;
        margin-top: 0.75rem;
    }

    .buy-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .loading-skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s ease-in-out infinite;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
    }

    .page-header h1 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
    }

    .pagination-wrapper {
        margin-top: 2.5rem;
        margin-bottom: 2rem;
        padding: 0 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .pagination-wrapper nav {
        width: 100%;
        max-width: 100%;
    }

    .pagination-wrapper .pagination {
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.35rem;
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
        align-items: center;
    }

    .pagination-wrapper .page-item {
        margin: 0;
    }

    .pagination-wrapper .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        min-height: 2.5rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.9375rem;
        font-weight: 500;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        background: #fff;
        color: #495057;
        text-decoration: none;
        transition: background 0.2s, border-color 0.2s, color 0.2s;
    }

    .pagination-wrapper .page-link:hover:not(.disabled) {
        background: #f8f9fa;
        border-color: #667eea;
        color: #667eea;
    }

    .pagination-wrapper .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        color: #fff;
    }

    .pagination-wrapper .page-item.disabled .page-link {
        background: #f8f9fa;
        color: #adb5bd;
        cursor: not-allowed;
        pointer-events: none;
    }

    @media (max-width: 576px) {
        .pagination-wrapper {
            margin-top: 2rem;
            padding: 0 0.5rem;
        }

        .pagination-wrapper .pagination {
            gap: 0.25rem;
        }

        .pagination-wrapper .page-link {
            min-width: 2.25rem;
            min-height: 2.25rem;
            padding: 0.4rem 0.5rem;
            font-size: 0.875rem;
        }
    }
</style>

<main class="content">
    <div class="container-fluid p-0">
        @include('dashboard.alert')

        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">NFT Marketplace</h1>
                    <p class="mb-0 opacity-75">Discover and collect unique digital artworks</p>
                </div>
                <a href="{{ route('my.nft') }}" class="btn btn-light">
                    <i class="align-middle" data-feather="grid"></i> My NFTs
                </a>
            </div>
        </div>

        @if($buy_nft->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($buy_nft as $nft)
            <div class="col">
                <div class="nft-card">
                    <div class="nft-image-wrapper">
                        <img 
                            class="nft-image" 
                            src="{{ $nft->ntf_image }}" 
                            alt="{{ $nft->ntf_name }}"
                            loading="lazy"
                            onerror="this.src='https://via.placeholder.com/400?text=NFT+Image'">
                    </div>
                    
                    <div class="nft-card-header">
                        <h5 class="nft-card-title">{{ $nft->ntf_name }}</h5>
                    </div>
                    
                    <div class="nft-card-body">
                        <div class="nft-price-section">
                            <div class="price-item">
                                <img src="https://img.icons8.com/ios-filled/24/000000/ethereum.png" alt="ETH" class="price-icon">
                                <span class="price-label">ETH</span>
                                <span class="price-value">{{ number_format($nft->nft_eth_price, 4) }}</span>
                            </div>
                            <div class="price-item">
                                <img src="https://img.icons8.com/ios-filled/24/000000/us-dollar.png" alt="USD" class="price-icon">
                                <span class="price-label">Price</span>
                                <span class="price-value">{{ \App\Helpers\CurrencyHelper::format($nft->nft_price, 2) }}</span>
                            </div>
                        </div>

                        <div class="nft-meta">
                            <div class="seller-info">
                                <i class="align-middle" data-feather="user" style="width: 16px; height: 16px;"></i>
                                <span>{{ $nft->user->name ?? $nft->ntf_owner ?? 'Unknown' }}</span>
                                @if($nft->user && $nft->user->country)
                                <span class="badge bg-secondary ms-2">{{ $nft->user->country }}</span>
                                @endif
                            </div>
                            <div class="views-count">
                                <i class="align-middle" data-feather="eye" style="width: 16px; height: 16px;"></i>
                                <span>{{ number_format(100 + ($loop->index * 20)) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('purchase.nft', $nft->id) }}" 
                           class="buy-btn"
                           onclick="return confirm('Are you sure you want to purchase {{ $nft->ntf_name }} for {{ \App\Helpers\CurrencyHelper::format($nft->nft_price, 2) }}?')">
                            <i class="align-middle" data-feather="shopping-cart"></i> Buy Now
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $buy_nft->links('pagination::bootstrap-4') }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="align-middle" data-feather="inbox" style="width: 64px; height: 64px; color: #ccc;"></i>
            <h3 class="mt-3 text-muted">No NFTs Available</h3>
            <p class="text-muted">Check back later for new listings</p>
        </div>
        @endif
    </div>
</main>

@include('dashboard.footer')

<script>
    feather.replace();
</script>
