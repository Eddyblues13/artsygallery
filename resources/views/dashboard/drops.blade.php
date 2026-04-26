@include('dashboard.header')

<main class="content">
    <div class="container-fluid p-0">

        @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
                <polyline points="22 4 12 14.01 9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            {{ session('message') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="drops-page-header mb-4">
            <div>
                <h1 class="drops-page-title">My Notable Drops</h1>
                <p class="drops-page-sub">Your assigned drops — unstake to claim your accumulated royalties.</p>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse($nftDrops as $drop)
            @php
            $currentDay = \Carbon\Carbon::now()->day;
            $totalDays = \Carbon\Carbon::now()->daysInMonth;
            $progress = ($currentDay / $totalDays) * 100;
            $displayEthValue = $drop->is_positive
            ? $drop->eth_value + ($drop->eth_value * ($progress / 100))
            : max(0, $drop->eth_value - ($drop->eth_value * ($progress / 100)));
            @endphp

            <div class="col">
                <div class="drop-card">
                    {{-- Image --}}
                    <div class="drop-card-img-wrap">
                        <img src="{{ Illuminate\Support\Str::startsWith($drop->image_url, ['http','https']) ? $drop->image_url : asset($drop->image_url) }}"
                            alt="{{ $drop->name }}" class="drop-card-img">
                        <span class="drop-badge {{ $drop->is_positive ? 'drop-badge--pos' : 'drop-badge--neg' }}">
                            {{ $drop->is_positive ? '+' : '-' }}{{ number_format(abs($drop->change), 2) }}%
                        </span>
                    </div>

                    {{-- Body --}}
                    <div class="drop-card-body">
                        <h6 class="drop-name">{{ $drop->name }}</h6>

                        <div class="drop-eth-row">
                            <span class="drop-eth-icon">
                                <svg width="14" height="22" viewBox="0 0 14 22" fill="none">
                                    <path
                                        d="M6.99984 0L6.84375 0.536719V15.0422L6.99984 15.1979L13.9997 11.1105L6.99984 0Z"
                                        fill="#6366f1" />
                                    <path d="M6.99984 0L0 11.1105L6.99984 15.1979V8.12977V0Z" fill="#8b5cf6" />
                                    <path
                                        d="M6.99984 16.4762L6.91406 16.58V21.8664L6.99984 22.0001L14.0038 12.3906L6.99984 16.4762Z"
                                        fill="#6366f1" />
                                    <path d="M6.99984 22.0001V16.4762L0 12.3906L6.99984 22.0001Z" fill="#8b5cf6" />
                                    <path d="M6.99984 15.1979L13.9997 11.1105L6.99984 8.12977V15.1979Z"
                                        fill="#4f46e5" />
                                    <path d="M0 11.1105L6.99984 15.1979V8.12977L0 11.1105Z" fill="#7c3aed" />
                                </svg>
                            </span>
                            <div>
                                <div class="drop-eth-value">{{ number_format($displayEthValue, 4) }} ETH</div>
                                <div class="drop-eth-label">Accumulated royalty</div>
                            </div>
                        </div>

                        <div class="drop-progress-block">
                            <div class="drop-progress-header">
                                <span>Accumulation</span>
                                <span class="drop-progress-pct">{{ number_format($progress, 1) }}%</span>
                            </div>
                            <div class="drop-progress-track">
                                <div class="drop-progress-fill {{ $drop->is_positive ? 'fill-pos' : 'fill-neg' }}"
                                    style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('nft-drops.unstack', $drop->id) }}"
                            onsubmit="return confirm('Unstake \u201c{{ addslashes($drop->name) }}\u201d and claim {{ number_format($displayEthValue, 4) }} ETH as royalty earnings?')">
                            @csrf
                            <button type="submit" class="btn-unstake">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Unstake &amp; Claim
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="drops-empty">
                    <div class="drops-empty-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h5>No drops assigned yet</h5>
                    <p>Your account has no notable drops assigned. Check back soon.</p>
                </div>
            </div>
            @endforelse
        </div>

        @if($nftDrops->hasPages())
        <div class="mt-4">
            @include('dashboard.partials.pagination', ['paginator' => $nftDrops, 'label' => 'drops'])
        </div>
        @endif
    </div>
</main>

@push('styles')
<style>
    .drops-page-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1a1a2e;
        margin: 0;
    }

    .drops-page-sub {
        font-size: 13.5px;
        color: #6b7280;
        margin: 4px 0 0;
    }

    /* Card */
    .drop-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 2px 18px rgba(0, 0, 0, 0.07);
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform .25s ease, box-shadow .25s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .drop-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 36px rgba(99, 102, 241, 0.14);
    }

    /* Image */
    .drop-card-img-wrap {
        position: relative;
        overflow: hidden;
    }

    .drop-card-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        transition: transform .35s ease;
    }

    .drop-card:hover .drop-card-img {
        transform: scale(1.07);
    }

    /* Badge */
    .drop-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: .3px;
        backdrop-filter: blur(6px);
    }

    .drop-badge--pos {
        background: rgba(34, 197, 94, .18);
        color: #15803d;
        border: 1px solid rgba(34, 197, 94, .35);
    }

    .drop-badge--neg {
        background: rgba(239, 68, 68, .13);
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, .28);
    }

    /* Body */
    .drop-card-body {
        padding: 16px 18px 18px;
        display: flex;
        flex-direction: column;
        gap: 13px;
        flex: 1;
    }

    .drop-name {
        font-size: 14.5px;
        font-weight: 700;
        color: #111827;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ETH row */
    .drop-eth-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .drop-eth-icon {
        flex-shrink: 0;
    }

    .drop-eth-value {
        font-size: 17px;
        font-weight: 800;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.1;
    }

    .drop-eth-label {
        font-size: 10.5px;
        color: #9ca3af;
        font-weight: 500;
        margin-top: 2px;
    }

    /* Progress */
    .drop-progress-block {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .drop-progress-header {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: #6b7280;
        font-weight: 500;
    }

    .drop-progress-pct {
        font-weight: 700;
        color: #374151;
    }

    .drop-progress-track {
        height: 7px;
        background: #f3f4f6;
        border-radius: 99px;
        overflow: hidden;
    }

    .drop-progress-fill {
        height: 100%;
        border-radius: 99px;
        transition: width .8s ease;
    }

    .fill-pos {
        background: linear-gradient(90deg, #34d399, #10b981);
    }

    .fill-neg {
        background: linear-gradient(90deg, #f87171, #ef4444);
    }

    /* Unstake button */
    .btn-unstake {
        width: 100%;
        padding: 11px 16px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .3px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: opacity .2s, transform .15s;
        box-shadow: 0 4px 14px rgba(99, 102, 241, .35);
        margin-top: auto;
    }

    .btn-unstake:hover {
        opacity: .88;
        transform: translateY(-1px);
    }

    .btn-unstake:active {
        transform: translateY(0);
    }

    /* Empty state */
    .drops-empty {
        text-align: center;
        padding: 72px 24px;
    }

    .drops-empty-icon {
        width: 80px;
        height: 80px;
        background: #f3f4f6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        color: #9ca3af;
    }

    .drops-empty h5 {
        color: #374151;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .drops-empty p {
        font-size: 13.5px;
        color: #6b7280;
        max-width: 300px;
        margin: 0 auto;
    }
</style>
@endpush

@include('dashboard.footer')