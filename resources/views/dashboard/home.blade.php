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
									<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($balance, 2) }}</b>
									</h3>
									<div class="mb-0">
										@if(\App\Helpers\CurrencyHelper::formatEth($balance))
										<small class="text-muted eth-conversion"
											data-usd="{{ \App\Helpers\CurrencyHelper::convert($balance) }}">≈ {{
											\App\Helpers\CurrencyHelper::formatEth($balance) }}</small>
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

									<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($profit, 2) }}</b>
									</h3>
									<div class="mb-0">
										@if(\App\Helpers\CurrencyHelper::formatEth($profit))
										<small class="text-muted eth-conversion"
											data-usd="{{ \App\Helpers\CurrencyHelper::convert($profit) }}">≈ {{
											\App\Helpers\CurrencyHelper::formatEth($profit) }}</small>
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
									<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($deposit, 2) }}</b>
									</h3>

									<div class="mb-0">
										@if(\App\Helpers\CurrencyHelper::formatEth($deposit))
										<small class="text-muted eth-conversion"
											data-usd="{{ \App\Helpers\CurrencyHelper::convert($deposit) }}">≈ {{
											\App\Helpers\CurrencyHelper::formatEth($deposit) }}</small>
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
									<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($withdrawal, 2)
											}}</b></h3>

									<div class="mb-0">
										@if(\App\Helpers\CurrencyHelper::formatEth($withdrawal))
										<small class="text-muted eth-conversion"
											data-usd="{{ \App\Helpers\CurrencyHelper::convert($withdrawal) }}">≈ {{
											\App\Helpers\CurrencyHelper::formatEth($withdrawal) }}</small>
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




</body>

</html>