@include('dashboard.header')

<main class="content">
    <div class="container-fluid p-0">
        @if(session('message'))
        <div class="btn btn-success">{{ session('message') }}</div>
        @endif

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Buy NFT</h1>
            <a class="badge bg-dark text-white ms-2" href="{{ route('my.nft') }}">
                My NFTs
            </a>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach($buy_nft as $nft)
            <div class="col col-lg-3 col-md-4 col-6">
                <div class="card">
                    <img class="card-img-top" src="{{ asset($nft->ntf_image) }}" alt="{{ $nft->ntf_name }}"
                        style="height: 300px; object-fit: cover;">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $nft->ntf_name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-inline-flex gap-3 align-items-center" style="flex-wrap: wrap;">
                            <div class="d-flex align-items-center">
                                <img src="https://img.icons8.com/ios-filled/24/000000/ethereum.png" alt="Ethereum Icon">
                                <b>{{ number_format($nft->nft_eth_price, 2) }}ETH Floor</b>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="https://img.icons8.com/ios-filled/24/000000/us-dollar.png" alt="Dollar Icon">
                                <b>${{ number_format($nft->nft_price, 2) }} Volume</b>
                            </div>
                        </div>
                        <div class="views mt-2">
                            <img src="https://img.icons8.com/ios-filled/24/000000/visible.png" alt="Eye Icon">
                            <span class="viewCount" data-current-views="{{ 100 + ($loop->index * 20) }}"></span> Views
                        </div>
                        <a href="{{ 'purchase_nft/'.$nft->id }}" class="btn btn-primary card-btn-floating">
                            <i class="bi bi-plus-lg m-0">Buy NFT</i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>


@include('dashboard.footer')