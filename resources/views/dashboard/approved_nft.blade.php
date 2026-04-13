@include('dashboard.header')

<style>
	.nft-card {
		border: none;
		border-radius: 16px;
		overflow: hidden;
		transition: all 0.3s ease;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		height: 100%;
		display: flex;
		flex-direction: column;
		background: #fff;
	}

	.nft-card:hover {
		transform: translateY(-6px);
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

	.nft-status-badge {
		position: absolute;
		top: 0.5rem;
		right: 0.5rem;
		padding: 0.35em 0.7em;
		font-size: 0.7rem;
		font-weight: 700;
		border-radius: 6px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.nft-card-header {
		padding: 0.85rem 1rem 0;
		background: #fff;
	}

	.nft-card-title {
		font-size: 1rem;
		font-weight: 700;
		margin: 0;
		color: #333;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.nft-card-desc {
		font-size: 0.8rem;
		color: #999;
		margin: 0.2rem 0 0;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.nft-card-body {
		padding: 0.75rem 1rem 1rem;
		flex-grow: 1;
		display: flex;
		flex-direction: column;
		background: #fff;
	}

	.nft-price-section {
		display: flex;
		flex-direction: column;
		gap: 0.5rem;
		margin-bottom: 0.75rem;
	}

	.price-item {
		display: flex;
		align-items: center;
		gap: 0.5rem;
		padding: 0.45rem 0.6rem;
		background: #f8f9fa;
		border-radius: 8px;
	}

	.price-icon {
		width: 18px;
		height: 18px;
		flex-shrink: 0;
	}

	.price-label {
		font-size: 0.78rem;
		color: #6c757d;
		font-weight: 500;
	}

	.price-value {
		font-size: 0.9rem;
		font-weight: 700;
		color: #333;
		margin-left: auto;
	}

	.nft-creator {
		font-size: 0.8rem;
		color: #888;
		padding: 0.4rem 0;
		border-top: 1px solid #f0f0f0;
		margin-bottom: 0.5rem;
	}

	.nft-actions {
		display: flex;
		gap: 0.4rem;
		margin-top: auto;
	}

	.nft-action-btn {
		flex: 1;
		padding: 0.5rem;
		font-size: 0.78rem;
		font-weight: 600;
		border-radius: 8px;
		border: 1.5px solid;
		text-align: center;
		transition: all 0.2s ease;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 0.3rem;
		text-decoration: none;
		cursor: pointer;
	}

	.nft-action-btn:hover {
		transform: translateY(-1px);
	}

	.btn-share {
		border-color: #6c757d;
		color: #6c757d;
		background: transparent;
	}

	.btn-share:hover {
		background: #6c757d;
		color: #fff;
	}

	.btn-edit {
		border-color: #667eea;
		color: #667eea;
		background: transparent;
	}

	.btn-edit:hover {
		background: #667eea;
		color: #fff;
	}

	.btn-del {
		border-color: #dc3545;
		color: #dc3545;
		background: transparent;
	}

	.btn-del:hover {
		background: #dc3545;
		color: #fff;
	}

	.page-header {
		background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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

	@media (max-width: 576px) {
		.nft-card-header {
			padding: 0.6rem 0.65rem 0;
		}

		.nft-card-title {
			font-size: 0.8rem;
		}

		.nft-card-desc {
			font-size: 0.68rem;
		}

		.nft-card-body {
			padding: 0.55rem 0.65rem 0.65rem;
		}

		.nft-price-section {
			gap: 0.3rem;
			margin-bottom: 0.5rem;
		}

		.price-item {
			padding: 0.3rem 0.4rem;
		}

		.price-label {
			font-size: 0.65rem;
		}

		.price-value {
			font-size: 0.72rem !important;
		}

		.price-icon {
			width: 14px;
			height: 14px;
		}

		.nft-creator {
			font-size: 0.68rem;
			padding: 0.3rem 0;
			margin-bottom: 0.3rem;
		}

		.nft-actions {
			gap: 0.25rem;
		}

		.nft-action-btn {
			padding: 0.35rem;
			font-size: 0.65rem;
			border-radius: 6px;
		}

		.nft-status-badge {
			font-size: 0.55rem;
			padding: 0.25em 0.5em;
			top: 0.35rem;
			right: 0.35rem;
		}

		.page-header {
			padding: 1.25rem;
		}

		.page-header h1 {
			font-size: 1.4rem;
		}
	}
</style>

<main class="content">
	<div class="container-fluid p-0">
		@if(session('message'))
		<div class="alert alert-success">{{session('message')}}</div>
		@endif

		<div class="page-header">
			<div class="d-flex justify-content-between align-items-center">
				<div>
					<h1 class="mb-2">Approved NFTs</h1>
					<p class="mb-0 opacity-75">Your approved digital artworks</p>
				</div>
				<a href="{{route('my.nft')}}" class="btn btn-light">
					<i class="align-middle" data-feather="grid"></i> My NFTs
				</a>
			</div>
		</div>

		<div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 g-sm-4">
			@foreach($my_nft as $nft)
			<div class="col">
				<div class="nft-card">
					<div class="nft-image-wrapper">
						<img class="nft-image" src="{{ asset($nft->ntf_image) }}" alt="{{ $nft->ntf_name }}"
							loading="lazy" onerror="this.src='https://via.placeholder.com/400?text=NFT'">
						@if($nft->status == '1')
						<span class="nft-status-badge bg-success text-white">Approved</span>
						@elseif($nft->status == '0')
						<span class="nft-status-badge bg-danger text-white">Unapproved</span>
						@elseif($nft->status == '2')
						<span class="nft-status-badge bg-info text-white">Sold</span>
						@endif
					</div>

					<div class="nft-card-header">
						<h5 class="nft-card-title">{{ $nft->ntf_name }}</h5>
						<p class="nft-card-desc">{{ $nft->ntf_description }}</p>
					</div>

					<div class="nft-card-body">
						<div class="nft-price-section">
							<div class="price-item">
								<img src="https://img.icons8.com/ios-filled/24/000000/us-dollar.png" alt="USD"
									class="price-icon">
								<span class="price-label">Price</span>
								<span class="price-value"
									style="font-weight: 400; color: #6c757d; font-size: 0.78rem;">{{
									\App\Helpers\CurrencyHelper::format($nft->nft_price, 2) }}</span>
							</div>
							<div class="price-item" style="background: #f3f0ff;">
								<img src="https://img.icons8.com/ios-filled/24/764ba2/ethereum.png" alt="ETH"
									class="price-icon">
								<span class="price-label" style="font-weight: 600;">ETH</span>
								<span class="price-value eth-conversion" style="font-size: 0.95rem; color: #6f42c1;"
									data-usd="{{ \App\Helpers\CurrencyHelper::convert($nft->nft_price) }}">≈ {{
									\App\Helpers\CurrencyHelper::formatEth($nft->nft_price) }}</span>
							</div>
						</div>

						<div class="nft-creator">
							<i class="align-middle" data-feather="user" style="width: 13px; height: 13px;"></i>
							{{ $nft->ntf_owner }}
						</div>

						<div class="nft-actions">
							<button class="nft-action-btn btn-share" onclick="shareNFT('{{ $nft->id }}')">Share</button>
							<a href="{{ url('update-nft/' . $nft->id) }}" class="nft-action-btn btn-edit">Edit</a>
							<button class="nft-action-btn btn-del"
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