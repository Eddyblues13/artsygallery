@include('dashboard.header')

<style>
	@media (max-width: 767.98px) {
		.content {
			padding: 1rem 0.75rem !important;
		}

		.stat-card .card-body {
			padding: 1rem;
		}

		.stat-card h3 {
			font-size: 1.35rem;
			word-break: break-all;
		}

		.stat-card .card-title {
			font-size: 0.85rem;
		}

		.nft-banner {
			height: 25vh !important;
			min-height: 180px;
		}

		.nft-banner h1 {
			font-size: 1.25rem !important;
		}

		.nft-banner .btn-lg {
			padding: 0.5rem 1.25rem;
			font-size: 0.9rem;
		}

		.nft-banner .card-body {
			padding: 0.5rem !important;
		}
	}

	@media (max-width: 575.98px) {
		.stat-card h3 {
			font-size: 1.15rem;
		}
	}
</style>

<main class="content">
	<div class="container-fluid p-0">
		@include('dashboard.alert')



		<h1 class="h3 mb-3"><strong>Welcome</strong> {{Auth::user()->name}}</h1>

		<div class="row">
			<div class="col-12 col-xl-6 col-xxl-5 d-flex">
				<div class="w-100">
					<div class="row">
						<div class="col-6 col-sm-6">
							<div class="card stat-card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total Balance</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>
									<div class="mt-1 mb-1">
										<small class="text-muted">{{ \App\Helpers\CurrencyHelper::format($balance, 2)
											}}</small>
									</div>
									<div class="mb-0">
										@if(\App\Helpers\CurrencyHelper::formatEth($balance))
										<h3 class="mb-0"><b class="eth-conversion" style="color: #6f42c1;"
												data-usd="{{ \App\Helpers\CurrencyHelper::convert($balance) }}">≈ {{
												\App\Helpers\CurrencyHelper::formatEth($balance) }}</b></h3>
										@endif
									</div>
								</div>
							</div>
							<div class="card stat-card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Profit</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>

									<div class="mt-1 mb-1">
										<small class="text-muted">{{ \App\Helpers\CurrencyHelper::format($profit, 2)
											}}</small>
									</div>
									<div class="mb-0">
										@if(\App\Helpers\CurrencyHelper::formatEth($profit))
										<h3 class="mb-0"><b class="eth-conversion" style="color: #6f42c1;"
												data-usd="{{ \App\Helpers\CurrencyHelper::convert($profit) }}">≈ {{
												\App\Helpers\CurrencyHelper::formatEth($profit) }}</b></h3>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="col-6 col-sm-6">
							<div class="card stat-card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Deposit</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>
									<div class="mt-1 mb-1">
										<small class="text-muted">{{ \App\Helpers\CurrencyHelper::format($deposit, 2)
											}}</small>
									</div>

									<div class="mb-0">
										@if(\App\Helpers\CurrencyHelper::formatEth($deposit))
										<h3 class="mb-0"><b class="eth-conversion" style="color: #6f42c1;"
												data-usd="{{ \App\Helpers\CurrencyHelper::convert($deposit) }}">≈ {{
												\App\Helpers\CurrencyHelper::formatEth($deposit) }}</b></h3>
										@endif
									</div>
								</div>
							</div>
							<div class="card stat-card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Withdrawal</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>
									<div class="mt-1 mb-1">
										<small class="text-muted">{{ \App\Helpers\CurrencyHelper::format($withdrawal, 2)
											}}</small>
									</div>

									<div class="mb-0">
										@if(\App\Helpers\CurrencyHelper::formatEth($withdrawal))
										<h3 class="mb-0"><b class="eth-conversion" style="color: #6f42c1;"
												data-usd="{{ \App\Helpers\CurrencyHelper::convert($withdrawal) }}">≈ {{
												\App\Helpers\CurrencyHelper::formatEth($withdrawal) }}</b></h3>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 col-xl-6 col-xxl-7">
				<div class="card flex-fill w-100">
					<!-- Background image -->
					<div class="bg-image nft-banner" style="
		background-image: url('https://img.freepik.com/free-vector/digital-nft-non-fungible-token-background_1017-41191.jpg?t=st=1719148257~exp=1719151857~hmac=0bf6528b00dd8cbb2561e7d1dda624493774dd2fd63cfa35700c867985bb1ac4&w=826');
		height: 30vh;
		min-height: 220px;
		background-size: cover;
		background-position: center;
	  ">
						<div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
							<div class="d-flex justify-content-center align-items-center h-100">
								<h1 class="text-white mb-0 mx-3 my-3">Create Your Own NFT</h1>
							</div>
							<div class="card-body text-center">
								<div class="mb-3">
									<a href="{{route('buy.nft')}}" class="btn btn-primary btn-lg">NFT Market</a>
									<a href="{{route('buy.nft')}}" class="text-white mb-0 ms-2">Learn More</a>
								</div>
							</div>

						</div>
					</div>
					<!-- Background image -->
				</div>
			</div>
		</div>

		<!-- ETH Price Charts Section -->
		<div class="row mt-4">
			<!-- Chart 1: ETH Price History (7 Days) - Area Chart -->
			<div class="col-12 col-lg-7">
				<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
					<div class="card-body p-0">
						<div class="p-4 pb-0">
							<div class="d-flex justify-content-between align-items-start">
								<div>
									<h5 class="fw-bold mb-1" style="color: #333;">ETH Price History</h5>
									<div class="d-flex align-items-center gap-2">
										<span id="ethCurrentPrice" class="h3 fw-bold mb-0"
											style="color: #6f42c1;">Loading...</span>
										<span id="ethPriceChange" class="badge rounded-pill px-3 py-2"
											style="font-size: 0.8rem;">--</span>
									</div>
									<small class="text-muted">Last 7 days</small>
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

			<!-- Chart 2: ETH Market Stats - Doughnut + Live Stats -->
			<div class="col-12 col-lg-5">
				<div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
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


<script>
	document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Chrome", "Firefox", "IE"],
					datasets: [{
						data: [4306, 3801, 1689],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
</script>

<script>
	// Live ETH price refresh every 60 seconds
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

<!-- Chart.js 4.x CDN -->
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
	// ====== Chart 1: ETH Price History (Area/Line Chart) ======
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
				tooltip: {
					backgroundColor: '#1a1a2e', titleColor: '#fff', bodyColor: '#fff',
					padding: 12, cornerRadius: 10, displayColors: false,
					callbacks: { label: ctx => '$' + ctx.parsed.y.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) }
				}
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

				// Update current price & change
				const current = values[values.length - 1];
				const first = values[0];
				const change = ((current - first) / first * 100).toFixed(2);
				document.getElementById('ethCurrentPrice').textContent = '$' + current.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
				const changeEl = document.getElementById('ethPriceChange');
				changeEl.textContent = (change >= 0 ? '+' : '') + change + '%';
				changeEl.style.background = change >= 0 ? '#d4edda' : '#f8d7da';
				changeEl.style.color = change >= 0 ? '#155724' : '#721c24';

				// Update label
				const rangeLabels = { 1: 'Last 24 hours', 7: 'Last 7 days', 30: 'Last 30 days' };
				const label = priceCtx.closest('.card').querySelector('small.text-muted');
				if (label) label.textContent = rangeLabels[days] || '';
			})
			.catch(() => {
				document.getElementById('ethCurrentPrice').textContent = 'Unavailable';
			});
	}

	// Range buttons
	document.querySelectorAll('.eth-range-btn').forEach(btn => {
		btn.addEventListener('click', function() {
			document.querySelectorAll('.eth-range-btn').forEach(b => b.classList.remove('active'));
			this.classList.add('active');
			loadPriceHistory(parseInt(this.dataset.days));
		});
	});

	loadPriceHistory(1);

	// ====== Chart 2: ETH Market Overview (Doughnut + Stats) ======
	const marketCtx = document.getElementById('ethMarketChart');
	if (!marketCtx) return;

	let marketChart = new Chart(marketCtx.getContext('2d'), {
		type: 'doughnut',
		data: {
			labels: ['Market Cap', '24h Volume', 'Circulating vs Max'],
			datasets: [{
				data: [33, 33, 34],
				backgroundColor: ['rgba(111,66,193,0.8)', 'rgba(13,110,253,0.8)', 'rgba(25,135,84,0.6)'],
				borderWidth: 0,
				hoverOffset: 8
			}]
		},
		options: {
			responsive: true, maintainAspectRatio: false, cutout: '70%',
			plugins: {
				legend: { display: true, position: 'bottom', labels: { padding: 15, usePointStyle: true, pointStyle: 'circle', font: { size: 11 } } },
				tooltip: {
					backgroundColor: '#1a1a2e', titleColor: '#fff', bodyColor: '#fff', padding: 10, cornerRadius: 8
				}
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

				// Update doughnut proportions
				const total = mcap + vol;
				marketChart.data.datasets[0].data = [
					((mcap / total) * 100).toFixed(1),
					((vol / total) * 100).toFixed(1),
					((circulating / maxSupply) * 100).toFixed(1)
				];
				marketChart.data.labels = [
					`Market Cap (${formatBigNumber(mcap)})`,
					`24h Volume (${formatBigNumber(vol)})`,
					`Supply: ${(circulating / 1e6).toFixed(1)}M ETH`
				];
				marketChart.update('none');

				// Fill stat boxes
				document.getElementById('eth24hHigh').textContent = '$' + (md.high_24h?.usd || 0).toLocaleString(undefined, { minimumFractionDigits: 2 });
				document.getElementById('eth24hLow').textContent = '$' + (md.low_24h?.usd || 0).toLocaleString(undefined, { minimumFractionDigits: 2 });
				document.getElementById('ethMarketCap').textContent = formatBigNumber(mcap);
				document.getElementById('eth24hVolume').textContent = formatBigNumber(vol);
			})
			.catch(() => {});
	}

	loadMarketData();

	// Refresh market data every 2 minutes
	setInterval(loadMarketData, 120000);
	setInterval(() => loadPriceHistory(parseInt(document.querySelector('.eth-range-btn.active')?.dataset.days || 1)), 120000);
})();
</script>


</body>

</html>