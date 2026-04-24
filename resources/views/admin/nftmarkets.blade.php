@include('admin.dashboard_header')

<style>
    .nft-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .nft-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .nft-image-wrapper {
        position: relative;
        width: 100%;
        padding-top: 100%;
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        gap: 0.35rem;
    }

    .buy-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        color: #fff;
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

    @media (max-width: 576px) {
        .nft-card-header {
            padding: 0.65rem 0.75rem;
        }

        .nft-card-title {
            font-size: 0.85rem;
        }

        .nft-card-body {
            padding: 0.75rem;
        }

        .nft-price-section {
            gap: 0.4rem;
            margin-bottom: 0.6rem;
        }

        .price-item {
            padding: 0.35rem 0.5rem;
        }

        .price-label {
            font-size: 0.7rem;
        }

        .price-value {
            font-size: 0.8rem !important;
        }

        .nft-meta {
            padding: 0.5rem 0;
            font-size: 0.75rem;
        }

        .seller-info {
            font-size: 0.75rem;
        }

        .buy-btn {
            padding: 0.5rem;
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .page-header {
            padding: 1.25rem;
        }

        .page-header h1 {
            font-size: 1.4rem;
        }
    }

    /* Smart Live Search Styles */
    #admin-market-results.searching {
        opacity: 0.7;
        pointer-events: none;
    }

    #admin-market-results.searching::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        border: 3px solid rgba(0, 0, 0, 0.1);
        border-top-color: #667eea;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        z-index: 1000;
    }

    @keyframes spin {
        to {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    /* Search input glow */
    form[data-ajax-filter] input[name="search"]:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 0.3rem rgba(102, 126, 234, 0.25) !important;
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
                <a href="{{ route('users.uploaded.nft') }}" class="btn btn-light">
                    <i class="align-middle" data-feather="grid"></i> Uploaded NFTs
                </a>
            </div>
        </div>

        <div id="admin-market-results" data-ajax-container>
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.buy.nft') }}" class="row g-3 align-items-end"
                        data-ajax-filter="#admin-market-results">
                        <div class="col-md-8 col-lg-6">
                            <label for="buyer_user_id" class="form-label">Buy As User Account</label>
                            <select id="buyer_user_id" name="buyer_user_id" class="form-select">
                                <option value="">Auto (use admin account)</option>
                                @foreach(($buyerUsers ?? collect()) as $buyerUser)
                                <option value="{{ $buyerUser->id }}" {{ (string)($selectedBuyerUserId ?? ''
                                    )===(string)$buyerUser->id ? 'selected' : '' }}>
                                    {{ $buyerUser->name }} ({{ $buyerUser->email }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-3 d-grid">
                            <button type="submit" class="btn btn-primary">Apply Buyer</button>
                        </div>
                    </form>
                </div>
            </div>

            @if($buy_nft->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 g-sm-4">
                @foreach($buy_nft as $nft)
                <div class="col">
                    <div class="nft-card">
                        <div class="nft-image-wrapper">
                            <img class="nft-image" src="{{ $nft->ntf_image }}" alt="{{ $nft->ntf_name }}" loading="lazy"
                                onerror="this.src='https://via.placeholder.com/400?text=NFT+Image'">
                        </div>

                        <div class="nft-card-header">
                            <h5 class="nft-card-title">{{ $nft->ntf_name }}</h5>
                        </div>

                        <div class="nft-card-body">
                            <div class="nft-price-section">
                                <div class="price-item">
                                    <img src="https://img.icons8.com/ios-filled/24/000000/us-dollar.png" alt="USD"
                                        class="price-icon">
                                    <span class="price-label">Price</span>
                                    <span class="price-value"
                                        style="font-weight: 400; color: #6c757d; font-size: 0.85rem;">{{
                                        \App\Helpers\CurrencyHelper::format($nft->nft_price, 2)
                                        }}</span>
                                </div>
                                <div class="price-item" style="background: #f3f0ff;">
                                    <img src="https://img.icons8.com/ios-filled/24/764ba2/ethereum.png" alt="ETH"
                                        class="price-icon">
                                    <span class="price-label" style="font-weight: 600;">ETH</span>
                                    <span class="price-value eth-conversion" style="font-size: 1.1rem; color: #6f42c1;"
                                        data-usd="{{ \App\Helpers\CurrencyHelper::convert($nft->nft_price) }}">≈ {{
                                        \App\Helpers\CurrencyHelper::formatEth($nft->nft_price) }}</span>
                                </div>
                            </div>

                            <div class="nft-meta">
                                <div class="seller-info">
                                    <div class="views-count">
                                        <i class="align-middle" data-feather="eye"
                                            style="width: 16px; height: 16px;"></i>
                                        <span>{{ number_format(100 + ($loop->index * 20)) }}</span>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('admin.purchase.nft', ['id' => $nft->id, 'buyer_user_id' => $selectedBuyerUserId]) }}"
                                class="buy-btn"
                                onclick="return confirm('Are you sure you want to purchase {{ $nft->ntf_name }} for {{ \App\Helpers\CurrencyHelper::format($nft->nft_price, 2) }} (≈ {{ \App\Helpers\CurrencyHelper::formatEth($nft->nft_price) }})?')">
                                <i class="align-middle" data-feather="shopping-cart"></i> Buy Now
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    @include('admin.partials.pagination', ['paginator' => $buy_nft, 'label' => 'artworks'])
                </div>
                @else
                <div class="text-center py-5">
                    <i class="align-middle" data-feather="inbox" style="width: 64px; height: 64px; color: #ccc;"></i>
                    <h3 class="mt-3 text-muted">No NFTs Available</h3>
                    <p class="text-muted">Check back later for new listings</p>
                </div>
                @endif
            </div>
        </div>
</main>

<script>
    if (typeof feather !== 'undefined') {
        feather.replace();
    }

    function refreshEthPrices() {
        fetch('{{ route("api.eth.price") }}')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.eth_price_usd) {
                    document.querySelectorAll('.eth-conversion').forEach(function(el) {
                        var usd = parseFloat(el.dataset.usd);
                        if (usd && data.eth_price_usd > 0) {
                            var eth = (usd / data.eth_price_usd).toFixed(6);
                            el.textContent = '≈ ' + eth + ' ETH';
                        }
                    });
                }
            })
            .catch(function() {});
    }

    setInterval(refreshEthPrices, 60000);
</script>

@include('dashboard.footer')