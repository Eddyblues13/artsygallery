@include('dashboard.header')

<main class="content">
	<div class="container-fluid p-0">
		@if(session('message'))
		<div class="btn btn-success">{{session('message')}}</div>
		@endif

		<div class="mb-3">
			<h1 class="h3 d-inline align-middle">Cards</h1>
			<a class="badge bg-dark text-white ms-2" href="{{route('my.nft')}}">
				My NFTs
			</a>
		</div>
		<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
			@foreach($my_nft as $nft)

			<div class="col col-lg-3 col-md-4 col-6">
				<div class="card">
					<img class="card-img-top" src="{{ asset($nft->ntf_image) }}" alt="{{ $nft->ntf_name }}"
						style="height: 300px; object-fit: cover;">
					<div class="card-header">
						<h5 class="card-title mb-0">{{ $nft->ntf_name }}</h5>
					</div>
					<div class="card-body">
						<p class="card-text">{{ $nft->ntf_description }}</p>
						<p class="card-text"><span class="text-muted">Price:</span> <small class="text-muted">{{
								\App\Helpers\CurrencyHelper::format($nft->nft_price, 2) }}</small>
							<br><span class="fw-bold eth-conversion" style="color: #6f42c1;"
								data-usd="{{ \App\Helpers\CurrencyHelper::convert($nft->nft_price) }}">≈ {{
								\App\Helpers\CurrencyHelper::formatEth($nft->nft_price) }}</span>
						</p>

						<p class="card-text"><strong>Creator:</strong> {{ $nft->ntf_owner }}</p>
						<p class="card-text"><strong>Status:</strong>
							@if($nft->status == '1')
							<button type="button" class="btn btn-success">Approved</button>
							@elseif($nft->status == '0')
							<button type="button" class="btn btn-danger">Unapproved</button>
							@elseif($nft->status == '2')
							<button type="button" class="btn btn-success">Sold</button>
							@endif
						</p>

						<button class="btn btn-secondary" onclick="shareNFT('{{ $nft->id }}')">Share</button>
						<a href="{{ url('update-nft/' . $nft->id) }}" class="btn btn-warning">Edit</a>
						<button class="btn btn-danger" onclick="confirmDelete('{{ $nft->id }}')">Delete</button>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</main>

<script>
	function shareNFT(nftId) {
        const url = `{{ url('nft-purchase') }}/${nftId}`;
        navigator.clipboard.writeText(url).then(() => {
            alert('NFT link copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }

    function confirmDelete(nftId) {
        if (confirm('Are you sure you want to delete this NFT?')) {
            // Assuming you have a delete route set up
            window.location.href = `{{ url('delete-nft') }}/${nftId}`; 
        }
    }
</script>

<script>
	function refreshEthPrices() {
        fetch('{{ route("api.eth.price") }}')
            .then(r => r.json())
            .then(data => {
                if (data.eth_price_usd) {
                    document.querySelectorAll('.eth-conversion').forEach(el => {
                        const usd = parseFloat(el.dataset.usd);
                        if (usd && data.eth_price_usd > 0) {
                            const eth = (usd / data.eth_price_usd).toFixed(6);
                            el.textContent = '≈ ' + eth + ' ETH';
                        }
                    });
                }
            }).catch(() => {});
    }
    setInterval(refreshEthPrices, 60000);
</script>

@include('dashboard.footer')