@include('dashboard.header')

@if(session('success'))
<div class="alert alert-success"
	style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px;">
	{{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger"
	style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px;">
	<ul style="margin: 0; padding-left: 20px;">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif


<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3"><strong>Welcome</strong> {{Auth::user()->name}}</h1>
		<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
			<div class="card flex-fill w-50">
				<!-- Background image -->
				<div class="bg-image" style="
    background-image: url('https://img.freepik.com/free-vector/digital-nft-non-fungible-token-background_1017-41191.jpg?t=st=1719148257~exp=1719151857~hmac=0bf6528b00dd8cbb2561e7d1dda624493774dd2fd63cfa35700c867985bb1ac4&w=826');
    height: 30vh;
  ">
					<div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
						<div class="d-flex justify-content-center align-items-center h-100">
							<h1 class="text-white mb-0 mx-3 my-3">Create Your Own NFT</h1>
						</div>
						<div class="card-body text-center">
							<div class="mb-3">
								<a href="{{route('buy.nft')}}" class="btn btn-primary btn-lg">NFT Market</a>
								<a href="{{route('buy.nft')}}" class="text-white mb-0">Learn More</a>
							</div>
						</div>

					</div>
				</div>
				<!-- Background image -->
			</div>
		</div>
		<div class="row">
			<div class="col-xl-6 col-xxl-5 d-flex">
				<div class="w-100">
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
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
									<h3 class="mt-1 mb-3"><b>${{number_format($balance, 2, '.', ',')}}</b></h3>
									<div class="mb-0">
										<span class="text-danger">{{$balance_eth}} ETH</span>

									</div>
								</div>
							</div>
							<div class="card">
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

									<h3 class="mt-1 mb-3"><b>${{number_format($profit, 2, '.', ',')}}</b></h3>
									<div class="mb-0">
										<span class="text-success">{{ number_format($profit_eth, 2) }} ETH</span>

									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
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
									<h3 class="mt-1 mb-3"><b>${{number_format($deposit, 2, '.', ',')}}</b></h3>

									<div class="mb-0">
										<span class="text-success">{{ number_format($deposit_eth, 2) }} ETH</span>

									</div>
								</div>
							</div>
							<div class="card">
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
									<h3 class="mt-1 mb-3"><b>${{number_format($withdrawal, 2, '.', ',')}}</b></h3>

									<div class="mb-0">
										<span class="text-danger">{{ number_format($withdrawal_eth, 2) }} ETH</span>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-xxl-7">
				<div class="card flex-fill w-100">

					<div class="card-body py-3">
						<div class="chart chart-sm">
							<div class="pt-1 col-12">
								<h3>Personal Trading Chart</h3>
								<div class="tradingview-widget-container" style="margin:30px 0px 10px 0px;">
									<div id="tradingview_ethereum"></div>
									<div class="tradingview-widget-copyright">
										<a href="#" rel="noopener" target="_blank">
											<span class="blue-text"></span>
											<span class="blue-text">Personal trading chart</span>
										</a>
									</div>
									<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
									<script type="text/javascript">
										new TradingView.widget({
											"width": "100%",
											"height": "550",
											"symbol": "COINBASE:ETHUSD",
											"interval": "1",
											"timezone": "Etc/UTC",
											"theme": 'light',
											"style": "9",
											"locale": "en",
											"toolbar_bg": "#f1f3f6",
											"enable_publishing": false,
											"hide_side_toolbar": false,
											"allow_symbol_change": true,
											"calendar": false,
											"studies": [
												"BB@tv-basicstudies"
											],
											"container_id": "tradingview_ethereum"
										});
									</script>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
</main>

<footer class="footer">
	<div class="container-fluid">
		<div class="row text-muted">
			<div class="col-6 text-start">
				<p class="mb-0">
					<a class="text-muted" href="support@artsygalley.com"
						target="_blank"><strong>Artsygalley</strong></a>
					- <a class="text-muted" href="support@artsygalley.com"
						target="_blank"><strong>support@artsygalley.com</strong></a> &copy;
				</p>
			</div>

		</div>
	</div>
</footer>
</div>
</div>

<script src="js/app.js"></script>

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
	async function fetchEthereumPrice() {
        const response = await fetch('https://api.coingecko.com/api/v3/coins/ethereum/market_chart?vs_currency=usd&days=7');
        const data = await response.json();
        return data.prices.map(price => ({ x: new Date(price[0]), y: price[1] }));
    }

    async function createChart() {
        const ctx = document.getElementById('ethPriceChart').getContext('2d');
        const prices = await fetchEthereumPrice();
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Ethereum Price (USD)',
                    data: prices,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Price (USD)'
                        }
                    }
                }
            }
        });
    }

    createChart();
</script>


</body>

</html>