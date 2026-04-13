@include('dashboard.header')

<style>
	/* ===== Dashboard Redesign ===== */
	.dashboard-welcome {
		font-size: 1.5rem;
		font-weight: 700;
		color: #1a1a2e;
	}

	.dashboard-welcome span {
		color: #6f42c1;
	}

	.dashboard-subtitle {
		color: #6c757d;
		font-size: 0.95rem;
	}

	/* NFT Banner */
	.nft-hero {
		position: relative;
		border-radius: 16px;
		overflow: hidden;
		min-height: 180px;
		background: linear-gradient(135deg, #1a1a2e 0%, #2d1b69 40%, #6f42c1 100%);
	}

	.nft-hero-overlay {
		position: relative;
		z-index: 2;
		padding: 2.5rem 2rem;
		display: flex;
		align-items: center;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 1.5rem;
	}

	.nft-hero-text h2 {
		font-size: 1.75rem;
		font-weight: 800;
		color: #fff;
		margin-bottom: 0.5rem;
	}

	.nft-hero-text p {
		color: rgba(255, 255, 255, 0.75);
		font-size: 1rem;
		margin-bottom: 0;
		max-width: 480px;
	}

	.nft-hero-actions .btn {
		padding: 0.65rem 1.75rem;
		font-weight: 600;
		border-radius: 10px;
		font-size: 0.95rem;
	}

	.nft-hero-actions .btn-light {
		background: #fff;
		color: #6f42c1;
		border: none;
	}

	.nft-hero-actions .btn-light:hover {
		background: #f3f0ff;
		color: #5a32a3;
	}

	.nft-hero-actions .btn-outline-light {
		border-color: rgba(255, 255, 255, 0.5);
		color: #fff;
	}

	.nft-hero-actions .btn-outline-light:hover {
		background: rgba(255, 255, 255, 0.15);
		border-color: #fff;
	}

	.nft-hero-pattern {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-image:
			radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
			radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
			radial-gradient(circle at 60% 60%, rgba(111, 66, 193, 0.3) 0%, transparent 40%);
		z-index: 1;
	}

	/* Stat Cards */
	.stat-card {
		border: none;
		border-radius: 14px;
		box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
		transition: transform 0.2s ease, box-shadow 0.2s ease;
		overflow: hidden;
	}

	.stat-card:hover {
		transform: translateY(-3px);
		box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
	}

	.stat-card .card-body {
		padding: 1.25rem 1.5rem;
	}

	.stat-icon {
		width: 44px;
		height: 44px;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.stat-icon svg,
	.stat-icon i {
		width: 20px;
		height: 20px;
	}

	.stat-card .card-title {
		font-size: 0.8rem;
		font-weight: 600;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		color: #6c757d;
		margin-bottom: 0;
	}

	.stat-card .stat-usd {
		font-size: 0.85rem;
		color: #999;
	}

	.stat-card .stat-eth {
		font-size: 1.25rem;
		font-weight: 700;
		color: #6f42c1;
		line-height: 1.3;
	}

	/* Section headings */
	.section-title {
		font-size: 1.1rem;
		font-weight: 700;
		color: #1a1a2e;
	}

	/* Chart cards */
	.chart-card {
		border: none;
		border-radius: 16px;
		box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
		overflow: hidden;
	}

	/* Mobile */
	@media (max-width: 991.98px) {
		.nft-hero-overlay {
			padding: 2rem 1.5rem;
		}

		.nft-hero-text h2 {
			font-size: 1.4rem;
		}
	}

	@media (max-width: 767.98px) {
		.content {
			padding: 1rem 0.75rem !important;
		}

		.nft-hero-overlay {
			padding: 1.5rem 1.25rem;
			text-align: center;
			justify-content: center;
		}

		.nft-hero-text h2 {
			font-size: 1.25rem;
		}

		.nft-hero-text p {
			font-size: 0.9rem;
		}

		.nft-hero-actions {
			width: 100%;
			display: flex;
			justify-content: center;
			gap: 0.5rem;
		}

		.nft-hero-actions .btn {
			padding: 0.5rem 1.25rem;
			font-size: 0.85rem;
		}

		.stat-card .card-body {
			padding: 1rem;
		}

		.stat-card .stat-eth {
			font-size: 1.1rem;
		}

		.stat-icon {
			width: 38px;
			height: 38px;
		}
	}

	@media (max-width: 575.98px) {
		.stat-card .stat-eth {
			font-size: 1rem;
			word-break: break-all;
		}

		.stat-card .stat-usd {
			font-size: 0.8rem;
		}
	}
</style>

<main class="content">
	<div class="container-fluid p-0">
		@include('dashboard.alert')

		{{-- ===== Welcome + Date ===== --}}
		<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
			<div>
				<h1 class="dashboard-welcome mb-1">Welcome back, <span>{{ Auth::user()->name }}</span></h1>
				<p class="dashboard-subtitle mb-0">Here's what's happening with your portfolio today.</p>
			</div>
			<div class="text-muted" style="font-size: 0.9rem;">
				<i data-feather="calendar" style="width: 16px; height: 16px;"></i>
				{{ now()->format('M d, Y') }}
			</div>
		</div>

		{{-- ===== Create Your NFT Banner (Top) ===== --}}
		<div class="nft-hero mb-4">
			<div class="nft-hero-pattern"></div>
			<div class="nft-hero-overlay">
				<div class="nft-hero-text">
					<h2><i data-feather="hexagon"
							style="width: 28px; height: 28px; margin-right: 8px; vertical-align: -4px;"></i>Create &amp;
						Trade Your NFTs</h2>
					<p>Discover, collect, and sell extraordinary digital art on our marketplace. Start building your
						collection today.</p>
				</div>
				<div class="nft-hero-actions">
					<a href="{{ route('buy.nft') }}" class="btn btn-light me-2">
						<i data-feather="shopping-bag"
							style="width: 16px; height: 16px; margin-right: 6px; vertical-align: -2px;"></i>NFT Market
					</a>
					<a href="{{ route('buy.nft') }}" class="btn btn-outline-light">
						Learn More <i data-feather="arrow-right"
							style="width: 16px; height: 16px; margin-left: 4px; vertical-align: -2px;"></i>
					</a>
				</div>
			</div>
		</div>

		{{-- ===== Portfolio Stats (4 cards in a row) ===== --}}
		<div class="row g-3 mb-4">
			<div class="col-6 col-lg-3">
				<div class="card stat-card h-100">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between mb-3">
							<h5 class="card-title">Balance</h5>
							<div class="stat-icon" style="background: rgba(111,66,193,0.1);"><i data-feather="briefcase"
									style="color: #6f42c1;"></i></div>
						</div>
						<div class="stat-usd mb-1">{{ \App\Helpers\CurrencyHelper::format($balance, 2) }}</div>
						@if(\App\Helpers\CurrencyHelper::formatEth($balance))
						<div class="stat-eth"><b class="eth-conversion"
								data-usd="{{ \App\Helpers\CurrencyHelper::convert($balance) }}">≈ {{
								\App\Helpers\CurrencyHelper::formatEth($balance) }}</b></div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="card stat-card h-100">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between mb-3">
							<h5 class="card-title">Deposits</h5>
							<div class="stat-icon" style="background: rgba(25,135,84,0.1);"><i
									data-feather="arrow-down-circle" style="color: #198754;"></i></div>
						</div>
						<div class="stat-usd mb-1">{{ \App\Helpers\CurrencyHelper::format($deposit, 2) }}</div>
						@if(\App\Helpers\CurrencyHelper::formatEth($deposit))
						<div class="stat-eth"><b class="eth-conversion"
								data-usd="{{ \App\Helpers\CurrencyHelper::convert($deposit) }}">≈ {{
								\App\Helpers\CurrencyHelper::formatEth($deposit) }}</b></div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="card stat-card h-100">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between mb-3">
							<h5 class="card-title">Withdrawals</h5>
							<div class="stat-icon" style="background: rgba(220,53,69,0.1);"><i
									data-feather="arrow-up-circle" style="color: #dc3545;"></i></div>
						</div>
						<div class="stat-usd mb-1">{{ \App\Helpers\CurrencyHelper::format($withdrawal, 2) }}</div>
						@if(\App\Helpers\CurrencyHelper::formatEth($withdrawal))
						<div class="stat-eth"><b class="eth-conversion"
								data-usd="{{ \App\Helpers\CurrencyHelper::convert($withdrawal) }}">≈ {{
								\App\Helpers\CurrencyHelper::formatEth($withdrawal) }}</b></div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3">
				<div class="card stat-card h-100">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between mb-3">
							<h5 class="card-title">Profit</h5>
							<div class="stat-icon" style="background: rgba(13,110,253,0.1);"><i
									data-feather="trending-up" style="color: #0d6efd;"></i></div>
						</div>
						<div class="stat-usd mb-1">{{ \App\Helpers\CurrencyHelper::format($profit, 2) }}</div>
						@if(\App\Helpers\CurrencyHelper::formatEth($profit))
						<div class="stat-eth"><b class="eth-conversion"
								data-usd="{{ \App\Helpers\CurrencyHelper::convert($profit) }}">≈ {{
								\App\Helpers\CurrencyHelper::formatEth($profit) }}</b></div>
						@endif
					</div>
				</div>
			</div>
		</div>

		{{-- ===== ETH Price Charts Section ===== --}}
		<h5 class="section-title mb-3"><i data-feather="activity"
				style="width: 18px; height: 18px; margin-right: 6px; vertical-align: -3px; color: #6f42c1;"></i>Ethereum
			Market</h5>
		<div class="row g-3">
			{{-- Chart 1: ETH Price History --}}
			<div class="col-12 col-lg-7">
				<div class="card chart-card">
					<div class="card-body p-0">
						<div class="p-4 pb-0">
							<div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
								<div>
									<h5 class="fw-bold mb-1" style="color: #333;">ETH Price History</h5>
									<div class="d-flex align-items-center gap-2">
										<span id="ethCurrentPrice" class="h3 fw-bold mb-0"
											style="color: #6f42c1;">Loading...</span>
										<span id="ethPriceChange" class="badge rounded-pill px-3 py-2"
											style="font-size: 0.8rem;">--</span>
									</div>
									<small class="text-muted">Last 24 hours</small>
								</div>
								<div class="d-flex gap-2">
									<button class="btn btn-sm eth-range-btn active" data-days="1"
										style="border-radius: 8px;">24H</button>
									<button class="btn btn-sm eth-range-btn" data-days="7"
										style="border-radius: 8px;">7D</button>
									<button class="btn btn-sm eth-range-btn" data-days="30"
										style="border-radius: 8px;">30D</button>
								</div>
							</div>
						</div>
						<div style="height: 300px; padding: 0 1rem 1rem;">
							<canvas id="ethPriceChart"></canvas>
						</div>
					</div>
				</div>
			</div>

			{{-- Chart 2: ETH Market Stats --}}
			<div class="col-12 col-lg-5">
				<div class="card chart-card">
					<div class="card-body p-4">
						<h5 class="fw-bold mb-3" style="color: #333;">ETH Market Overview</h5>
						<div style="height: 200px; position: relative;">
							<canvas id="ethMarketChart"></canvas>
							<div
								style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
								<img src="https://img.icons8.com/ios-filled/36/764ba2/ethereum.png" alt="ETH"
									style="opacity: 0.7;">
								<div class="fw-bold" style="color: #6f42c1; font-size: 0.85rem;" id="ethDoughnutCenter">
									ETH</div>
							</div>
						</div>
						<div class="mt-3">
							<div class="row g-3">
								<div class="col-6">
									<div class="p-3 rounded-3"
										style="background: linear-gradient(135deg, #f3f0ff 0%, #e8e0ff 100%);">
										<small class="text-muted d-block">24h High</small>
										<span class="fw-bold" style="color: #6f42c1;" id="eth24hHigh">--</span>
									</div>
								</div>
								<div class="col-6">
									<div class="p-3 rounded-3"
										style="background: linear-gradient(135deg, #fff0f0 0%, #ffe0e0 100%);">
										<small class="text-muted d-block">24h Low</small>
										<span class="fw-bold" style="color: #dc3545;" id="eth24hLow">--</span>
									</div>
								</div>
								<div class="col-6">
									<div class="p-3 rounded-3"
										style="background: linear-gradient(135deg, #f0fff4 0%, #e0ffe8 100%);">
										<small class="text-muted d-block">Market Cap</small>
										<span class="fw-bold" style="color: #198754;" id="ethMarketCap">--</span>
									</div>
								</div>
								<div class="col-6">
									<div class="p-3 rounded-3"
										style="background: linear-gradient(135deg, #f0f8ff 0%, #e0f0ff 100%);">
										<small class="text-muted d-block">24h Volume</small>
										<span class="fw-bold" style="color: #0d6efd;" id="eth24hVolume">--</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
</main>

@include('dashboard.footer')
@include('dashboard.alert')


{{-- ===== ETH Live Refresh ===== --}}
<script>
	(function() {
	function refreshEthPrices() {
		fetch("{{ route('api.eth.price') }}")
			.then(r => r.json())
			.then(data => {
				if (!data.eth_price_usd) return;
				document.querySelectorAll('.eth-conversion').forEach(el => {
					const usd = parseFloat(el.dataset.usd);
					if (isNaN(usd) || usd === 0) return;
					const eth = usd / data.eth_price_usd;
					const formatted = eth < 0.000001 ? eth.toExponential(2) : parseFloat(eth.toFixed(6));
					el.textContent = '≈ ' + formatted + ' ETH';
				});
			})
			.catch(() => {});
	}
	setInterval(refreshEthPrices, 60000);
})();
</script>

{{-- ===== Chart.js + ETH Charts ===== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<style>
	.eth-range-btn {
		background: #f0f0f0;
		border: none;
		color: #666;
		font-weight: 600;
		font-size: 0.75rem;
		padding: 0.35rem 0.75rem;
		transition: all 0.2s;
	}

	.eth-range-btn:hover,
	.eth-range-btn.active {
		background: linear-gradient(135deg, #6f42c1 0%, #9b59b6 100%);
		color: #fff;
	}
</style>

<script>
	(function() {
	const priceCtx = document.getElementById('ethPriceChart');
	if (!priceCtx) return;

	let priceChart = new Chart(priceCtx.getContext('2d'), {
		type: 'line',
		data: { labels: [], datasets: [{ label: 'ETH Price (USD)', data: [], fill: true, borderColor: '#6f42c1', backgroundColor: 'rgba(111,66,193,0.08)', borderWidth: 2.5, pointRadius: 0, pointHoverRadius: 5, pointHoverBackgroundColor: '#6f42c1', tension: 0.4 }] },
		options: {
			responsive: true, maintainAspectRatio: false,
			interaction: { mode: 'index', intersect: false },
			plugins: {
				legend: { display: false },
				tooltip: { backgroundColor: '#1a1a2e', titleColor: '#fff', bodyColor: '#fff', padding: 12, cornerRadius: 10, displayColors: false, callbacks: { label: ctx => '$' + ctx.parsed.y.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) } }
			},
			scales: {
				x: { grid: { display: false }, ticks: { maxTicksLimit: 8, color: '#999', font: { size: 11 } } },
				y: { grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false }, ticks: { color: '#999', font: { size: 11 }, callback: v => '$' + v.toLocaleString() } }
			}
		}
	});

	function loadPriceHistory(days) {
		fetch(`https://api.coingecko.com/api/v3/coins/ethereum/market_chart?vs_currency=usd&days=${days}`)
			.then(r => r.json())
			.then(data => {
				if (!data.prices) return;
				const prices = data.prices;
				const labels = prices.map(p => {
					const d = new Date(p[0]);
					return days <= 1 ? d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
						: days <= 7 ? d.toLocaleDateString([], { weekday: 'short', day: 'numeric' })
						: d.toLocaleDateString([], { month: 'short', day: 'numeric' });
				});
				const values = prices.map(p => p[1]);
				priceChart.data.labels = labels;
				priceChart.data.datasets[0].data = values;
				priceChart.update('none');

				const current = values[values.length - 1];
				const first = values[0];
				const change = ((current - first) / first * 100).toFixed(2);
				document.getElementById('ethCurrentPrice').textContent = '$' + current.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
				const changeEl = document.getElementById('ethPriceChange');
				changeEl.textContent = (change >= 0 ? '+' : '') + change + '%';
				changeEl.style.background = change >= 0 ? '#d4edda' : '#f8d7da';
				changeEl.style.color = change >= 0 ? '#155724' : '#721c24';

				const rangeLabels = { 1: 'Last 24 hours', 7: 'Last 7 days', 30: 'Last 30 days' };
				const label = priceCtx.closest('.card').querySelector('small.text-muted');
				if (label) label.textContent = rangeLabels[days] || '';
			})
			.catch(() => { document.getElementById('ethCurrentPrice').textContent = 'Unavailable'; });
	}

	document.querySelectorAll('.eth-range-btn').forEach(btn => {
		btn.addEventListener('click', function() {
			document.querySelectorAll('.eth-range-btn').forEach(b => b.classList.remove('active'));
			this.classList.add('active');
			loadPriceHistory(parseInt(this.dataset.days));
		});
	});
	loadPriceHistory(1);

	const marketCtx = document.getElementById('ethMarketChart');
	if (!marketCtx) return;

	let marketChart = new Chart(marketCtx.getContext('2d'), {
		type: 'doughnut',
		data: { labels: ['Market Cap', '24h Volume', 'Circulating vs Max'], datasets: [{ data: [33, 33, 34], backgroundColor: ['rgba(111,66,193,0.8)', 'rgba(13,110,253,0.8)', 'rgba(25,135,84,0.6)'], borderWidth: 0, hoverOffset: 8 }] },
		options: {
			responsive: true, maintainAspectRatio: false, cutout: '70%',
			plugins: {
				legend: { display: true, position: 'bottom', labels: { padding: 15, usePointStyle: true, pointStyle: 'circle', font: { size: 11 } } },
				tooltip: { backgroundColor: '#1a1a2e', titleColor: '#fff', bodyColor: '#fff', padding: 10, cornerRadius: 8 }
			}
		}
	});

	function formatBigNumber(n) {
		if (n >= 1e12) return '$' + (n / 1e12).toFixed(2) + 'T';
		if (n >= 1e9) return '$' + (n / 1e9).toFixed(2) + 'B';
		if (n >= 1e6) return '$' + (n / 1e6).toFixed(2) + 'M';
		return '$' + n.toLocaleString();
	}

	function loadMarketData() {
		fetch('https://api.coingecko.com/api/v3/coins/ethereum?localization=false&tickers=false&community_data=false&developer_data=false')
			.then(r => r.json())
			.then(data => {
				const md = data.market_data;
				if (!md) return;
				const mcap = md.market_cap?.usd || 0;
				const vol = md.total_volume?.usd || 0;
				const circulating = md.circulating_supply || 0;
				const maxSupply = md.max_supply || circulating * 1.2;
				const total = mcap + vol;
				marketChart.data.datasets[0].data = [((mcap / total) * 100).toFixed(1), ((vol / total) * 100).toFixed(1), ((circulating / maxSupply) * 100).toFixed(1)];
				marketChart.data.labels = [`Market Cap (${formatBigNumber(mcap)})`, `24h Volume (${formatBigNumber(vol)})`, `Supply: ${(circulating / 1e6).toFixed(1)}M ETH`];
				marketChart.update('none');

				document.getElementById('eth24hHigh').textContent = '$' + (md.high_24h?.usd || 0).toLocaleString(undefined, { minimumFractionDigits: 2 });
				document.getElementById('eth24hLow').textContent = '$' + (md.low_24h?.usd || 0).toLocaleString(undefined, { minimumFractionDigits: 2 });
				document.getElementById('ethMarketCap').textContent = formatBigNumber(mcap);
				document.getElementById('eth24hVolume').textContent = formatBigNumber(vol);
			})
			.catch(() => {});
	}

	loadMarketData();
	setInterval(loadMarketData, 120000);
	setInterval(() => loadPriceHistory(parseInt(document.querySelector('.eth-range-btn.active')?.dataset.days || 1)), 120000);
})();
</script>