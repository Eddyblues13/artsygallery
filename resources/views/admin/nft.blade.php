@include('admin.header')
@include('admin.navbar')
				<!-- Content wrapper scroll start -->
				<div class="content-wrapper-scroll">

					<!-- Main header starts -->
					
							</div>
							<!-- Row end -->

							<!-- Row start -->
							<div class="row justify-content-center">
								<div class="col-xxl-10">
									<div class="card mb-5">
										<div class="card-body p-5">
											<h4 class="text-center">
												UPLOAD NFTs
											</h4>

											<!-- Row start -->
											<div class="row justify-content-center">
								<form id="password_change" action ="{{ route('admin.save.nft')}}" method="POST" enctype='multipart/form-data'>
                                           @csrf
                                                                                                       <div class="col-sm-6 col-12">
                         <div class="mb-3 mt-5">
                                <input type="text" class="form-control" name="nft_name">
                                <label for="form-label">NFT NAME</label>
                            </div>
                                  <div class="mb-3 mt-5">
                                <input type="text" class="form-control" name="nft_owner">
                                <label for="form-label">NFT Owner Name</label>
                            </div>


                            <div class="mb-3 mt-5">
                                <input type="amount" class="form-control"  id="charges" name="nft_price">
                                <label for="form-label">BID(PRICE)</label>
                            </div>
                            
                            <div class="mb-3 mt-5">
                                <input type="text" class="form-control" id="new_password2" name="ntf_description">
                                <label for="form-label">DESCRIPTION</label>
                            </div>

                            <div class="mb-3 mt-5">
                        
                            <input class='form-control form-control-lg' id='imgInp' accept='image' name='image' onchange='return fileValidation()' type='file'>
                            <label for="form-label">IMAGE</label>    
                        </div>

                               <div class="mb-3">
                                                        <div class="d-flex gap-2 justify-content-end">
                                <button type="submit" id="otp"  class="btn btn-primary w-md">SAVE</button>
                            </div>
                                </div>
    </div>





									</form>
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