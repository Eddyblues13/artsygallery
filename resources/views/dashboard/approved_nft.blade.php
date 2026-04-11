@include('dashboard.header')

<style>
	@media (max-width: 575.98px) {
		.nft-card-grid .card-img-top {
			height: 200px !important;
		}

		.nft-card-grid .card-body {
			padding: 0.75rem;
		}

		.nft-card-grid .card-body .btn {
			width: 100%;
			margin-bottom: 0.5rem;
		}

		.nft-card-grid .card-title {
			font-size: 1rem;
		}

		.nft-card-grid .card-text {
			font-size: 0.875rem;
		}
	}
</style>

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
		<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 nft-card-grid">
			@foreach($my_nft as $nft)

			<div class="col">
				<div class="card h-100">
					<img class="card-img-top" src="{{ asset($nft->ntf_image) }}" alt="{{ $nft->ntf_name }}"
						style="height: 250px; object-fit: cover;">
					<div class="card-header">
						<h5 class="card-title mb-0">{{ $nft->ntf_name }}</h5>
					</div>
					<div class="card-body">
						<p class="card-text">{{ $nft->ntf_description }}</p>
						<p class="card-text"><strong>Price:</strong> {{
							\App\Helpers\CurrencyHelper::format($nft->nft_price, 2) }}</p>

						<p class="card-text"><strong>Creator:</strong> {{ $nft->ntf_owner }}</p>
						<p class="card-text"><strong>Status:</strong>
							@if($nft->status == '1')
							<span class="badge bg-success">Approved</span>
							@elseif($nft->status == '0')
							<span class="badge bg-danger">Unapproved</span>
							@elseif($nft->status == '2')
							<span class="badge bg-success">Sold</span>
							@endif
						</p>

						<div class="d-flex flex-wrap gap-2">
							<button class="btn btn-sm btn-secondary" onclick="shareNFT('{{ $nft->id }}')">Share</button>
							<a href="{{ url('update-nft/' . $nft->id) }}" class="btn btn-sm btn-warning">Edit</a>
							<button class="btn btn-sm btn-danger"
								onclick="confirmDelete('{{ $nft->id }}')">Delete</button>
						</div>
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

@include('dashboard.footer')