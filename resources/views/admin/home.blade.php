@include('admin.dashboard_header')

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

		<h1 class="h3 mb-3"><strong>Welcome</strong> {{Auth::guard('admin')->user()->name}}</h1>
		<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
			<div class="card flex-fill w-50">
				<!-- Background image -->
				<div class="bg-image" style="
    background-image: url('https://img.freepik.com/free-vector/digital-nft-non-fungible-token-background_1017-41191.jpg?t=st=1719148257~exp=1719151857~hmac=0bf6528b00dd8cbb2561e7d1dda624493774dd2fd63cfa35700c867985bb1ac4&w=826');
    height: 30vh;
  ">
					<div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
						<div class="d-flex justify-content-center align-items-center h-100">
							<h1 class="text-white mb-0 mx-3 my-3">Admin Dashboard</h1>
						</div>
						<div class="card-body text-center">
							<div class="mb-3">
								<a href="{{route('view.users')}}" class="btn btn-primary btn-lg">Manage Users</a>
								<a href="{{route('admin.approve.nft')}}" class="btn btn-secondary btn-lg">Approve Artworks</a>
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
									<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($total_balance, 2) }}</b></h3>
									<div class="mb-0">

									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total Profit</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>

									<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($total_profit, 2) }}</b></h3>
									<div class="mb-0">

									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total Deposits</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>
									<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($total_deposits, 2) }}</b></h3>

									<div class="mb-0">

									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total Withdrawals</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>
									<h3 class="mt-1 mb-3"><b>{{ \App\Helpers\CurrencyHelper::format($total_withdrawals, 2) }}</b></h3>

									<div class="mb-0">

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Additional Admin Stats -->
					<div class="row mt-3">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total Users</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="users"></i>
											</div>
										</div>
									</div>
									<h3 class="mt-1 mb-3"><b>{{$total_users}}</b></h3>
									<div class="mb-0">
										<span class="text-success">{{$active_users}} Active</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Total Artworks</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="image"></i>
											</div>
										</div>
									</div>
									<h3 class="mt-1 mb-3"><b>{{$total_artworks}}</b></h3>
									<div class="mb-0">
										<span class="text-success">{{$approved_artworks}} Approved</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Pending Actions -->
					<div class="row mt-3">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Pending Deposits</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-warning">
												<i class="align-middle" data-feather="clock"></i>
											</div>
										</div>
									</div>
									<h3 class="mt-1 mb-3"><b>{{$pending_deposits}}</b></h3>
									<div class="mb-0">
										<a href="{{route('user.transaction')}}" class="text-warning">Review Now</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Pending Withdrawals</h5>
										</div>
										<div class="col-auto">
											<div class="stat text-warning">
												<i class="align-middle" data-feather="clock"></i>
											</div>
										</div>
									</div>
									<h3 class="mt-1 mb-3"><b>{{$pending_withdrawals}}</b></h3>
									<div class="mb-0">
										<a href="{{route('user.transaction')}}" class="text-warning">Review Now</a>
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
								<h3>Platform Statistics</h3>
								<div class="mt-4">
									<p class="text-muted">General platform usage statistics and trends will appear here.</p>
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
