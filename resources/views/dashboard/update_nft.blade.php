@include('dashboard.header')

<main class="content">
    <div class="container-fluid p-0">
        @if(session('message'))
        <div class="text-primary">{{ session('message') }}</div>
        @endif

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Edit NFT</h1>
            <a class="badge bg-dark text-white ms-2" href="{{ route('my.nft') }}">
                Back to My NFTs
            </a>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $nft->ntf_name }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('nft/update/' . $nft->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="ntf_name" class="form-label">NFT Name</label>
                                <input type="text" class="form-control" id="ntf_name" name="ntf_name"
                                    value="{{ $nft->ntf_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="ntf_description" class="form-label">NFT Description</label>
                                <textarea class="form-control" id="ntf_description" name="ntf_description" rows="3"
                                    required>{{ $nft->ntf_description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="ntf_price_usd" class="form-label">Price ({{ $activeCurrency->currency_code ?? 'USD' }})</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ $activeCurrency->currency_symbol ?? '$' }}</span>
                                    <input type="number" class="form-control" id="ntf_price_usd" name="ntf_price_usd"
                                        value="{{ $nft->nft_price}}" step="0.01" min="0" required>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="ntf_image" class="form-label">NFT Image</label>
                                <input type="file" class="form-control" id="ntf_image" name="image">
                                <img src="{{ asset('user/uploads/nfts/' . $nft->ntf_image) }}"
                                    alt="{{ $nft->ntf_name }}" class="img-thumbnail mt-2"
                                    style="height: 150px; object-fit: cover;">
                            </div>
                            <button type="submit" class="btn btn-primary">Update NFT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('dashboard.footer')