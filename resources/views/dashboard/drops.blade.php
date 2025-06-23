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
            <h1 class="h3 d-inline align-middle">NFT Drops</h1>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($nftDrops as $index => $drop)
            @php
                $currentDay = \Carbon\Carbon::now()->day;
                $totalDays = \Carbon\Carbon::now()->daysInMonth;
                $progress = ($currentDay / $totalDays) * 100;

                if ($drop->is_positive) {
                    $drop->eth_value += ($drop->eth_value * ($progress / 100));
                } else {
                    $drop->eth_value -= ($drop->eth_value * ($progress / 100));
                }
            @endphp

            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img class="card-img-top" src="{{ asset($drop->image_url) }}"
                        alt="{{ $drop->name }}" style="height: 250px; object-fit: cover;">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-truncate">{{ $drop->name }}</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex flex-wrap gap-3 align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="https://img.icons8.com/ios-filled/24/000000/ethereum.png" alt="Ethereum Icon">
                                <b class="ms-1"> {{ number_format($drop->eth_value, 2) }} ETH Floor</b>
                            </div>
                            <h5 class="{{ $drop->is_positive ? 'text-success' : 'text-danger' }}">
                                {{ $drop->is_positive ? '+' : '-' }}{{ number_format(abs($drop->change), 2) }}%
                            </h5>
                        </div>

                        <!-- Progress Bar -->
                        <div class="progress mt-3" style="height: 10px; border-radius: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                 role="progressbar"
                                 style="width: {{ $progress }}%; background: linear-gradient(45deg, #32cd32, #2e8b57);"
                                 aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                {{ number_format($progress, 2) }}%
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-3 d-flex justify-content-between">
                            <form method="POST" action="{{ route('nft-drops.unstack', $drop->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm w-100">Unstack</button>
                            </form>
                            <form method="POST" action="{{ route('nft-drops.continuation', $drop->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm w-100 ms-2">Continuation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>

@include('dashboard.footer')
