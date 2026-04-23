@include('dashboard.header')

<main class="content">
    <div class="container-fluid p-0">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Success message --}}
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Notable Drops</h1>
            <p class="text-muted mb-0">Admin-curated notable drops available for users to browse and buy.</p>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse($nftDrops as $index => $drop)
            @php
            $currentDay = \Carbon\Carbon::now()->day;
            $totalDays = \Carbon\Carbon::now()->daysInMonth;
            $progress = ($currentDay / $totalDays) * 100;

            if ($drop->is_positive) {
            $displayEthValue = $drop->eth_value + ($drop->eth_value * ($progress / 100));
            } else {
            $displayEthValue = $drop->eth_value - ($drop->eth_value * ($progress / 100));
            }
            @endphp

            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img class="card-img-top"
                        src="{{ Illuminate\Support\Str::startsWith($drop->image_url, ['http', 'https']) ? $drop->image_url : asset($drop->image_url) }}"
                        alt="{{ $drop->name }}" style="height: 250px; object-fit: cover;">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-truncate">{{ $drop->name }}</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex flex-wrap gap-3 align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="https://img.icons8.com/ios-filled/24/000000/ethereum.png" alt="Ethereum Icon">
                                <b class="ms-1"> {{ number_format($displayEthValue, 2) }} ETH Floor</b>
                            </div>
                            <h5 class="{{ $drop->is_positive ? 'text-success' : 'text-danger' }}">
                                {{ $drop->is_positive ? '+' : '-' }}{{ number_format(abs($drop->change), 2) }}%
                            </h5>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress mt-3" style="height: 10px; border-radius: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: {{ $progress }}%; background: linear-gradient(45deg, #32cd32, #2e8b57);"
                                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                {{ number_format($progress, 2) }}%
                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-between">
                            <form method="POST" action="{{ route('nft-drops.continuation', $drop->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm w-100">Buy Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-light border text-center py-5">No notable drops are available right now.</div>
            </div>
            @endforelse
        </div>

        <div class="mt-4">
            @include('dashboard.partials.pagination', ['paginator' => $nftDrops, 'label' => 'drops'])
        </div>
    </div>
</main>

@include('dashboard.footer')