@include('admin.header')
@include('admin.navbar')
<div class="main-content">

	<div class="page-content">
		<div class="container-fluid">
			@if(session('message'))
			<div class="btn btn-success">{{session('message')}}</div>
			@endif

			<!-- Row start -->
			<div class="row gx-3">
				@foreach($my_nft as $my_nft)
				<div class="col-sm-4 col-12 ">
					<div class="card">
						<div class="card-header mb-3">
							<h4 class="card-title">{{$my_nft->ntf_name}}</h4>

						</div>
						<img src="{{asset('user/uploads/nfts/'.$my_nft->ntf_image)}}" class="img-fluid"
							alt="Bootstrap Gallery" />
						<div class="card-body position-relative pt-4">
							<a href="#" class="btn btn-success card-btn-floating">
								<i class="bi bi-plus-lg m-0"></i>
							</a>
							<p class="card-text">
								{{$my_nft->ntf_description}}
							</p>
						</div>

						<div class="d-inline-flex gap-3">
							<b>{{ number_format($my_nft->nft_eth_price, 2)}}ETH Floor</b>
							<b>{{ number_format($my_nft->nft_eth_price, 2) }}ETH Volume</b>
						</div>
						<div class="card-footer">
							<div class="d-inline-flex gap-3">

								<button type="button" class="badge shade-green" data-bs-toggle="modal"
									data-bs-target="#exampleModalCenter3">
									update
								</button>
								<!-- Modal -->
								<div class="modal fade" id="exampleModalCenter3" tabindex="-1"
									aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">
													Update NFT
												</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal"
													aria-label="Close"></button>
											</div>
											<form action="{{url('update-nft/'.$my_nft->id)}}" method="POST">
												@csrf
												<div class="modal-body">
													<label class="form-label">NFT Name</label>
													<input type="number" name="nft_price" class="form-control"
														style="color:blue" placeholder="  {{$my_nft->ntf_name}}" />
													<label class="form-label">NFT price</label>
													<input type="number" name="nft_price" class="form-control"
														style="color:blue" placeholder="  {{$my_nft->nft_price}}" />

													<label class="form-label">NFT Description</label>

													<input type="text" name="amount" class="form-control"
														style="color:blue"
														placeholder="  {{$my_nft->ntf_description}}" />
													<div class="modal-footer">

														<button type="submit" class="btn btn-success">
															Update Nft
														</button>
													</div>
											</form>
										</div>
									</div>
								</div>


							</div>
							<a href="{{url('delete-nft/'.$my_nft->id)}}" class="badge shade-red">delete</a>
						</div>
					</div>

				</div>
			</div>
			@endforeach
		</div>
		<!-- Row end -->

	</div>
	<!-- Content wrapper end -->

</div>
<!-- Content wrapper scroll end -->

@include('admin.footer')