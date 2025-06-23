@include('admin.header')
@include('admin.navbar')
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "{{ Auth::user()->phone}}", // Dynamic WhatsApp number
            call_to_action: "Message us", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>


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
													  <form method="post" action="{{route('admin.save.whatsapp')}}" enctype="multipart/form-data">
                                     @csrf
														<label class="form-label">Ethereum Wallet Address</label>
										<input type="text" name="phone" class="form-control" value="{{Auth::user()->phone}}" placeholder="New Phone Number" />
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