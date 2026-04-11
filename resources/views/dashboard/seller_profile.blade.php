@include('dashboard.header')

<style>
    .seller-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 2.5rem;
        color: #fff;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .seller-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .seller-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
    }

    .seller-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.9);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        object-fit: cover;
        background: #e9ecef;
    }

    .seller-avatar-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.9);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
    }

    .verified-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 0.3rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #fff;
    }

    .seller-stats {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        text-align: center;
        min-width: 120px;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        display: block;
    }

    .stat-label {
        font-size: 0.8rem;
        opacity: 0.85;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .seller-info-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .seller-info-row i,
    .seller-info-row svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title .count-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        font-size: 0.85rem;
        padding: 0.2rem 0.65rem;
        border-radius: 20px;
        font-weight: 600;
    }

    .nft-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
    }

    .nft-item {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        background: #fff;
    }

    .nft-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }

    .nft-item-image {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .nft-item:hover .nft-item-image {
        transform: scale(1.05);
    }

    .nft-item-body {
        padding: 1rem;
    }

    .nft-item-title {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0.5rem;
    }

    .nft-item-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #667eea;
    }

    .nft-item-footer {
        padding: 0.75rem 1rem;
        border-top: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .view-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.4rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        border-radius: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .view-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #adb5bd;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .back-nav {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .back-nav .btn {
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .seller-hero {
            padding: 1.5rem;
        }

        .seller-avatar,
        .seller-avatar-placeholder {
            width: 90px;
            height: 90px;
            font-size: 2rem;
        }

        .seller-stats {
            gap: 0.75rem;
        }

        .stat-card {
            min-width: 90px;
            padding: 0.75rem 1rem;
        }

        .stat-value {
            font-size: 1.25rem;
        }

        .nft-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
        }
    }
</style>

<main class="content">
    <div class="container-fluid p-0">

        <div class="back-nav">
            <a href="{{ route('buy.nft') }}" class="btn btn-outline-primary">
                <i class="align-middle" data-feather="arrow-left"></i> Back to Marketplace
            </a>
        </div>

        <!-- Seller Hero Section -->
        <div class="seller-hero">
            <div class="d-flex flex-column flex-md-row align-items-center gap-4">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    @if($seller->profile_picture)
                    <img src="{{ $seller->profile_picture }}" alt="{{ $seller->name }}" class="seller-avatar">
                    @else
                    <div class="seller-avatar-placeholder">
                        {{ strtoupper(substr($seller->name, 0, 1)) }}
                    </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <h2 class="mb-0 fw-bold" style="font-size: 1.75rem;">{{ $seller->name }}</h2>
                        @if($seller->id_card_status === '1')
                        <span class="verified-badge">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Verified
                        </span>
                        @endif
                    </div>

                    @if($seller->country)
                    <div class="seller-info-row">
                        <i class="align-middle" data-feather="map-pin"></i>
                        <span>{{ $seller->country }}</span>
                    </div>
                    @endif

                    <div class="seller-info-row">
                        <i class="align-middle" data-feather="calendar"></i>
                        <span>Member since {{ $memberSince }}</span>
                    </div>

                    <!-- Stats -->
                    <div class="seller-stats">
                        <div class="stat-card">
                            <span class="stat-value">{{ $totalNfts }}</span>
                            <span class="stat-label">Artworks</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-value">{{ $soldNfts }}</span>
                            <span class="stat-label">Sold</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Artworks Section -->
        <div class="section-title">
            <i class="align-middle" data-feather="grid"></i>
            Artworks by {{ $seller->name }}
            <span class="count-badge">{{ $totalNfts }}</span>
        </div>

        @if($nfts->count() > 0)
        <div class="nft-grid">
            @foreach($nfts as $nft)
            <div class="nft-item">
                <div style="overflow: hidden;">
                    @if(Str::startsWith($nft->ntf_image, 'http'))
                    <img class="nft-item-image" src="{{ $nft->ntf_image }}" alt="{{ $nft->ntf_name }}" loading="lazy"
                        onerror="this.src='https://via.placeholder.com/400?text=NFT+Image'">
                    @else
                    <img class="nft-item-image" src="{{ asset($nft->ntf_image) }}" alt="{{ $nft->ntf_name }}"
                        loading="lazy" onerror="this.src='https://via.placeholder.com/400?text=NFT+Image'">
                    @endif
                </div>
                <div class="nft-item-body">
                    <div class="nft-item-title">{{ $nft->ntf_name }}</div>
                    <div class="nft-item-price">{{ \App\Helpers\CurrencyHelper::format($nft->nft_price, 2) }}</div>
                </div>
                <div class="nft-item-footer">
                    <span class="text-muted" style="font-size: 0.8rem;">{{ $nft->ntf_owner }}</span>
                    @if(Auth::check() && $nft->user_id != Auth::id())
                    <a href="{{ route('purchase.nft', $nft->id) }}" class="view-btn">
                        <i class="align-middle" data-feather="shopping-cart" style="width: 14px; height: 14px;"></i>
                        Buy
                    </a>
                    @else
                    <a href="{{ route('purchase.nft', $nft->id) }}" class="view-btn" style="background: #6c757d;">
                        <i class="align-middle" data-feather="eye" style="width: 14px; height: 14px;"></i>
                        View
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h4>No Artworks Yet</h4>
            <p>This seller hasn't listed any artworks for sale.</p>
        </div>
        @endif

    </div>
</main>

@include('dashboard.footer')

<script>
    feather.replace();
</script>