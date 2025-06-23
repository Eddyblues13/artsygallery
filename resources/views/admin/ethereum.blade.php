@include('admin.header')
@include('admin.navbar')

				<!-- Content wrapper scroll start -->
				<div class="content-wrapper-scroll">
        @if (session('error'))
                              <div class="alert box-bdr-red alert-dismissible fade show text-red" role="alert">
															<b>Error!</b>{{ session('error') }}
											<button type="button" class="btn-close" data-bs-dismiss="alert"
																aria-label="Close"></button>
									</div>
                                    @elseif (session('status'))
									<div class="alert box-bdr-green alert-dismissible fade show text-green" role="alert">
															<b>Success!</b> {{ session('status') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
                                  @endif
					<!-- Main header starts -->
					
							</div>
							<!-- Row end -->

							<!-- Row start -->
							<div class="row justify-content-center">
								<div class="col-xxl-10">
									<div class="card mb-5">
										<div class="card-body p-5">
											<h4 class="text-center">
												UPDATE ETHEREUM WALLET ADDRESS
											</h4>

											<!-- Row start -->
											<div class="row justify-content-center">
												<div class="col-sm-6 col-12">
													<div class="mb-3 mt-5">
													  <form method="post" action="{{route('admin.save.wallet')}}" enctype="multipart/form-data">
                                     @csrf
														<label class="form-label">Ethereum Wallet Address</label>
										<input type="text" name="wallet_address" class="form-control" value="{{Auth::user()->wallet_address}}" placeholder="New Wallet Address" />
													</div>
													<div class="input-group mb-5">
											<label class="input-group-text" for="inputGroupFile01">Upload Bar Code</label>
											<input type="file" name="image" class="form-control" id="inputGroupFile01" />
											<br>
											<br>
											     <img src="{{asset('admin/uploads/admin/'.Auth::user()->bar_code)}}" width="60px" height="60px"/>
                        @error('image')<small class="text-danger">{{$message}}</smal> @enderror
                        </div>
										</div>

													<div class="mb-3">
														<div class="d-flex gap-2 justify-content-end">
															
															<button type="submit" class="btn btn-success">
																Update
															</button>
															  </form>
														</div>
													</div>
												</div>
											</div>
											<!-- Row end -->
										</div>
									</div>
								</div>
							</div>
							<!-- Row end -->
						</div>
					</div>
					<!-- Content wrapper end -->

				</div>
				<!-- Content wrapper scroll end -->

				@include('admin.footer')